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

<table id="example" class="table table-striped table-bordered" style="width:100%">
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
                <a href="#" data-user-id="{{ $user->id }}" data-is-ban="{{ $user->is_ban }}" class="btn btn-sm btn-danger ban-user">Ban</a>
                @else
                <a href="#" data-user-id="{{ $user->id }}" data-is-ban="{{ $user->is_ban }}" class="btn btn-sm btn-danger ban-user">Un-Ban</a>
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

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.ban-user').click(function() {
            var url = "{{ route('admin.users.ban') }}";
            var data = {
                'user_id': $(this).data('user-id'),
                'is_ban': $(this).data('is-ban')
            };
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(result) {
                    if (result.status) {
                        if (!data.is_ban) {
                            alert('User has been banned!');
                        } else {
                            alert('User has been un-banned!');
                        }
                        location.reload();
                    }
                },
                error: function() {
                    alert('Some went wrong!');
                    location.reload();
                }
            });
        });
    });
</script>
@endsection