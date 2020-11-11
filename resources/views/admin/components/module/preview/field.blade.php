<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label */

$only_label = $only_label ?? false ;
$list = null;

if($value!==null && $value!==''){
    if($type==="selector-protected_areas_multiple"){
        $values = array_map(function($value) use($type){
            return \App\Library\Ofac\Input\SelectionList::getLabel('ProtectedArea', str_replace('OFAC_', '', $value));
        }, explode(',', $value));
        $value = implode(',', $values);
    }
    if(substr_count($type, "species")>0){
        if(Str::contains($value, '|')){
            $value = implode(' ', array_slice(explode('|', $value), 4, 2));
        }
    }
    elseif(preg_match('/dropdown[\w]*-/', $type)>0){
        $value = \App\Library\Ofac\Input\SelectionList::getLabel($type, $value);
    }
    elseif(preg_match('/[\w]*-yes_no/', $type)>0){
        $value = $value ? 'true' : 'false';
    }
    elseif($type=='numeric' || $type=='currency'){
        $value = number_format($value, 2, ',', ' ');
    }
    elseif($type=='integer'){
        $value = number_format($value, 0, ',', ' ');
    }
}
if(substr_count($type, 'checkbox-')>0 ||
    substr_count($type, "toggle-")>0){
    $list = \App\Library\Ofac\Input\SelectionList::getList($type);
}


?>
@if($type=="hidden")

@elseif(substr_count($type, "dropdown_multiple-")>0
    || Str::endsWith($type, '_multiple'))
    <div class="field-preview">
        @if($value!==null && $value!=='')
            @php
                $values = json_decode($value)===null ? explode(',', $value) : json_decode($value);
            @endphp
            @foreach($values as $v)
                <span class="multiple">{{ $v }}</span>
            @endforeach
        @endif
    </div>

@elseif(substr_count($type, 'checkbox-boolean')>0)
    <span class="checkbox">
        <input type="checkbox" {{ $value ? 'checked="checked"' : '' }}>
        <label></label>
    </span>
@elseif(substr_count($type, 'checkbox-')>0)
    @foreach($list as $item)
        <input type="checkbox" disabled="disabled"
            {{ in_array($item, $value) ? 'checked="checked"' : '' }}
        /> {{ $item }}<br />
    @endforeach

@elseif(substr_count($type, 'toggle-')>0)
    <span class="toggle">
        <span class="btn-group btn-group-sm">
             @foreach($list as $k=>$v)
                 @if((string) $v !== '')
                    <button type="button" value="true" class="btn
                        {{(string) $k === (string)$value ? 'act-btn-active' : 'act-btn-lighter act-btn-basic' }}"
                    >{{ $v }}</button>
                @endif
            @endforeach
        </span>
    </span>

@elseif($type=='upload')
    <div class="field-preview">
        @if($value['original_filename']!==null)
            <a target="_blank" href="{{ $value['download_link'] }}">
                {!! \App\Library\Utils\Template::icon('file') !!} {!! $value['original_filename'] !!}
            </a>
        @else
            &nbsp;
        @endif
    </div>
@elseif(substr_count($type, 'boolean-')>0 || substr_count($type, 'boolean_numeric-')>0)

    <span class="checkbox">
        <input type="checkbox" {{ $value==1 ? 'checked=checked' : '' }} />
        <label></label>
    </span>

@elseif(substr_count($type, "rating-")>0)
    @php
        $ratingType = explode('-', $type);
        $ratingType = end($ratingType);
        $ratingType = str_replace('WithNA', '', $ratingType);
        $ratingType = str_replace('Minus', '-', $ratingType);
        [$min, $max] = explode('to', $ratingType);
    @endphp
    <span ref="ratingOptions" class="rating-container">
        @if( Str::contains($type, 'WithNA'))
            <span class="rating field-edit ratingNa {{ $value=='-99' ? 'active' : '' }}">N/A</span>
        @endif
        @for($i=$min; $i<=$max; $i++)
            <span class="rating field-edit ratingNum {{ $value!==null && $i<=$value ? 'active' : '' }}">{{ $i }}</span>
        @endfor
    </span>


@elseif($only_label)
    {!! $value!==null && $value!=='' ? $value : '&nbsp;' !!}
@elseif($type==='numeric' || $type==='currency' || $type==='integer')
    <div class="field-preview">
        <div class="text-right">
        {!! $value!==null && $value!=='' ? $value : '&nbsp;' !!}
        </div>
    </div>
@else
    <div class="field-preview">
        {!! $value!==null && $value!=='' ? $value : '&nbsp;' !!}
    </div>
@endif
