<?php

namespace App\Http\Controllers;

use App\Models\PaymentItem;
use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Http\Request;

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'Mid-server-IImGgjrLtnePkOvxnLKMQS6X';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = true;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

class paymentController extends Controller
{
    //
    

    // public function payProduk(){

    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => rand(),
    //             'gross_amount' => 10000,
    //         ),
    //         'customer_details' => array(
    //             'first_name' => 'budi',
    //             'last_name' => 'pratama',
    //             'email' => 'budi.pra@example.com',
    //             'phone' => '08111222333',
    //         ),
    //     );
        
    //     $snapToken = \Midtrans\Snap::getSnapToken($params);

    //     return $snapToken ;
    // }
//     public function payProduk()
// {
//     $params = array(
//         'transaction_details' => array(
//             'order_id' => rand(),
//             'gross_amount' => 5656,
//             'item_details' => array(
//                 'nama' => 'ac_baru',
//                 'kuantitas'=>'2',
//                 'kondisi'=>'baru'
//             ),
//         ),
//         'customer_details' => array(
//             'nama' => 'budi',
//             'email' => 'budi.pra@example.com',
//             'phone' => '08111222333',
//             'address'=>'jl.karet tanete'
//         ),
//     );

//     // Get Snap token and redirect URL
//     $snapToken = \Midtrans\Snap::getSnapToken($params);
//     $redirectUrl = \Midtrans\Snap::getSnapUrl($params);

//     // Create response array with Snap token and redirect URL
//     $response = array(
//         'snap_token' => $snapToken,
//         'redirect_url' => $redirectUrl
//     );

//     // Return response as JSON
//     return response()->json($response);
// }

public function payProduk(Request $request)
{
    $items = $request->input('items');
    $item_details = [];

    foreach ($items as $item) {
        $item_detail = [
            'id' => $item['produk']['id'],
            'price' => $item['produk']['harga'],
            'quantity' => $item['quantity'],
            'name' => $item['produk']['nama'],
        ];
        array_push($item_details, $item_detail);
    }

    $discount_detail = [
        'id' => 'D01',
        'name' => 'Ongkos Kirim',
        'price' => $request->input('ongkir'),
        'quantity' => 1,
    ];

    array_push($item_details, $discount_detail);

        // Generate a unique order ID
    $order_id = rand();

    $params = [
        'transaction_details' => [
            'order_id' => $order_id,
            'gross_amount' => $request->input('gross_amount'),
        ],
        'customer_details' => [
            'last_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'billing_address' => [
                'first_name' => '',
                'last_name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'postal_code' => '90111',
                'country_code' => 'IDN',
            ],
        ],
        
        'item_details' => $item_details,
    ];

    // $this->createRiwayat($request);
    // Get Snap token and redirect URL
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    $redirectUrl = \Midtrans\Snap::getSnapUrl($params);
    
    // Create response array with Snap token and redirect URL
    $response = array(
        'snap_token' => $snapToken,
        'redirect_url' => $redirectUrl,
        'order_id' => $order_id,
    );

    // Return response as JSON
    return response()->json($response);
}



public function createRiwayat(Request $request){

    $items = $request->input('items');
    $gross_amount = $request->input('gross_amount');
    $name = $request->input('name');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $address = $request->input('address');
    
    // create the transaction record
    $transaction = Transaction::create([
        'gross_amount' => $gross_amount,
        'customer_name' => $name,
        'customer_email' => $email,
        'customer_phone' => $phone,
        'address' => $address,
    ]);

    // create the payment items records
    foreach ($items as $item) {
        $product = Produk::find($item['produk']['id']);
        PaymentItem::create([
            'payment_id' => $transaction->id, // Add this line
            'product_id' => $item['produk']['id'],
            'product_name' => $item['produk']['nama'],
            'product_price' => $item['produk']['harga'],
            'quantity' => $item['quantity'],
        ]);
        $newQuantity = $product->kuantitas - $item['quantity'];
        $product->update(['kuantitas' => $newQuantity]);

    }   // return the transaction object
}

public function handlePaymentCallback(Request $request)
{
    $transactionStatus = $request->input('transaction_status');
    if ($transactionStatus == 'capture') {
        dd($transactionStatus);
        return response()->json(['status' => 'success']);
    } else {
        dd($transactionStatus);
        return response()->json(['status' => 'error']);
    }
}
}
