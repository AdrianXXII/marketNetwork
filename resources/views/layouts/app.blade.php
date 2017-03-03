<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MarketNetwork') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'MarketNetwork') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('member.index') }}">Adressen</a></li>
                        <li><a href="{{ route('location.index') }}">Standorte</a></li>
                        <li><a href="{{ route('deployment.index') }}">Einsätze</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registrieren</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });

            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });

            $('[name="vendor"].member-vendor').click(function(){
                $('.vendor-only').toggleClass('hidden');
                console.log('test');
            });

            $('#visas tbody').on('click', '.visa_save', function(){
                var tr = $(this).parents('tr');
                var dHref = tr.data("href");
                var visa = {};
                visa.id = tr.find('.visa_id').prop('value');
                visa.title = tr.find('.visa_title').prop('value');
                visa.describe  = tr.find('.visa_describe ').val();
                visa.approved = tr.find('.visa_approved').prop('checked') == true ? 1 : 0;
                $.ajax({
                    url: dHref,
                    method: 'PUT',
                    data: visa,
                    success: function(data, textStatus, jqXHR){
                        console.log(data);
                        tr.find('.visa_id').prop('value', data.id);
                        tr.find('.visa_title').prop('value', data.title);
                        tr.find('.visa_describe ').val(data.describe );
                        var checked = data.approved == 1 ? true : false;
                        tr.find('.visa_approved').prop('checked', checked);
                    },
                    error: function(jqXHR,textStatus){
                        console.log(jqXHR.responseText);
                        console.log(textStatus);
                    }
                });
            });

            $('.visa_create').click(function(){
                var dHref = $(this).data("href");
                var lastTr = $('#visas tbody tr').last();
                $.ajax({
                    url: dHref,
                    method: 'POST',
                    success: function(data, textStatus, jqXHR){
                        if($('#visas tbody tr').length == 0){
                            console.log('has none');
                            $('#visas tbody').html("<tr data-href='"+ dHref + "/" + data.id + "'>" +
                                    "<td><input class='visa_id' type='hidden' name='visa_id' value='"+data.id + "'><input class='visa_title form-control' type='text' name='visa_title' value='"+data.title+"'></td>" +
                                    "<td><textarea class='visa_describe  form-control' name='visa_describe '>" + data.describe  + "</textarea></td>" +
                                    "<td><input type='checkbox' class='visa_approved form-control' name='visa_approved' " + (data.approved == 1 ? 'checked' : '') + " value='1'></td>" +
                                    "<td><button type='button' class='btn btn-default visa_save'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span></button>" +
                                    "<button type='button' class='btn btn-danger visa_delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td></tr>");
                        } else {
                            var trHref = lastTr.data("href");
                            var tr = lastTr.clone();
                            trHref = trHref.substring(0, trHref.lastIndexOf('/')+1) + data.id;
                            tr.find('.visa_id').prop('value', data.id);
                            tr.find('.visa_title').prop('value', '');
                            tr.find('.visa_describe ').val('');
                            tr.find('.visa_approved').prop('checked', false);
                            tr.prop("data-href", trHref);
                            lastTr.after(tr);
                            $('#visas tbody tr').last().data('href', trHref);
                        }
                    },
                    error: function(jqXHR,textStatus){
                        console.log(jqXHR.responseText);
                        console.log(textStatus);
                    }
                });
            });

            $('#visas tbody').on('click', '.visa_delete', function(){
                var tr = $(this).parents('tr');
                var dHref = tr.data("href");
                var visa = {};
                visa.id = tr.find('.visa_id').prop('value');
                $.ajax({
                    url: dHref,
                    method: 'DELETE',
                    success: function(data, textStatus, jqXHR){
                        console.log(data);
                        tr.remove();
                    },
                    error: function(jqXHR,textStatus){
                        console.log(jqXHR.responseText);
                        console.log(textStatus);
                    }
                });
            });

            $('.location-select').change(function(){
                var tr = $(this).parents('tr');
                var dHref = tr.data("href");
                var method = 'POST';
                var sendData = {};
                sendData.location_id = $(this).prop('value');
                sendData.old_location_id = tr.find('.location_id').prop('value');

                if(sendData.old_location_id == 0){
                    method = 'POST';
                } else {
                    if(sendData.location_id == 0 ){
                        method = 'DELETE';
                    } else {
                        method = 'PUT';
                    }
                }
                console.log(sendData);
                console.log(dHref + " '" + method + "'");
                $.ajax({
                    url: dHref,
                    method: method,
                    data: sendData,
                    success: function(data, textStatus, jqXHR){
                       $(this).prop('value', sendData.location_id);
                    },
                    error: function(jqXHR,textStatus){
                        //console.log(jqXHR.responseText);
                        console.log(textStatus);
                    }
                });
            });

            $('.market-member-create').click(function(){
                var dHref = $(this).data("href") + "/" + $('#market-vendor').prop('value');
                console.log(dHref);
                var sendData = {};
                $.ajax({
                    url: dHref,
                    method: 'PUT',
                    success: function(data, textStatus, jqXHR){
                        if(data.code = 1){
                            var tdName = $(document.createElement('td'));
                            var tdDelete = $(document.createElement('td'));
                            var tr = $(document.createElement('tr'));
                            tdName.text
                            lastTr.after(tr);
                        }
                    }
                });
            });

            $('.market-member-delete').click(function(){
                var tr = $(this).parents('tr');
                var dHref = tr.data("href");
                var sendData = {};
                $.ajax({
                    url: dHref,
                    method: 'DELETE',
                    success: function(data, textStatus, jqXHR){
                        if(data.code = 1){
                            tr.remove();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
