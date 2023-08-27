@extends('layouts.dashboard')
@section('subtitle', $category->name)
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
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
                        $products = $category->products()->with('store')->paginate();
                    @endphp
                    @forelse ($products as $key => $product)
                        <tr>
                            <td><img src="{{ asset('storage/' . $product->image) }}" height="50" alt="">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->store->name }}</td>
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
