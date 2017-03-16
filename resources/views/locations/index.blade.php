@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Standorte</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-10">
                                <form action="{{ route('location.index') }}" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Suche nach...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" aria-hidden="true" type="submit">
                                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-2 col-sm-2">
                                <a href="{{ route('location.create') }}" class="btn btn-primary">
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
                                <th>Name</th>
                                <th>Strasse</th>
                                <th>Ortschaft</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($locations as $location)
                                <tr class="clickable-row" data-href='{{ route('location.edit', ['id' => $location->id ]) }}'>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->street }}</td>
                                    <td>{{ $location->zip . " " . $location->city }}</td>
                                    <td>
                                        <form method="post" action="{{ route('location.delete', ['id' => $location->id]) }}">
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