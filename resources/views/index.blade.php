<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
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
                            <a href="/?group={{ $group->id }}">{{ $group->name }}</a>
                            <span>{{ $group->groupProductsCount() }}</span>

                            @if ($group->children)
                                <ul>
                                    @foreach($group->children as $subgroup)
{{--                                        @if($subgroup->id_parent === $id_parent)--}}
{{--                                            @include('subgroup', ['subgroup' => $subgroup])--}}
{{--                                        @endif--}}

{{--                                        @if($subgroup->id == $id_group || $subgroup->id_parent == $id_group || array_search($id_group, $subgroup->groupIds()) !== false)--}}

                                        @if(
                                            $subgroup->id == $id_group
                                            || $subgroup->id_parent == $id_group
                                            || array_search($id_group, $subgroup->groupIds()) !== false
                                            /*|| $subgroup->id_parent == $id_parent*/
                                            || array_search($subgroup->id, $parentSiblings) !== false

                                            )
                                            @include('subgroup', ['subgroup' => $subgroup])
                                        @endif

                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="products">
                @foreach($products as $product)
                    <div>{{ $product->group->name }}</div>
                @endforeach
            </div>
        </div>
    </body>
</html>
