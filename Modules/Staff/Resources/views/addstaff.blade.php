@extends('layouts.app')
@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Staff</h2>
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
    {!! Form::open(array('route' => 'staffadd','method'=>'POST')) !!}
    @method('POST')
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name Staff:</strong>
                {!! Form::text('namestaff', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>So Dien Thoai:</strong>
                {!! Form::text('sodienthoai', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Dia Chi:</strong>
                {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Trang Thai:</strong> &nbsp;&nbsp;&nbsp;
                <form >
                    <input checked="checked" name="active" type="radio" value="1" />Active
                    <input name="active" type="radio" value="0" />Nonactive
                 </form>

                </div>
            <div class="form-group">
                <strong>Phong Ban:</strong> &nbsp;&nbsp;&nbsp;
                    <select name="TenDanhSach">
                        @foreach($department as $row)
                            <option value="{{$row -> id}}">  {{$row -> Name}}  </option>
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

{{--<form method="post" action="staff/add">--}}
{{--    @method('POST')--}}
{{--    @csrf--}}
{{--    <p>--}}
{{--        <label for="namestaff">NameStaff</label><br>--}}
{{--        <input type="text" name="namestaff" value="">--}}
{{--    </p>--}}
{{--    <select name="TenDanhSach">--}}
{{--        @foreach($department as $row)--}}
{{--        <option value="{{$row -> id}}">  {{$row -> Name}}  </option>--}}
{{--        @endforeach--}}
{{--    </select>--}}



{{--    <p>--}}
{{--        <button type="submit">Submit</button>--}}
{{--    </p>--}}
{{--</form>--}}
@endsection

