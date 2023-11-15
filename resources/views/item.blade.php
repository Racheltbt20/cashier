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
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Aksi</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Perkakas</td>
                                <td>Palu</td>
                                <td>Rp. {{ number_format(50000, 2, '.', '.') }}</td>
                                <td>20</td>
                                <td>
                                    <a href="{{ route('item.edit', 1) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('item.destroy', 1) }}" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        Tambah Item
                    </div>
                    <div class="card-body">
                        <form action="{{ route('item.store') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name">Item Category</label>
                                <select class="form-select" id="category_id" name="category_id" aria-label="category_id">
                                    <option selected disabled>Item Category...</option>
                                    <option value="1">Perkakas</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="name">Item Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="item name..." required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="item price..." required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Qty</label>
                                <input type="number" class="form-control" name="stock" id="stock" placeholder="item stock..." required>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <input type="reset" value="Reset" class="btn btn-danger mx-1">
                                <input type="submit" value="Save" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection