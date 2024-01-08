@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session::get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header">
                        Data Kategori
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="d-flex" style="gap:5px;">
                                        <button onclick="edit({{ $category->id }})" class="btn btn-sm btn-warning">Edit</button>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini? ')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <span id="card-head">Tambah Kategori</span>
                    </div>
                    <div class="card-body">
                        <form id="form-category" action="{{ route('category.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-2">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="category name..." required value="{{ old('name') }}">
                                @error('name')
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
            document.getElementById("card-head").innerHTML = "Edit Category";
            $.get('category/' + a + '/edit', function(data) {
                $('#name').val(data.name);
                var action = '{{ route("category.update", ":id") }}';
                action = action.replace(":id", data.id);
                $("#form-category").attr("action", action);
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

    @if (Session::has('error_update'))
        <script>
            edit('{{ session('error_update')['a'] }}')
        </script>
    @endif

@endsection