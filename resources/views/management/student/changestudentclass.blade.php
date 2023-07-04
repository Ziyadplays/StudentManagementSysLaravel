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
                <div class="card">
                    <div class="card-header">
                        <h4>Change Classes</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/student/changeclass">
                            @csrf
{{--                            @method('PUT')--}}
                            <div class="form-group">

                            <input type="hidden" name="id" value="{{$student->id}}">
                                <select name="class" class="custom-select">
                                    @foreach($class as $i)
                                        <option value="{{$i->id}}">{{$i->name}}-{{$i->section}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--                    <div class="form-group">--}}
                            {{--                        <input type="hidden" name="id" value="{{$student->id}}">--}}
                            {{--                        <select name = 'class' class="custom-select">--}}
                            {{--                            @foreach($student as $i)--}}
                            {{--                                <option value="{{$i->id}}">{{$i->name}}-{{$i->section}}</option>--}}
                            {{--                            @endforeach--}}
                            {{--                        </select>--}}
                            {{--                    </div>--}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
