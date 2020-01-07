{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<p>Welcome to this beautiful admin panel.</p>
@stop

@section('adminlte_css')
<!-- Datepicker CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@yield('css')
@stop

@section('adminlte_js')
<!-- datepicker js -->
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script>
    $(function() {
        $('#example').DataTable();

        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });
    });
</script>
@yield('js')
@stop