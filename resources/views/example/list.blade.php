@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if ($results['values'] !== null)
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                @foreach ($results['values'] as $user)
                <div class="panel-body">
                    {{ $user->name }}
                </div>
                @endforeach
            </div>
            {{ $results['values']->links() }}
            @endif
        </div>
    </div>
</div>
@endsection