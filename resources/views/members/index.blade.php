@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Adressen</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-10">
                                    <form action="{{ route('member.index') }}" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Suche nach...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" aria-hidden="true" type="submit">
                                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                </button>
                                            </span>
                                        </div>

                                        <div class="form-inline">
                                            <label class="checkbox-inline"><input {{ $vendor == 1 ? 'checked' : '' }} type="checkbox" name="vendor" value="1">Verkäufer</label>
                                            <label class="checkbox-inline"><input {{ $trial == 1 ? 'checked' : '' }} type="checkbox" name="trial" value="1">Probezeit</label>
                                        </div>
                                    </form>
                            </div>
                            <div class="col-lg-2 col-sm-2">
                                <a href="{{ route('member.create') }}" class="btn btn-primary">
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
                                    <th>Vorname</th>
                                    <th>Strasse</th>
                                    <th>Ortschaft</th>
                                    <th>Tel</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                    <tr class="clickable-row" data-href='{{ route('member.edit', ['id' => $member->id ]) }}'>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->firstname }}</td>
                                        <td>{{ $member->street }}</td>
                                        <td>{{ $member->zip . " " . $member->city }}</td>
                                        <td>{{ $member->tel }}</td>
                                        <td>{{ $member->email }}</td>
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