@extends('layouts.dashboard')
@section('subtitle', 'Edit Role')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Edit role</li>
@endsection

@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('dashboard.roles._form', [
                    'button_label' => 'Update'
                ])
            </form>

        </div>
        <!-- /.card -->
    </section>


@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300
            });

        });
    </script>
@endsection
