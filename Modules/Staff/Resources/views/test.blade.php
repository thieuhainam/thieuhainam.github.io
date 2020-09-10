@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 7 Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" defer rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
</head>
<body>

<div class="container">
    <h1>Laravel 7 Datatables Tutorial <br/> HDTuto.com</h1>
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>Ten Nhan Vien</th>
            <th>Ten Phong Ban</th>
            <th>So Dien Thoai</th>
            <th>Dia Chi</th>
            <th>Ngay Tham Gia</th>
            <th>Ngay Update</th>
            <th width="100px">Action</th>
            <th>Cong cu</th>

        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>

<script type="text/javascript">
    $(function () {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('staff.b') }}",
            columns: [
                {data: 'staff_name', name: 'Ten Nhan Vien'},
                {data: 'phone', name: 'So Dien Thoai'},
                {data: 'created_at', name: 'Ngay Tham Gia'},
                {data: 'updated_at', name: 'Ngay Update'},
            ]
        });

    });
</script>
</html>
@endsection
