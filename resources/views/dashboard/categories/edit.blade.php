@extends('layouts.dashboard')
@section('subtitle', 'Edit Category')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Edit category</li>
@endsection

@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('dashboard.categories._form', [
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
