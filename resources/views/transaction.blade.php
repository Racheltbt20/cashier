@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        Data Transaksi
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Palu</td>
                                <td>Perkakas</td>
                                <td>20</td>
                                <td>Rp. {{ number_format(50000, 2, '.', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaction.store', 1) }}" class="btn btn-sm btn-success">Add to cart</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        Cart
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th class="col-md-2">Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Palu</td>
                                <td><input class="form-control" type="number" value="3"></td>
                                <td>{{ number_format(150000, 2, '.', '.') }}</td>
                                <td>
                                    <input type="reset" value="Hapus" class="btn btn-sm btn-danger">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">Grand Total</td>
                                <td colspan="2"><input type="text" class="form-control" value="{{ number_format(150000, 2, '.', '.') }}" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">Payment</td>
                                <td colspan="2"><input type="text" class="form-control"></td>
                            </tr>
                        </table>
                        <div class="form-group d-flex justify-content-end">
                            <input type="reset" value="Reset" class="btn btn-sm btn-danger mx-1">
                            <input type="submit" value="Checkout" class="btn btn-sm btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection