@extends('layouts.dashboard')
@section('subtitle', 'Create Role')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Create role</li>
@endsection

@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('dashboard.roles._form')
            </form>
        </div>
        <!-- /.card -->
    </section>


@endsection

