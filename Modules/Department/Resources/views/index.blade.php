

@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">--}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>staff</title>
</head>
<body>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Department Management</h2>
        </div>
    </div>
</div>

<form class="form-select" method="get" action="{{route('showstaff')}}">

    <div class="row">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('adddepart') }}"> Create New Department</a>
        </div>
    </div>
    </div>
</form>


<table class="table table-bordered" >
    <thead>
    <tr>

        <th>Department</th>
        <th>Numbers Staff of Department</th>
        <th>Tools</th>

    </tr>
    </thead>
    <tbody>

    @foreach($department as $row )

        <tr>

            <td>{{$row->name}}</td>
            <td>{{$row->sonhanvien}}</td>
            <td><a class="btn btn-info"  href="{{ route('departshow',$row->id) }}"> Show detail </a> | <a class="btn btn-warning"  href="{{ route('addremove',$row->id) }}">  Add/Remove Staff </a>  |  <a class="btn btn-danger" href="{{route('departmentdelete', $row->id)}}"> Delete </a>
        </tr>
    @endforeach
    </tbody>


</table>
{{--<div class="abc" > {{$data->links()}}</div>--}}

</body>
</html>
@endsection
