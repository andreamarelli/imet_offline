{{-- Save modification--}}
<transition
        v-on:before-enter="beforeShowBar"
        v-on:enter="showBar"
        v-on:leave="hideBar"
        v-bind:css="false"
>
    <div v-if="status === 'changed' || status === 'saving'">
        <div class="module-bar error-bar" v-if="warning_on_save!==null">
            <div class="message">
                <i class="fa fa-exclamation-triangle"></i>&nbsp;<span v-html="warning_on_save"></span>
            </div>
        </div>
        <div class="module-bar save-bar" >
            <div class="message">
                {!! ucfirst(trans('common.confirm_save')) !!}
            </div>
            <div class="buttons">
                <button type="button" v-on:click="resetModule" class="btn btn-danger btn-sm"  v-show="status === 'changed'">{!! ucfirst(trans('common.cancel_modifications')) !!}</button>
                <button type="button" v-on:click="saveModule" class="btn btn-success btn-sm" v-show="status === 'changed'">{!! ucfirst(trans('common.save')) !!}</button>
                <button type="button" disabled="disabled" class="btn btn-success btn-sm" v-show="status === 'saving'">&nbsp;&nbsp;<i class="fa fa-spinner fa-pulse"></i>&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</transition>

{{-- Saved positive response --}}
<transition
        v-on:before-enter="beforeShowBar"
        v-on:enter="showBar"
        v-on:leave="hideBar"
        v-bind:css="false"
>
    <div class="module-bar saved-bar" v-if="status === 'saved'">
        <div class="message">
            {!! ucfirst(trans('common.saved_successfully')) !!}
        </div>
    </div>
</transition>

{{-- Saved negative response --}}
<transition
        v-on:before-enter="beforeShowBar"
        v-on:enter="showBar"
        v-on:leave="hideBar"
        v-bind:css="false"
>
    <div class="module-bar error-bar" v-if="status === 'error'">
        <div class="message">
            {!! ucfirst(trans('common.saved_error')) !!}
            <ul class="errors">
                <li v-for="msg in error_messages"><span v-html="msg"></span></li>
            </ul>
        </div>
    </div>
</transition>
