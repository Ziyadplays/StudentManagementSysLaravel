@extends('layouts.master')
@section('content')

    <div class="container-fluid align-items-center">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title"></h5>
                    </div>
                    <form method="post" action="/profileedit" autocomplete="off" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf

                            <div class="form-group text-center">
                                <img class = 'img-profile rounded  shadow-4-strong border border-dark'  src="{{asset('images/'.\Illuminate\Support\Facades\Auth::user()['img-path'])}}" class="rounded mx-auto d-block w-25" alt="...">
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">

                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email address') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">

                            </div>
                        </div>
                        <div class="card-footer">

                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>

                            <label for="" class="upload">
                                <input type="file" name="image">
                            </label>

                        </div>
                    </form>
                </div>
    </div>
            <script type="text/javascript">
                if(performance.navigation.type == 2){
                    location.reload(true);
                }
            </script>


@endsection
