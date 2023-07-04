@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form method="POST" action="/user/create">
                    @csrf
                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name"
                               class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                               placeholder="Enter User Name">
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email"
                               class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                               placeholder="Enter Email Name">
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password"
                               class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                               placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Role</label>
                        <select name='role' class="custom-select">
                            @foreach($role as $i)
                                <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection
