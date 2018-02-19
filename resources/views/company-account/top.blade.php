@extends('layouts.app')

@section('dropdown')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li>
            <a href="{{ route('company.logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('company.logout') }}" method="GET" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Company Dashboard</div>

                <div class="panel-body">
                    @component('components.who')
                    @endcomponent
                </div>
                {{--  <div class="panel-body">
                    <a href="{{ route('showUserProfile') }}">
                        Mypage
                    </a>
                </div>
                <div class="panel-body">
                    <a href="{{ route('indexListExample') }}">
                        List example
                    </a>
                </div>
                <div class="panel-body">
                    <a href="{{ route('indexEntryExample') }}">
                        Entry example
                    </a>
                </div>
                <div class="panel-body">
                    <a href="{{ route('showDetailExample') }}">
                        Detail example
                    </a>
                </div>  --}}
            </div>
        </div>
    </div>
</div>
@endsection
