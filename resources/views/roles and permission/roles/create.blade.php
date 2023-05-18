@extends('layouts.master')
@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <form method="POST" action="/role/create">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"placeholder="Enter Name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection
