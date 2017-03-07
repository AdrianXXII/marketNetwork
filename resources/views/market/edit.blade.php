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
                                    <div class="input-group" id="market-start">
                                        <input id="start_date" type="text" class="form-control" name="start_date" value="{{ old('start_date', (new \Carbon\Carbon($market->start_date))->toDateString()) }}">
                                        <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>

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
                                    <div class="input-group" id="market-end">
                                        <input id="end_date" type="text" class="form-control" name="end_date" value="{{ old('end_date', (new \Carbon\Carbon($market->end_date))->toDateString()) }}">
                                        <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>

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
                        <hr/>
                        <div class="center-block">
                            <form method="post" action="{{ route('market.delete', ['id' => $market->id, 'locationId' => $locationId]) }}">
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Verkäufer
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="input-group">
                                    <select class="form-control" name="vendors" id="market-vendor">
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->name . " " . $member->firstname }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default market-member-create" data-href="{{ route('marketMember.update',['marketID' => $market->id, 'vendorId' => null]) }}">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Hinzufügen
                                        </button>
                                    </span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                <table class="table table-striped table-hover market-vendor">
                                    <tr>
                                        <th>Verkäufer</th>
                                        <th></th>
                                    </tr>
                                    @foreach($market->members as $member)
                                        <tr class="market-member-{{ $member->id }}" data-href="{{ route('marketMember.delete',['marketID' => $market->id, 'vendorId' => $member->id]) }}">
                                            <td>{{  strlen($member->firstname) > 0 ? $member->firstname . ' ' . $member->name : $member->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger market-member-delete">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection