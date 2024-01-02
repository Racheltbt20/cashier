<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Http\Request;

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
            $cart[$id] = [
                "id" => $item->id,
                "name" => $item->name,
                "qty" => 1,
                "subtotal" => $item->price
            ];
        }

        session()->put('cart', $cart);
        // return session()->get('cart');
        return redirect()->back();

    }

    public function delete($id)
    {
        $cart = session('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Successfully removed Item from Cart');
    }

    public function cartUpdate(Request $request)
    {
        $item = Item::findorfail($request->id);
        $cart = session('cart');

        $cart[$request->id]['qty'] = $request->qty;
        $cart[$request->id]['subtotal'] = $item->price * $request->qty;
        // $cart[$request->id]['subtotal'] *= $cart[$request->id]['qty'];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Successfully updated Cart');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
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
