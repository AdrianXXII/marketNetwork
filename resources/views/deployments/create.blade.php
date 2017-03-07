@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Adressen</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('deployment.save') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titel</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Beschreibung</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('employee') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Mitarbeiter</label>
                            <div class="col-md-6">
                                <input id="employee" type="text" class="form-control" name="employee" value="{{ old('employee') }}">

                                @if ($errors->has('employee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('employee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('deployment_date') ? ' has-error' : '' }}">
                            <label for="deployment_date" class="col-md-4 control-label">Einsatzdatum</label>
                            <div class="col-md-6">
                                <div class="input-group" id="deployment-date-datepicker">
                                    <input id="deployment_date" type="text" placeholder="2017-03-25" class="form-control" name="deployment_date" value="{{ old('deployment_end' ) }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                     </span>
                                </div>

                                @if ($errors->has('deployment_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deployment_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('deployment_start') ? ' has-error' : '' }}">
                            <label for="deployment_start" class="col-md-4 control-label">Einsatzstart</label>
                            <div class="col-md-6">
                                <div class="input-group" id="deployment-star-timepicker">
                                    <input id="deployment_start" type="text" placeholder="7:20 PM" class="form-control" name="deployment_start" value="{{ old('deployment_date') }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                     </span>
                                </div>

                                @if ($errors->has('deployment_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deployment_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('deployment_end') ? ' has-error' : '' }}">
                            <label for="deployment_end" class="col-md-4 control-label">Ensatzendet</label>
                            <div class="col-md-6">
                                <div class="input-group" id="deployment-end-timepicker">
                                    <input id="deployment_end" type="text" placeholder="10:20 PM" class="form-control" name="deployment_end" value="{{ old('deployment_end' ) }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                     </span>
                                </div>


                                @if ($errors->has('deployment_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deployment_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                            <label for="cost" class="col-md-4 control-label">Kosten</label>
                            <div class="col-md-6">
                                <input id="cost" type="text" class="form-control" name="cost" value="{{ old('cost') }}">

                                @if ($errors->has('cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                </button>
                                <a href="{{ route('deployment.index') }}" class="btn btn-default">
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