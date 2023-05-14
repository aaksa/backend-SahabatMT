<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\PaymentItem;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //


    public function showTransaction(){
        // $datas = ModelsRequest::all();
        $condi = 'Pending';
        $datas = Transaction::where('status','Pending')->get();
        $users = User::whereIn('email', $datas->pluck('customer_email'))->get(); // Get users for the requests
        // $barang = PaymentItem::where('payment_id', $datas->pluck('id'))->get();
        // $barang = PaymentItem::whereIn('payment_id', $datas->pluck('id')->toArray())->get();
        $barang = PaymentItem::whereIn('payment_id', $datas->pluck('id'))->get();

        return view('transaction.transaction', compact('datas','condi','users','barang'));
    }

    public function getTransactionuser($email){
        try{
            // $datas = Transaction::where('customer_email',$email)->get();
            $datas = Transaction::with('items')->where('customer_email',$email)->get();
            return ResponseFormatter::success(['data' => $datas], 'Data berhasil ditambahkan');
        }catch (Exception $error){
            return ResponseFormatter::error(['message' => 'something went wrong' , 'error' => $error], "Data gagal ditambahkan", '500');
        }
    }

    public function showaccepted(){
        $condi = 'Terkonfirmasi';
        $datas = Transaction::where('status','Accepted')->get();
        $users = User::whereIn('email', $datas->pluck('customer_email'))->get(); // Get users for the requests
        // $barang = PaymentItem::where('payment_id', $datas->id);
        // $barang = PaymentItem::where('payment_id', '1')->get();
        $barang = PaymentItem::whereIn('payment_id', $datas->pluck('id'))->get();


        return view('transaction.transaction', compact('datas','condi','users','barang'));
    }

    public function showrejected(){
        $condi = 'Rejected';
        $datas = Transaction::where('status','Rejected')->get();
        $users = User::whereIn('email', $datas->pluck('customer_email'))->get(); // Get users for the requests
        // $barang = PaymentItem::where('payment_id', $datas->id);
        $barang = PaymentItem::whereIn('payment_id', $datas->pluck('id'))->get();

        return view('transaction.transaction', compact('datas','condi','users','barang'));
    }

    public function showrefunded(){
        $condi = 'Refunded';
        $datas = Transaction::where('status','Refunded')->get();
        $users = User::whereIn('email', $datas->pluck('customer_email'))->get(); // Get users for the requests
        // $barang = PaymentItem::where('payment_id', $datas->id);
        $barang = PaymentItem::whereIn('payment_id', $datas->pluck('id'))->get();

        return view('transaction.transaction', compact('datas','condi','users','barang'));
    }

    // public function deleteTransaction($id){
    //     $datana = Transaction::where('id', $id )->first();
    //     $datana->delete();
    //     return redirect('/transaction');
    // }

    public function deleteTransaction($id){
        $transaction = Transaction::find($id);
    
        if($transaction){
            $transaction->delete();
    
            // Delete all payment items associated with the transaction
            PaymentItem::where('payment_id', $id)->delete();
    
            return redirect('/transaction')->with('success', 'Transaction deleted successfully.');
        }else{
            return redirect('/transaction')->with('error', 'Transaction not found.');
        }
    }

    public function onclicktransaction($id, Request $request){

        Transaction::where('id', $id)->update([
            'status'=>$request->pengajuan
        ]);

        return redirect('/transaction');

    }

}
