@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Einsätze</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-10">
                                    <form action="{{ route('deployment.index') }}" method="get">
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
                                <a href="{{ route('deployment.create') }}" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New
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
                                    <th>Title</th>
                                    <th>Deployment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deployments as $deployment)
                                    <tr class="clickable-row" data-href='{{ route('deployment.edit', ['id' => $deployment->id ]) }}'>
                                        <td>{{ $deployment->title }}</td>
                                        <td>{{ $deployment->deployment_date }}</td>
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