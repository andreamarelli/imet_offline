{{-- Save modification--}}

<div v-if="status === 'changed' || status === 'saving'">
    <div class="module-bar error-bar" v-if="warning_on_save!==null">
        <div class="message">
            <i class="fa fa-exclamation-triangle"></i>&nbsp;<span v-html="warning_on_save"></span>
        </div>
    </div>
    <div class="module-bar save-bar" >
        <div class="message">
            {!! ucfirst(trans('modular-forms::common.confirm_save')) !!}
        </div>
        <div class="buttons">
            <button type="button" v-on:click="resetModule" class="btn-nav small red"  v-show="status === 'changed'">{!! ucfirst(trans('modular-forms::common.cancel_modifications')) !!}</button>
            <button type="button" v-on:click="saveModule" class="btn-nav small" v-show="status === 'changed'">{!! ucfirst(trans('modular-forms::common.save')) !!}</button>
            <button type="button" disabled="disabled" class="btn-nav small" v-show="status === 'saving'">&nbsp;&nbsp;<i class="fa fa-spinner fa-pulse"></i>&nbsp;&nbsp;</button>
        </div>
    </div>
</div>

{{-- Saved positive response --}}
<div class="module-bar saved-bar" v-if="status === 'saved'">
    <div class="message">
        {!! ucfirst(trans('modular-forms::common.saved_successfully')) !!}
    </div>
</div>

{{-- Saved negative response --}}
<div class="module-bar error-bar" v-if="status === 'error'">
    <div class="message">
        {!! ucfirst(trans('modular-forms::common.saved_error')) !!}
        <ul class="errors">
            <li v-for="msg in error_messages"><span v-html="msg"></span></li>
        </ul>
    </div>
    </div>
