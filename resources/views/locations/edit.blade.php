@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Standort</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('location.update', ['id' => $location->id ]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $location->name ) }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-4 control-label">Strasse</label>
                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control" name="street" value="{{ old('street', $location->street ) }}">

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                                <label for="zip" class="col-md-4 control-label">PLZ</label>
                                <div class="col-md-6">
                                    <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip', $location->zip) }}">

                                    @if ($errors->has('zip'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Ort</label>
                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city', $location->city) }}">

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('member_max') ? ' has-error' : '' }}">
                                <label for="member_max" class="col-md-4 control-label">Anzahl Plätze</label>
                                <div class="col-md-6">
                                    <input id="member_max" type="text" class="form-control" name="member_max" value="{{ old('member_max', $location->member_max) }}">

                                    @if ($errors->has('member_max'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('member_max') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="member_current" class="col-md-4 control-label">Anzahl besetzte Plätze</label>
                                <div class="col-md-6">
                                    <input id="member_current" type="text" readonly class="form-control" name="member_current" value="{{ count($location->members) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                    </button>
                                    <a href="{{ route('location.index') }}" class="btn btn-default">
                                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Abbrechen
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title pull-left">
                            Märkte
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('market.create', ['id' => $location->id]) }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Markt</th>
                                    <th>Beginn</th>
                                    <th>Ende</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($location->markets as $market)
                                    <tr class="clickable-row" data-href='{{ route('market.edit', ['locationId' => $location->id, 'id' => $market->id ]) }}'>
                                        <td>{{ $market->name }}</td>
                                        <td>{{ (new \Carbon\Carbon($market->start_date))->format('d.m.y') }}</td>
                                        <td>{{ (new \Carbon\Carbon($market->end_date))->format('d.m.y') }}</td>
                                        <td>
                                            <form method="post" action="{{ route('market.delete', ['id' => $market->id, 'locationId' => $location->id]) }}">
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