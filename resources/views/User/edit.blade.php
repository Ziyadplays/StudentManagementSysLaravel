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
                <h4>Edit Teacher</h4>
                <form method="POST" action="/user/update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$user->id}}{{ $errors->has('name') ? ' has-danger' : '' }}">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" name="name"
                               value="{{$user->name}} {{ $errors->has('name') ? ' is-invalid' : '' }}"
                               class="form-control" placeholder="Enter Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" name="email"
                               value="{{$user->email}} {{ $errors->has('name') ? ' is-invalid' : '' }}"
                               class="form-control" placeholder="Enter Email">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    </div>

@endsection
