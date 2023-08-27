@extends('layouts.dashboard')
@section('subtitle', 'Create Product')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Create product</li>
@endsection

@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('dashboard.products._form', [
                    'button_label' => 'Save'
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
