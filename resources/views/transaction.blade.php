@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        Data Item
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($items as $item)    
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>Rp. {{ number_format($item->price, 2, '.', '.') }}</td>
                                    <td>
                                        <a href="{{ route('transaction.add', $item->id) }}" class="btn btn-sm btn-success">Add to cart</a>
                                    </td>
                                </tr>
                            @endforeach
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
                            <thead>
                                <th>#</th>
                                <th>Item</th>
                                <th class="col-md-2">Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </thead>
                            @if(session('cart'))
                                @php $grandtotal = 0; @endphp
                                @foreach (session()->get('cart') as $id => $item)
                                    @php $grandtotal += $item['subtotal']; @endphp    
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                                            <td><input class="form-control @error('qty') is-invalid @enderror" onchange="ubah{{ $loop->iteration }}()" type="number" name="qty" id="qty" value="{{ $item['qty'] }}"></td>
                                            <td>Rp. {{ number_format($item['subtotal'], 2, '.', '.') }}</td>
                                            <td>
                                                <a id="delete{{ $loop->iteration }}" href="{{ route('transaction.delete', $item['id']) }}" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus item ini?')">
                                                    Hapus
                                                </a>
                                                <input id="update{{ $loop->iteration }}" style="display: none" type="submit" class="btn btn-sm btn-primary" value="Update">
                                            </td>
                                            
                                            {{-- JAVASCRIPT --}}
                                            <script>
                                                function ubah{{ $loop->iteration }}() {
                                                    $("#update{{ $loop->iteration }}").show();
                                                    $("#delete{{ $loop->iteration }}").hide();
                                                }
                                            </script>
                                        </form>
                                    </tr>
                                @endforeach
                                <form action="{{ route('transaction.store') }}" method="post">
                                    @csrf

                                    <tr>
                                        <td colspan="3" class="text-end">Grand Total</td>
                                        <td colspan="2">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="total" class="form-control" placeholder="total" aria-label="total" aria-describedby="basic-addon1" value="{{ $grandtotal }}" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">Payment</td>
                                        <td colspan="2">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="pay_total" class="form-control" placeholder="total payment" aria-label="total payment" aria-describedby="basic-addon1" required>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada item dalam cart</td>
                                        </tr>
                                    @endif
                                    </table>
                                    <div class="form-group d-flex justify-content-end">
                                        <input type="reset" value="Reset" class="btn btn-sm btn-danger mx-1">
                                        <input type="submit" value="Checkout" class="btn btn-sm btn-primary">
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection