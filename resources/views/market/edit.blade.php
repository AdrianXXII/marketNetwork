@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Standort</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('market.update', ['locationId' => $locationId, 'id' => $market->id]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $market->name) }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label for="start_date" class="col-md-4 control-label">Ort</label>
                                <div class="col-md-6">
                                    <input id="start_date" type="date" class="form-control" name="start_date" value="{{ old('start_date', (new \Carbon\Carbon($market->start_date))->todatestring()) }}">

                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label for="end_date" class="col-md-4 control-label">Ort</label>
                                <div class="col-md-6">
                                    <input id="end_date" type="date" class="form-control" name="end_date" value="{{ old('end_date', (new \Carbon\Carbon($market->end_date))->todatestring()) }}">

                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('available') ? ' has-error' : '' }}">
                                <label for="available" class="col-md-4 control-label">Verfügen</label>
                                <div class="col-md-6">
                                    <input id="available" type="checkbox" class="form-control" name="available" {{ old('available', $market->available) == 1 ? 'checked' : '' }} value="1">

                                    @if ($errors->has('available'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('available') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                    </button>
                                    <a href="{{ route('location.edit', ['id' => $locationId]) }}" class="btn btn-default">
                                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Abbrechen
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection