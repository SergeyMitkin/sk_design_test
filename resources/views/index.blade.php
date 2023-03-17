<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test</title>
        <link href="/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="groups">

                <a href="/">Все товары</a>

                <ul>
                @foreach($groups as $group)
                    <li>
                        <a href="#">{{ $group->name }}</a> <span>count</span>
                    </li>
                @endforeach
                </ul>
            </div>

            <div class="products">
                products
            </div>
        </div>
    </body>
</html>
