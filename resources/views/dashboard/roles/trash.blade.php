@extends('layouts.dashboard')
@section('subtitle', 'Trashedd Categories')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
    <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')
    <section class="content">
        <div class="col-sm-12 text-right mb-5">
            <a href="{{ route('categories.index') }}" class="btn btn-primary ">Back</a>
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
                        @forelse ($categories as $key => $category)
                            <tr>
                                <td><img src="{{ asset('storage/' . $category->image) }}" height="50" alt="">
                                </td>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status }}</td>
                                <td>{{ $category->deleted_at }}</td>
                                <td width="30">
                                    {{-- @can('category-edit') --}}
                                    <form action="{{ route('categories.restore', $category->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-outline-info">Restore</button>
                                    </form>
                                    {{-- @endcan --}}
                                </td>
                                <td width="30">
                                    {{-- @can('category-delete') --}}
                                    <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger"
                                            href="{{ route('categories.force-delete', $category->id) }}">Force Delete</button>
                                    </form>
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Categories were found</td>
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
