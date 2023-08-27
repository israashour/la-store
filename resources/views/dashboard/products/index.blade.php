@extends('layouts.dashboard')
@section('subtitle', 'Products')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    <section class="content">
        <div class="col-sm-12 text-right mb-5">
            <a href="{{ route('products.create') }}" class="btn btn-primary mr-5">New Product</a>
            <a href="{{ route('products.trash') }}" class="btn btn-dark ">Trash</a>
        </div>

        <x-alret />
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: fit-content;">
                            <form action="{{ URL::Current() }}" method="get" class="d-flex justify-content-between">
                                <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
                                <select name="status" class="form-control mx-2">
                                    <option value="">All</option>
                                    <option value="active" @selected(request('status') == 'active')>Active</option>
                                    <option value="unactive" @selected(request('status') == 'unactive')>UnActive</option>
                                </select>
                                <button type="submit" class="btn btn-dark mx-2">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="150"></th>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Store</th>
                            <th>Status</th>
                            <th width="150">Created At</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $product)
                            <tr>
                                <td><img src="{{ asset('storage/' . $product->image) }}" height="50" alt="">
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->store->name }}</td>
                                <td>{{ $product->status }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td width="30">
                                    {{-- <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a> --}}
                                    {{-- @can('product-edit') --}}
                                    <a class="btn btn-outline-primary"
                                        href="{{ route('products.edit', $product->id) }}">Edit</a>
                                    {{-- @endcan --}}
                                </td>
                                <td width="30">
                                    {{-- @can('product-delete') --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger"
                                            href="{{ route('products.destroy', $product->id) }}">Delete</button>
                                    </form>
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No products were found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->withQueryString()->links() }}
            </div>
            {{-- <div class="card-footer clearfix">
                {!! $products->links() !!}
            </div> --}}
        </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
