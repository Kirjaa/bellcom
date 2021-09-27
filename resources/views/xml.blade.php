<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">

        <title>XML Files Parser</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .main {
                width: 600px;
                margin: 200px auto 0 auto;
            }
        </style>
    </head>
    <body>
    <div class="main">

        <!-- Another variation with a button -->
        <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Search by number of meeting agenda">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="button" id="search-button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>


        <div class="w-100">
            <div class="panel panel-default">
                <div class="panel-body" id="response-block">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#search-button').on('click',function(){
            $value=$('#search').val();
            $.ajax({
                type : 'get',
                url : '/xml/search',
                data:{'search':$value},
                success:function(data){
                    $('#response-block').html(data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

    </body>
</html>
