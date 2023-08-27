@extends('layouts.dashboard')
@section('subtitle', $store->name)
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">Stores</a></li>
    <li class="breadcrumb-item active">{{ $store->name }}</li>
@endsection

@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="150"></th>
                        <th>Name</th>
                        <th>Store</th>
                        <th>Status</th>
                        <th width="150">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $products = $store->products()->with('store')->paginate();
                    @endphp
                    @forelse ($products as $key => $product)
                        <tr>
                            <td><img src="{{ asset('storage/' . $product->image) }}" height="50" alt="">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->status }}</td>
                            <td>{{ $product->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No Products were found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{$products->links()}}
        </div>
        <!-- /.card -->
    </section>


@endsection
