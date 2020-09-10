@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Update Staff</h2>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        {!! Form::model($staff, ['method' => 'PATCH','route' => ['updatestaff','id' => $staff->staff_id]]) !!}

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name Staff:</strong>
                {!! Form::text('namestaff', $staff->staff_name, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>So Dien Thoai:</strong>
                {!! Form::text('sodienthoai', $staff->phone, array('placeholder' => 'Phone','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Dia Chi:</strong>
                {!! Form::text('address', $staff->address, array('placeholder' => 'Address','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Trang Thai:</strong> &nbsp;&nbsp;&nbsp;
                <form >
                    <input checked="checked" name="active" type="radio" value="1" />Active
                    <input name="active" type="radio" value="0" />Nonactive
                </form>

            </div>
            <div class="text-center">
                <select name="TenDanhSach">
                    @foreach($department as $row)
                        <option   {{$staff->id_department == $row->id ? "selected" : ""}}  value="{{$row -> id}}">  {{$row -> Name}}  </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <h1></h1>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('staff.a') }}"> Cancel</a> <button type="submit" class="btn btn-primary">Submit</button></div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}



@endsection
