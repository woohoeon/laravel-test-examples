@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                @if ($results['values'] !== null)
                    <div class="panel panel-default">
                        <div class="panel-heading">Agent</div>
                            <table class="table">
                                    <thead>
                                        <tr>
                                            @foreach($results['build'] as $key => $name)

                                                <td>{{$name}}</td>
                                            @endforeach

                                        </tr>
                                    </thead>
                                <tbody>
                                @foreach ($results['values'] as $count => $agent)
                                    <tr>
                                        @foreach($agent->getAttributes() as $attr => $value)
                                            @if(array_key_exists($attr,$results['build']))
                                                <td>{{$value}}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
