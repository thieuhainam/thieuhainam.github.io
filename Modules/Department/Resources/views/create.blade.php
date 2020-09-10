@extends('layouts.app')
@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Department</h2>
            </div>
        </div>
    </div>
    <style type="text/css">
        .error-message { color: #ff0000; }
    </style>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(array('route' => 'showdepart','method'=>'POST')) !!}
    @method('POST')
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name Department:</strong>
                {!! Form::text('Name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Staff free:</strong>
                <br/>
                @foreach($staff as $value)
{{--                    <label>{{ Form::checkbox('staff', $value->staff_id, array('class' => 'name',false) )}} {{ $value->staff_name }}</label>--}}
                    <input type="checkbox" value='{{$value->staff_id}}' name="staff_id[]" >
                    <label for="staff_id">{{ $value->staff_name }} </label>
                    <br/>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('department.a') }}"> Cancel</a> <button type="submit" class="btn btn-primary">Submit</button></div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}


@endsection

