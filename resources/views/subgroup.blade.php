<li>{{ $subgroup->name }}</li>
@if ($subgroup->groups)
    <ul>
        @foreach ($subgroup->groups as $subgroup)
            @include('subgroup', ['subgroup' => $subgroup])
        @endforeach
    </ul>
@endif
