<!DOCTYPE HTML>
<html>
<head>
    <title>{{ config('app.name') }} - Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="{{ app_asset('css/app.css') }}" media="all"/>
    <script type="text/javascript" src="{{ app_asset('js/app.js') }}"></script>
</head>
<body>
    <a name="jump-top" id="jump-top"></a>

    @include('partial.panel')
    
    <div id="wrapper" class="shadow">
        <div id="main" class="shadow">
            <div class="col-wrap">
                <h1>WoW Characters</h1>
                <h2>
                    A dynamic list of all my wow characters, level 100+.<br>Character data is automatically updated every 12 hours.
                </h2>

                <div class="section">
                    @foreach(App\Character::all() AS $character)
                        {!! $character->render() !!}
                    @endforeach
                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
    <p class="center scrolltop">
        [
        <a href="#jump-top" title="Scroll to Top">
            <small>Back to Top</small>
        </a>
        ]
    </p>
</body>
</html>