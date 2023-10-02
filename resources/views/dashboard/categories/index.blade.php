@extends('layouts.dashboard')
@section('subtitle', 'Categories')
@section('pagename')
    <li class="breadcrumb-item">
        <a href="{{ route('index') }}">Home</a>
    </li>
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <section class="content">
        <div class="col-sm-12 text-right mb-5">
            @can('categories.create')
                <a href="{{ route('categories.create') }}" class="btn btn-primary mr-5">New Category</a>
            @endcan

            <a href="{{ route('categories.trash') }}" class="btn btn-dark ">Trash</a>
        </div>

        <x-alret />
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: fit-content;">
                            <form action="{{ URL::Current() }}" method="get" class="d-flex justify-content-between">
                                <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
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
                            <th>Parent</th>
                            <th>Products#</th>
                            <th>Status</th>
                            <th width="150">Created At</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $key => $category)
                            <tr>
                                <td><img src="{{ asset('storage/' . $category->image) }}" height="50" alt="">
                                </td>
                                <td>{{ $category->id }}</td>
                                <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                                <td>{{ $category->parent ? $category->parent->name : 'Main Category' }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td>{{ $category->status }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td width="30">
                                    @can('categories.update')
                                        {{-- <a class="btn btn-info" href="{{ route('categories.show', $category->id) }}">Show</a> --}}
                                        {{-- @can('category-edit') --}}
                                        <a class="btn btn-outline-primary"
                                            href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                        {{-- @endcan --}}
                                    @endcan
                                </td>
                                <td width="30">
                                    @can('categories.delete')
                                        {{-- @can('category-delete') --}}
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger"
                                                href="{{ route('categories.destroy', $category->id) }}">Delete</button>
                                        </form>
                                        {{-- @endcan --}}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Categories were found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->withQueryString()->links() }}
            </div>
            {{-- <div class="card-footer clearfix">
                {!! $categories->links() !!}
            </div> --}}
        </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
