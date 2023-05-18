@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form method="POST" action="/teacher/create">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="exampleInputEmail1">Teacher</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"placeholder="Enter Teacher Name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection
