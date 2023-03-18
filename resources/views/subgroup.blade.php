<li>{{ $subgroup->name }}</li>
@if ($subgroup->groups)
    <ul>
        @foreach ($subgroup->groups as $group)
            @include('subgroup', ['subgroup' => $group])
        @endforeach
    </ul>
@endif
