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
                <h3>Create Student</h3>
                <form method="POST" action="/student/create">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"placeholder="Enter Name">
                    </div>
                    <div class="form-group mt-4">
                        <h3>Assign Class</h3>
                        <label for="exampleInputEmail1">Class</label>
                        <select name="student_class_id" class="custom-select">
                            @foreach($class as $i)
                                <option value="{{$i->id}}">{{$i->name}}-{{$i->section}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
