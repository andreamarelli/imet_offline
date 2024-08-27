<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id [optional] */
/** @var String $class [optional] */
/** @var String $rules [optional] */
/** @var String $other [optional] */

/** @var String $module_key [optional] */

use AndreaMarelli\ModularForms\Helpers\DOM;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

$id = $id ?? '';
$class = $class ?? '';
$rules = $rules ?? '';
$other = $other ?? '';

$vue_attributes = DOM::vueAttributes($id, $v_value);
$class_attribute = $class;
$rules_attribute = DOM::rulesAttribute($rules);
$other_attributes = $other ?? '';

?>

{{--  ######  Use given blade template  ###### --}}
@if(Str::contains($type, "blade-")>0)
    @php
        /** @var string $type */
        $component_view = Str::replaceFirst('blade-', '', $type);
        $component_view = Str::replaceFirst('.fields.', '.edit.fields.', $component_view);
    @endphp

    @include($component_view, [
        'v_id' => $id,
        'v_value' => $v_value,
        'class' => $class,
        'other' => $other,
        'rules' => $rules,
        'type' => $type,
        'module_key' => $module_key
    ])

    {{--  ###### disabled ######  --}}
@elseif($type=="disabled")
    <simple-textarea :disabled=true {!! $vue_attributes !!} {!! $rules !!} {!! $other !!}></simple-textarea>


    {{--  ###### hidden ######  --}}
@elseif($type=="hidden")
    <input type="hidden" {!! $vue_attributes !!} {!! $other_attributes !!} />


    {{--  ###### textual simple inputs ######  --}}
@elseif($type=="text")
    <simple-text {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-text>
@elseif($type=="text-area")
    <simple-textarea {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-textarea>
@elseif($type=="url")
    <simple-url {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-url>
@elseif($type=="email")
    <simple-email {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-email>
@elseif($type=="password")
    <simple-password {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-password>
@elseif($type=="date")
    <simple-date {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-date>


    {{--  ###### numeric inputs ######  --}}
@elseif($type=="integer"
    || $type=='numeric'
    || $type=='float'
    || $type=='currency'
    || $type=='code')
    <simple-numeric
        numeric-type="{!! $type !!}" {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-numeric>


    {{--  ###### date ######  --}}
@elseif($type==="date")
    <simple-date {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-date>
@elseif($type==="year")
    <simple-date
        date-type="year" {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-date>
@elseif($type==="dateMaxToday")
    <simple-date
        end-date="{{ date("Y-M-d") }}" {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-date>
@elseif($type==="yearMaxCurrent")
    <simple-date date-type="year"
                 end-date="{{ date("Y") }}-01-01" {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-date>
@elseif($type==="yearMaxPrev")
    <simple-date date-type="year"
                 end-date="{{ date("Y")-1 }}-01-01" {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}></simple-date>

@elseif(Str::contains($type, 'selector-species_animal'))
    <selector-species_animal
        {!! $vue_attributes !!}
        search-url="{{ route('selector.animal.search') }}"
        :with-insert={{ Str::contains($type, 'withInsert') ? 'true' : 'false' }}
    ></selector-species_animal>

    {{--  #######  LISTS #######  --}}
@elseif(substr_count($type, "dropdown")>0
   || substr_count($type, "suggestion")>0
   || substr_count($type, "toggle")>0
   || substr_count($type, "currency-unit")>0
   || substr_count($type, "checkbox")>0)

    @php
        $list_type = SelectionList::getListType($type);
        $cached_list = SelectionList::CacheListInSession($list_type);
    @endphp

    {{-- ## dropdowns ## --}}
    @if(substr_count($type, "dropdown-")>0
        || substr_count($type, "currency-unit")>0)
        <dropdown
            data-values='@json($cached_list)'
            {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
        ></dropdown>
    @elseif(substr_count($type, "suggestion-")>0)
        <dropdown
            data-values='@json($cached_list)'
            :taggable=true
            {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
        ></dropdown>
    @elseif(substr_count($type, "suggestion_multiple-")>0)
        <dropdown
            :taggable=true
            :multiple=true
            data-values='@json($cached_list)'
            {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
        ></dropdown>
    @elseif(substr_count($type, "dropdown_multiple-")>0)
        <dropdown
            :multiple=true
            data-values='@json($cached_list)'
            {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
        ></dropdown>

        {{-- ## toggle ## --}}
    @elseif(substr_count($type, "toggle-")>0)
        <toggle
            data-values='@json($cached_list)'
            {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
        ></toggle>

        {{-- ## checkbox ## --}}
    @elseif(substr_count($type, "checkbox-")>0)
        <checkbox
            @if(Str::contains($type, 'boolean_numeric') || (Str::contains($type, 'boolean') && DB::connection()->getDriverName()==='sqlite'))
                :boolean-numeric=true
            @elseif(Str::contains($type, 'boolean'))
                :boolean=true
            @else
                data-values='@json($cached_list)'
            @endif
            {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
        ></checkbox>
    @endif


    {{--  ###### rating ######  --}}
@elseif(substr_count($type, "rating-")>0)
    <rating
        rating-type="{{ str_replace('rating-', '', $type) }}"
        {!! $vue_attributes !!} data-{!! $class_attribute !!} {!! $rules_attribute !!} {!! $other_attributes !!}
    ></rating>


    {{--  ###### file upload ######  --}}
@elseif($type=="upload")
    <upload
        :max-file-size=85000000
        upload-url="{{ route('upload.file') }}"
        {!! $vue_attributes !!} data-{!! $class_attribute !!} {!! $rules_attribute !!} {!! $other_attributes !!}
    ></upload>

    {{--  ###### text editor ######  --}}
@elseif($type=="text-editor")
    <text-editor {!! $vue_attributes !!}></text-editor>

@else
    <b class="error">Type "{{ $type }}" has not been implemented yet.</b>
@endif
