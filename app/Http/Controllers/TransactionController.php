<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // session()->flush();
        return view('transaction', [
            "items" => Item::all()
        ]);
    }

    /**
     * Function tambahan untuk cart
     */
    public function add($id)
    { 
        $item = Item::findorfail($id);

        $cart = session()->get('cart');

        if(isset($cart[$id])){
            $cart[$id]['qty'] += 1;
            $cart[$id]['subtotal'] = $item->price * $cart[$id]['qty'];
        } else{
            if($item->stock > 0) {
                $cart[$id] = [
                    "id" => $item->id,
                    "name" => $item->name,
                    "qty" => 1,
                    "subtotal" => $item->price
                ];
            } else {
                return redirect()->back()->with('error', 'Item kosong!');
            }
        }

        session()->put('cart', $cart);
        // return session()->get('cart');
        return redirect()->back()->with('success', 'Berhasil menambahkan item ke cart');

    }

    public function delete($id)
    {
        $cart = session('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Berhasil menghapus item dari cart');
    }

    public function cartUpdate(Request $request)
    {
        $item = Item::findorfail($request->id);
        $cart = session('cart');

        if($request->qty > 0) {
            $cart[$request->id]['qty'] = $request->qty;
            $cart[$request->id]['subtotal'] = $item->price * $request->qty;
            session()->put('cart', $cart);
        } else {
            $this->delete($request->id);
        }

        return redirect()->back()->with('success', 'Berhasil meng-update cart');
    }
    /**
     * Function tambahan untuk cart selesai
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        Transaction::create([
            'user_id' => Auth::id(),
            'date' => Carbon::now(),
            'total' => $request->total,
            'pay_total' => $request->pay_total
        ]);

        $cart = session()->get('cart');
        foreach($cart as $item) {
            TransactionDetail::create([
                'transaction_id' => Transaction::latest()->first()->id,
                'item_id' => $item['id'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal']
            ]);

            $product = Item::find($item['id']);
            $stock = $product->stock - $item['qty'];
            $product->update(['stock' => $stock]);

        }

        if ($request->total > $request->pay_total) {
            return redirect()->back()->with('error', 'Uang anda kurang');
        }

        session()->forget('cart');
        return redirect()->route('transaction.show', Transaction::latest()->first()->id);
        // ->back()->with('success', 'Checkout berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaksi = Transaction::findorfail($transaction->id);

        return view('invoice', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
