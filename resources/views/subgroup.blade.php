    @foreach([] as $var)
        <!-- siblings before -->
    @endforeach

    @if ($subgroup->children)
        <li>
            <a href="/?group={{ $subgroup->id }}">{{ $subgroup->name }}</a>
            <span>{{ $subgroup->groupProductsCount() }}</span>
            <ul>
                @foreach ($subgroup->children as $subgroup)
                    @if(
                        $subgroup->id == $id_group
                        || $subgroup->id_parent == $id_group
                        || array_search($id_group, $subgroup->groupIds()) !== false
                              || $subgroup->id_parent == $id_parent
                              || array_search($subgroup->id, $parentSiblings) !== false
                        )
                        @include('subgroup', ['subgroup' => $subgroup])
                    @endif
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a href="/?group={{ $subgroup->id }}">{{ $subgroup->name }}</a>
            <span>{{ $subgroup->groupProductsCount() }}</span>
        </li>
    @endif

    @foreach([] as $var)
        <!-- siblings after -->
    @endforeach

{{--@if()--}}
{{--    --}}{{-- siblings--}}
{{--@endif--}}
