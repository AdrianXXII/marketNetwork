@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Markt</div>
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
                                <label for="start_date" class="col-md-4 control-label">Beginn</label>
                                <div class="col-md-6">
                                    <div class="input-group" id="market-start">
                                        <input id="start_date" type="text" class="form-control" name="start_date" value="{{ old('start_date', (new \Carbon\Carbon($market->start_date))->format('d.m.y')) }}">
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
                                <label for="end_date" class="col-md-4 control-label">Ende</label>
                                <div class="col-md-6">
                                    <div class="input-group" id="market-end">
                                        <input id="end_date" type="text" class="form-control" name="end_date" value="{{ old('end_date', (new \Carbon\Carbon($market->end_date))->format('d.m.y')) }}">
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
                                <table class="table table-striped table-hover" id="market-vendor">
                                    <thead>
                                        <tr>
                                            <th>Verkäufer</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($market->members as $member)
                                            <tr class="market-member-{{ $member->id }}" data-href="{{ route('marketMember.delete',['marketID' => $market->id, 'vendorId' => $member->id]) }}">
                                                <td>{{  strlen($member->firstname) > 0 ? $member->name . ' ' . $member->firstname : $member->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger pull-right market-member-delete">
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
            </div>
        </div>
    </div>
@endsection