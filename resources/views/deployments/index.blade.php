@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Einsätze</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-sm-10">
                                    <form action="{{ route('deployment.index') }}" method="get">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-group" id="deployment-search-date">
                                                <input id="date" type="text" class="form-control" name="date" value="{{ $date != null ? (new Carbon\Carbon($date))->format('d.m.Y') : '' }}">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                 </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" placeholder="Suche nach...">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" aria-hidden="true" type="submit">
                                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            <div class="col-lg-2 col-sm-2">
                                <a href="{{ route('deployment.create') }}" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                </a>
                            </div>
                        </div>
                        @if($search)
                            <div class="row">
                                <div class="col-lg-6 col-sm-10">
                                    <p>
                                       Suche nach: {{ $search }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        <br/>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titel</th>
                                    <th>Einsatzdatum</th>
                                    <th>Start</th>
                                    <th>Ende</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deployments as $deployment)
                                    <tr class="clickable-row" data-href='{{ route('deployment.edit', ['id' => $deployment->id ]) }}'>
                                        <td>{{ $deployment->title }}</td>
                                        <td>{{ (new \Carbon\Carbon($deployment->deployment_date))->format('d.m.y') }}</td>
                                        <td>{{ (new \Carbon\Carbon($deployment->deployment_date))->format('H:i') }}</td>
                                        <td>{{ (new \Carbon\Carbon($deployment->deployment_end))->format('H:i') }}</td>
                                        <td>
                                            <form method="post" action="{{ route('deployment.delete', ['id' => $deployment->id]) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger center-block">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection