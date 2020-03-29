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
<h1>User list:</h1>
<hr>

<table class="order-table-extend table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Description</th>
            <th>Banned</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr v-pre>
            <td> {{ $user->id }} </td>
            <td> {{ $user->name }} </td>
            <td> {{ $user->email }} </td>
            <td> {{ $user->description }} </td>
            <td> {{ $user->is_ban ? 'Banned' : 'Not banned' }} </td>
            <td>
                @if (!($user->is_ban))
                <a href="{{ route('admin.users.confirmBan', $user->id) }}" class="btn btn-sm btn-danger ban-user">Ban</a>
                @else
                <a href="{{ route('admin.users.confirmUnBan', $user->id) }}" class="btn btn-sm btn-warning ban-user">Un-Ban</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Description</th>
            <th>Banned</th>
            <th></th>
        </tr>
    </tfoot>
</table>
@endsection
