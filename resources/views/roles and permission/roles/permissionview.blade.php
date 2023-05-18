@extends('layouts.master')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="row mt-4">
            <div class="col-md-8">
                <h4>Assign Permissions</h4>
                <form method="POST" action="/role/assignpermission/{{$role->id}}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{$role->id}}">
                        <select name='permission' class="custom-select">
                            @foreach($permission as $i)
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
