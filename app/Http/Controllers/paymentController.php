<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-CQL5NRb_IwzlkRKI-6FNPc1_';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
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
    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => $request->input('gross_amount'),
        ),


        'customer_details' => array(
            'last_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'billing_address' => array(
                'first_name' => 'Budi',
                'last_name' => 'Susanto',
                'email' => 'budisusanto@example.com',
                'phone' => '08123456789',
                'address' => 'Sudirman No.12',
                'city' => 'Jakarta',
                'postal_code' => '12190',
                'country_code' => 'IDN',
            ),

        


        ),

        'item_details' => array(
            array(
                'id' => rand(),
                'price' => $request->input('harga'),
                'quantity' => $request->input('kuantitas'),
                'name' => $request->input('nama_barang'),
            ),
            // array(
            //     'id' => 'b02',
            //     'price' => 3000,
            //     'quantity' => 2,
            //     'name' => 'Orange',
            // ),
        ),

        // 'item_details' => array(
        //     'name' => $request->input('nama_barang'),
        //     'quantity' => $request->input('kuantitas'),
        //     'price' => $request->input('harga')
        // ),
        
    );

    // $params = array(
    //     'transaction_details' => array(
    //         'order_id' => 'CustOrder-' . rand(),
    //         'gross_amount' => 13000,
    //     ),
    //     'credit_card' => array(
    //         'secure' => true,
    //     ),
    //     'item_details' => array(
    //         array(
    //             'id' => 'a01',
    //             'price' => 7000,
    //             'quantity' => 1,
    //             'name' => 'Apple',
    //         ),
    //         array(
    //             'id' => 'b02',
    //             'price' => 3000,
    //             'quantity' => 2,
    //             'name' => 'Orange',
    //         ),
    //     ),
    //     'customer_details' => array(
    //         'first_name' => 'Budi',
    //         'last_name' => 'Susanto',
    //         'email' => 'budisusanto@example.com',
    //         'phone' => '+628123456789',
    //         'billing_address' => array(
    //             'first_name' => 'Budi',
    //             'last_name' => 'Susanto',
    //             'email' => 'budisusanto@example.com',
    //             'phone' => '08123456789',
    //             'address' => 'Sudirman No.12',
    //             'city' => 'Jakarta',
    //             'postal_code' => '12190',
    //             'country_code' => 'IDN',
    //         ),
    //         'shipping_address' => array(
    //             'first_name' => 'Budi',
    //             'last_name' => 'Susanto',
    //             'email' => 'budisusanto@example.com',
    //             'phone' => '0812345678910',
    //             'address' => 'Sudirman',
    //             'city' => 'Jakarta',
    //             'postal_code' => '12190',
    //             'country_code' => 'IDN',
    //         ),
    //     ),
    // );
    

    // Get Snap token and redirect URL
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    $redirectUrl = \Midtrans\Snap::getSnapUrl($params);

    // Create response array with Snap token and redirect URL
    $response = array(
        'snap_token' => $snapToken,
        'redirect_url' => $redirectUrl
    );

    // Return response as JSON
    return response()->json($response);
}


}
