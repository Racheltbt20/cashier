@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        Data Kategori
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th >Aksi</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Perkakas</td>
                                <td>
                                    <a href="{{ route('category.edit', 1) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('category.destroy', 1) }}" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        Tambah Kategori
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="category name..." required>
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