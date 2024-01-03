@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mb-4">
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
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($items as $item)    
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>Rp. {{ number_format($item->price, 2, '.', '.') }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>
                                        <div class="d-flex" style="gap:5px;">
                                            <button onclick="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
                                            <form action="{{ route('item.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini? ')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-4">
                <div class="card">
                    <div class="card-header" id="card-head">
                        Tambah Item
                    </div>
                    <div class="card-body">
                        <form action="{{ route('item.store') }}" method="POST" id="form-item">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-2">
                                <label for="name">Item Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" aria-label="category_id">
                                    <option selected disabled>Item Category...</option>
                                    @foreach ($categories as $category)    
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="name">Item Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="item name..." required value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="price">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="item price..." required value="{{ old('price') }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Stock</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" placeholder="item stock..." required value="{{ old('stock') }}">
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button class="btn btn-danger mx-1" onclick="batal()" type="reset">Batal</button>
                                <input type="submit" value="Simpan" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function edit(a) {
            // console.log('oke');
            document.getElementById("card-head").innerHTML = "Edit Item";
            $.get('item/' + a + '/edit', function(data) {
                $('#category_id').val(data.category_id);
                $('#name').val(data.name);
                $('#price').val(data.price);
                $('#stock').val(data.stock);
                var action = '{{ route("item.update", ":id") }}';
                action = action.replace(":id", data.id);
                $("#form-item").attr("action", action);
                $("input[name='_method']").val("PUT");
            })
        }

        function batal() {
            document.getElementById("card-head").innerHTML = "Tambah Category";
            var action = '{{ route("category.store") }}';
            $("#form-category").attr("action", action);
            $('#name').val("");
        }
    </script>

@endsection