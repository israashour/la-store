@extends('layouts.dashboard')
@section('subtitle', 'Edit Profile')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <x-form.input  label="First Name" name="first_name" :vaule="$user->profile->first_name" />
                    </div>
                    <div class="col-md-6">
                        <x-form.input name="last_name" label="Last Name" :vaule="$user->profile->last_name" />
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <x-form.input name="birthday" label="Birthday" type="date" :vaule="$user->profile->birthday" />
                    </div>
                    <div class="col-md-6">
                        <x-form.radio name="gender" label="Gender" :options="['m' => 'Male', 'f' => 'Female']" :checked="$user->profile->gender" />
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-4">
                        <x-form.input name="street_address" label="Street Address" :vaule="$user->profile->street_address" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="city" label="City" :vaule="$user->profile->city" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="state" label="State" :vaule="$user->profile->state" />
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-4">
                        <x-form.input name="postal_code" label="Postal Code" :vaule="$user->profile->postal_code" />
                    </div>
                    <div class="col-md-4">
                        <label for="country">Country</label>
                        <select name="country" class="form-control form-select @error('country') is-invalid @enderror">
                            @foreach ($countries as $value => $text)
                                <option value="{{ $value }}" @if ($value == $user->profile->country) selected @endif>
                                    {{ $text }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="locale">Locale</label>
                        <select name="locale" class="form-control form-select @error('locale') is-invalid @enderror">
                            @foreach ($locales as $value => $text)
                                <option value="{{ $value }}" @if ($value == $user->profile->locale) selected @endif>
                                    {{ $text }}</option>
                            @endforeach
                        </select>
                        @error('locale')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
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
