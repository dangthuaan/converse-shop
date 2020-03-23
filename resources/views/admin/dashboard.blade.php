{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('adminlte_css')
<!-- Datepicker CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@yield('css')
@stop

@section('adminlte_js')
<!-- datepicker js -->
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/inputmask.numeric.extensions.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
<script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js"></script>
<script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.js"></script>
<script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.date.extensions.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('js')
<script>
    Dropzone.options.dropzone = {
        autoProcessQueue: false,
        required: true,
        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
        addRemoveLinks: true,
        maxFiles: 8,
        parallelUploads: 100,
        maxFilesize: 5,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    };

    $('.data-table').DataTable({
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

    // $(".date").inputmask("dd/mm/yyyy");

    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        maxDate: '0'
    });

    $("#submit-form").click(function() {
        var imgVal = $('#upload-image').val();
        if (imgVal == '') {
            $('#noImage').modal("show");
        }
    });

    // Inputmask().mask(".date");

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
