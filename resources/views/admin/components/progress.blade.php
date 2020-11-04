
    @if($item->{$item::ENCODE_PROGRESS}!==null)
        <p style="padding-top: 5px;">
            <b>{{ ucfirst(trans('common.progress')) }}</b>: {{ $item->{$item::ENCODE_PROGRESS} }} %
        </p>
    @endif
