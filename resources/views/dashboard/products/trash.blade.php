@extends('layouts.dashboard')
@section('subtitle', 'Trashed Products')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
    <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')
    <section class="content">
        <div class="col-sm-12 text-right mb-5">
            <a href="{{ route('products.index') }}" class="btn btn-primary ">Back</a>
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
                            <th></th>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Deleted At</th>
                            <th width="100">Status</th>
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
                                <td>{{ $product->status }}</td>
                                <td>{{ $product->deleted_at }}</td>
                                <td width="30">
                                    {{-- @can('product-edit') --}}
                                    <form action="{{ route('products.restore', $product->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-outline-info">Restore</button>
                                    </form>
                                    {{-- @endcan --}}
                                </td>
                                <td width="30">
                                    {{-- @can('product-delete') --}}
                                    <form action="{{ route('products.force-delete', $product->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger"
                                            href="{{ route('products.force-delete', $product->id) }}">Force Delete</button>
                                    </form>
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Products were found</td>
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
