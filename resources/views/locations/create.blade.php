@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Standort</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('location.save') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

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
                                    <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}">

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
                                    <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}">

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
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('member_max') ? ' has-error' : '' }}">
                                <label for="tel" class="col-md-4 control-label">Anzahl Plätze</label>
                                <div class="col-md-6">
                                    <input id="member_max" type="text" class="form-control" name="member_max" value="{{ old('member_max') }}">

                                    @if ($errors->has('member_max'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('member_max') }}</strong>
                                    </span>
                                    @endif
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
    </div>
@endsection