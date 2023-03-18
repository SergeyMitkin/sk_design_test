<li>
    <a href="/?group={{ $subgroup->id }}">{{ $subgroup->name }}</a>
    <span>{{ $subgroup->groupProductsCount() }}</span>
    @if ($subgroup->children)
        <ul>
            @foreach ($subgroup->children as $subgroup)
                @include('subgroup', ['subgroup' => $subgroup])
            @endforeach
        </ul>
    @endif
</li>
