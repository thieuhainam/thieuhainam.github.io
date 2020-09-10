@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add Remove in Department: {{$deparment}}</h2>
            </div>
        </div>
    </div>
    <style type="text/css">
        .error-message { color: #ff0000; }
    </style>
    {!! Form::model($staff, ['method' => 'POST','route' => ['departmentupdate','id'=> $id ]]) !!}

    <table class="table table-bordered" >
        <thead>
        <tr>
            <th>Staff in Department</th>

            <th>Staff Free</th>
        </tr>
        </thead>
        <tbody>



            <tr>
                <th>
                    @foreach($staff1 as $value)
                        <input type="checkbox" checked value='{{$value->staff_id}}' name="staff_id[]" >
                        <label for="staff_id">{{ $value->staff_name }} </label>
                        <br>
                    @endforeach
                </th>
                <th>
                    @foreach($staff as $value1)
                        <input type="checkbox" value='{{$value1->staff_id}}' name="staff_id1[]" >
                        <label for="staff_id">{{ $value1->staff_name }} </label>
                        <br/>
                    @endforeach

                </th>
            </tr>
        </tbody>


    </table>


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
