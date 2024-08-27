
<div {{ $attributes->merge(['class' => 'accordion']) }} {{ isset($id) ? 'id="' . $id . '"' : '' }}>
    {{ $slot }}
</div>
