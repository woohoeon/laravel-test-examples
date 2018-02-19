@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detail Example</div>

                @if ($results['values'] !== null)
                <div class="panel-body">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        {{ $results['values']->name }}
                    </div>
                </div>

                <div class="panel-body">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                        {{ $results['values']->email }}
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
