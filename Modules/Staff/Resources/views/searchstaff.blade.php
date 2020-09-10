@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>staff</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .dataTables_wrapper.no-footer {
            margin: auto;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Staff Management</h2>
        </div>
    </div>
</div>

<form class="form-select" method="post" action="{{route('showstaff') }}">
    @method('POST')
    @csrf
{{--    <div>--}}
{{--        {!! Form::text('namesearch', null, array('placeholder' => 'Name','class' => 'form-control')) !!}--}}
{{--    </div>--}}
    &nbsp; &nbsp;
    <select name="name">
        <option value="0">All</option>
        @foreach($department as $a)
            <option  {{$id_de == $a->id ? "selected" : ""}} value="{{$a -> id}}">  {{$a ->Name}}  </option>
        @endforeach
    </select>
    <button type="submit"> Search</button>
    &nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp; @can('staff-create')
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('addstaff') }}"> Create New Staff</a>
            </div>
        </div>
        @endcan
        </div>
</form>

<div class="row">
    <table class="table table-bordered" id ="datatable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Staff_name</th>
            <th>Department</th>
            <th>So Dien Thoai</th>
            <th>Dia Chi</th>
            <th>Ngay Tham Gia</th>
            <th>Ngay Update</th>
            <th>Trang Thai</th>
            <th>Tools</th>
        </tr>
        </thead>
        <tbody>

        @foreach($staff as $row)

            <tr>
                <td>{{$row ->staff_id}}</td>
                <td>{{$row->staff_name}}</td>
                <td>{{optional($row->department)->Name}}</td>
                <td>{{$row ->phone}}</td>
                <td>{{$row->address}}</td>
                <td>{{$row->created_at}}</td>
                <td>{{$row->updated_at}}</td>
                <td style="color: green">{{ ($row->is_active == 1) ? 'Active' : 'Nonactive' }}</td>
                <td>  <a class="btn btn-info" href="{!! route('editstaff',['id'=> $row->staff_id] ) !!}">Edit</a> |
                    {!! Form::open(['method' => 'DELETE','route' => ['destroystaff', $row->staff_id, '1'],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}</td>
            </tr>
        @endforeach
        </tbody>


    </table>
</div>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-colvis-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/datatables.min.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-colvis-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/datatables.min.js" defer></script>

{{--<script type="text/javascript">--}}

{{--    var editor; // use a global for the submit and return data rendering in the examples--}}

{{--    $(document).ready(function() {--}}
{{--        var table = $('#table1').DataTable({--}}
{{--            processing: true,--}}
{{--            serverSide: true,--}}
{{--            ajax:"{{route('staff.b')}}",--}}
{{--            columns: [--}}
{{--                {   data:"staff_id"},--}}
{{--                {   data:"staff_name"},--}}
{{--                {   data: "id_department"},--}}
{{--                {   data:"phone"},--}}
{{--                {   data:"address"},--}}
{{--                {   data:"created_at"},--}}
{{--                {   data:"updated_at"},--}}
{{--                {--}}
{{--                    data: null,--}}
{{--                    defaultContent: "<a class='btn btn-info my-edit-btn text-white'>Edit</a> | <a class='btn btn-danger my-delete-btn text-white'>Delete</a>",--}}
{{--                    createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {--}}
{{--                        $(cell).on("click", "a.my-edit-btn", rowData, edit_click_function);--}}
{{--                        // $(cell).on("click", "a.my-delete-btn", rowData, delete_click_function);--}}
{{--                    }--}}
{{--                },--}}
{{--            ],--}}
{{--            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],--}}
{{--            dom : 'Bfrtip',--}}
{{--            buttons: ["print",'copy', {--}}
{{--                extend: 'excelHtml5',--}}
{{--                exportOptions: {--}}
{{--                    modifier : {--}}
{{--                        page : 'all', // 'all', 'current'--}}
{{--                        search : 'none' // 'none', 'applied', 'removed'--}}
{{--                    },--}}
{{--                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]--}}
{{--                }--}}
{{--            }, 'pdf'],--}}
{{--            order: [[1, 'asc']],--}}
{{--        });--}}
{{--        var data = table.buttons.exportData();--}}
{{--    } );--}}
{{--    function edit_click_function(event) {--}}
{{--        // alert("You edit " + event.data.staff_id + "'s row");--}}
{{--        var $id = event.data.staff_id;--}}
{{--        var url = '{{ route("editstaff", ":id_staff") }}';--}}
{{--        url = url.replace(':id_staff', $id);--}}
{{--        window.location.href = url;--}}
{{--    }--}}
{{--    function draw () {--}}
{{--        console.log( 'Table redrawn '+new Date() );--}}
{{--    };--}}


{{--    function delete_click_function(event) {--}}
{{--        var $id = event.data.staff_id;--}}
{{--        var $pid = 1;--}}
{{--        var base = '{{route("destroystaff", ":id_staff")}}';--}}
{{--        var url = base+'?id_staff='+$id+'/1' ;--}}
{{--        window.location.href = url;--}}
{{--    }--}}

{{--</script>--}}
<script type="text/javascript">

    var editor; // use a global for the submit and return data rendering in the examples

    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            dom : 'Bfrtip',
            buttons: ["print",'copy', {
                extend: 'excelHtml5',
                exportOptions: {
                    modifier : {
                        page : 'all', // 'all', 'current'
                        search : 'none' // 'none', 'applied', 'removed'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            }, 'pdf'],
        })
    });


</script>

</body>
</html>
@endsection

