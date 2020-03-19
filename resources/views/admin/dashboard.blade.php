{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('adminlte_css')
<!-- Datepicker CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@yield('css')
@stop

@section('adminlte_js')
<!-- datepicker js -->
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script src="{{ asset('js/inputmask.numeric.extensions.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('js')
<script>
    $('.order-table').DataTable({
        "bPaginate": false,
    });

    $(".product-currency").inputmask("decimal", {
        alias: 'numeric',
        rightAlign: false,
        digitsOptional: true,
        radixPoint: ',',
        groupSeparator: '.',
        autoGroup: true,
        placeholder: '',
        suffix: " ₫",
        removeMaskOnSubmit: true
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
</script>
@stop
