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
                <h4>Edit Role</h4>
                <form method="POST" action="/role/update">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{$role->id}}{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="exampleInputEmail1">Role Name</label>
                        <input type="text" name="name" value="{{$role->name}} {{ $errors->has('name') ? ' is-invalid' : '' }}" class="form-control" placeholder="Enter Name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    </div>

@endsection
