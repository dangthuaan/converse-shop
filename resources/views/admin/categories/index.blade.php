@extends('admin.dashboard')

@section('content')

@if (session('error'))
<div class="alert alert-danger" role="alert" style="text-align: center;">
    {{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert" style="text-align: center;">
    {{ session('success') }}
</div>
@endif
<h1>
    Category list:
</h1>
<a class="btn btn-primary" href="{{ route('admin.categories.create') }}">
    Create
</a>
<hr>
<ul class="list-group">
    @foreach ($categories as $category)
    <li class="list-group-item {{ !isset($category->parent->name) ? 'active' : ''}}" style="{{ isset($category->parent->name) ? 'margin-left: 40px' : ''}}">
        <i class="{{ !isset($category->parent->name) ? 'fas fa-fw fa-th-list' : ''}}">
        </i>
        {{ $category->name != null ? $category->name : $category->parent->name }}
        <a href="{{ route('admin.categories.confirmDestroy', $category->id) }}">
            <i class="fas fa-trash operator"></i>
        </a>
        <a href="{{ route('admin.categories.edit', $category->id) }}">
            <i class="fas fa-edit operator"></i>
        </a>
    </li>
    @endforeach
</ul>
@endsection

@section('css')
<style>
    .operator {
        float: right;
        padding: 0 10px;
    }
    .active {
        font-weight: 700;
    }
    a {
        color: inherit;
    }
    a:hover {
        color: inherit;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@stop
</hr>
