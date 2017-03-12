@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Adressen</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('member.update', ['id' => $member->id ]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $member->name ) }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">Vorname</label>
                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname', $member->firstname ) }}">

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', $member->email ) }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                            <label for="street" class="col-md-4 control-label">Strasse</label>
                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street" value="{{ old('street', $member->street ) }}">

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
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip', $member->zip) }}">

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
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city', $member->city) }}">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                            <label for="tel" class="col-md-4 control-label">Telefonnummer</label>
                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" value="{{ old('tel', $member->tel) }}">

                                @if ($errors->has('tel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('vendor') ? ' has-error' : '' }}">
                            <label for="vendor" class="col-md-4 control-label">Verkäufer</label>
                            <div class="col-md-6">
                                <input id="vendor" type="checkbox" class="form-control member-vendor" {{  old('vendor', $member->vendor) == 1 ? 'checked' : '' }} name="vendor" value="1">

                                @if ($errors->has('vendor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vendor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group vendor-only{{ $errors->has('trialperiode') ? ' has-error' : '' }}{{ old('vendor', $member->vendor) != 1 ? ' hidden' : '' }}">
                            <label for="trialperiode" class="col-md-4 control-label">Probezeit</label>
                            <div class="col-md-6">
                                <input id="trialperiode" type="checkbox" class="form-control" name="trialperiode"  {{  old('trialperiode', $member->trialperiode) == 1 ? 'checked' : '' }} value="1">

                                @if ($errors->has('trialperiode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('trialperiode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group vendor-only{{ $errors->has('abo') ? ' has-error' : '' }}{{ old('vendor', $member->vendor) != 1 ? ' hidden' : '' }}">
                            <label for="abo" class="col-md-4 control-label">Abo</label>
                            <div class="col-md-6">

                                <select name="abo" id="abo" class="form-control">
                                    @foreach($abos as $abo)
                                        <option {{ $abo->id == old('abo', $member->abo_id) ? 'selected' : '' }} value="{{ $abo->id }}">{{ $abo->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('abo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('abo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group vendor-only{{ $errors->has('abo_start') ? ' has-error' : '' }}{{ old('vendor', $member->vendor) != 1 ? ' hidden' : '' }}">
                            <label for="abo_start" class="col-md-4 control-label">Abo Start</label>
                            <div class="col-md-6">
                                <input id="abo_start" type="text" readonly class="form-control" name="abo_start" value="{{ $member->abo_start }}">
                            </div>
                        </div>

                        <div class="form-group vendor-only{{ $errors->has('abo_restart') ? ' has-error' : '' }}{{  $member->vendor != 1 ? ' hidden' : '' }}">
                            <label for="abo_restart" class="col-md-4 control-label">Abo Ermeuern</label>
                            <div class="col-md-6">
                                <input id="abo_restart" type="checkbox" class="form-control member-vendor" {{  old('abo_restart') == 1 ? 'checked' : '' }} name="abo_restart" value="1">

                                @if ($errors->has('abo_restart'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('abo_restart') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" name="save" value="ok" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> OK
                                </button>
                                <button type="submit" name="save" value="save" class="btn btn-info">
                                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                </button>
                                <a href="{{ route('member.index') }}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Abbrechen
                                </a>
                            </div>
                        </div>

                    </form>
                    <hr/>
                    <div class="center-block">
                        <form method="post" action="{{ route('member.delete', ['id' => $member->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger center-block">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Löschen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($member->vendor)
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Visa
                </div>
                <div class="panel-body">
                    <div class="col-lg-2 col-sm-2">
                        <button type="button" data-href="{{ route('visa.create', ['memberId' => $member->id]) }}" class="btn btn-primary visa_create">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Visa
                        </button>
                    </div>
                    <table id="visas" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titel</th>
                                <th>Beschreibung</th>
                                <th>Bestätigung</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member->visas as $visa)
                                <tr data-href="{{ route('visa.update', ['memberId' => $member->id, 'id' => $visa->id]) }}">
                                    <td>
                                        <input class="visa_id" type="hidden" name="visa_id" value="{{ $visa->id }}">
                                        <input class="visa_title form-control" type="text" name="visa_title" value="{{ $visa->title }}">
                                    </td>
                                    <td><textarea class="visa_describe  form-control" name="visa_describe ">{{ $visa->describe  }}</textarea></td>
                                    <td>
                                        <input type="checkbox" class="visa_approved form-control" name="visa_approved"  {{  $visa->approved == 1 ? 'checked' : '' }} value="1">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default visa_save">
                                            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger visa_delete">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Standorte (Anzahl: {{ $member->abo->limit }})</div>
                <div class="panel-body">
                    <table class="table table-stripped">

                        @for($i = 0; $i < $member->abo->limit; $i++ )
                            <tr data-href="{{ route('locationMember.create', ['memberId' => $member->id]) }}">
                                <td>
                                    Standort {{ $i+1 }}
                                </td>
                                <td>
                                    @if(count($member->locations) > $i )
                                        <input type="hidden" class="location_id" value="{{ $member->locations[$i]->id }}">
                                    @else
                                        <input type="hidden" class="location_id" value="0">
                                    @endif
                                    <select class="form-control location-select" name="location">
                                        <option value="0">Ungesetzt</option>
                                        @foreach($locations as $location)
                                            @if(count($member->locations) > $i )
                                                <option {{ $location->id == $member->locations[$i]->id ? 'selected' :'' }} value="{{ $location->id }}">{{ $location->name }}</option>
                                            @else
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection