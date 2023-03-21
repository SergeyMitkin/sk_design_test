<li>
    <a href="/?group={{ $subgroup->id }}">{{ $subgroup->name }}</a>
    <span>{{ $subgroup->groupProducts()->count() }}</span>
    @if ($subgroup->children)
    <ul>
        @foreach ($subgroup->children as $subgroup)
            @if(
                $subgroup->id == $id_group
                || $subgroup->id_parent == $id_group
                || array_search($id_group, $subgroup->childrenIds()) !== false
                || array_search($subgroup->id, $siblingsIds) !== false
                )
                @include('subgroup', ['subgroup' => $subgroup])
            @endif
        @endforeach
    </ul>
    @endif
</li>


