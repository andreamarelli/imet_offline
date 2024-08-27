<a role="{{ $role }}"
    {{ $attributes->merge(['class' => 'mr-1 btn-nav']) }}
    {{ $href() }}
    {{ $newPage ? 'target="_blank"' : '' }}
>
    {!! $text !!}
</a>
@if($tooltip)
    <tooltip>{{ $tooltip }}</tooltip>
@endif
