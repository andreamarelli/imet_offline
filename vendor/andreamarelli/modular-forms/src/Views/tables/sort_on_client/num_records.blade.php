
<div class="row num_records">
    <div class="col-lg-7">
        <b>@{{ totalCount }}</b> {{ totalCount==1 ? "<?php echo trans_choice('modular-forms::common.record_found', 1); ?>" :  "<?php echo trans_choice('modular-forms::common.record_found', 2); ?>" }}.
    </div>
    <div class="col-lg-5 text-right">

        <i>@uclang('modular-forms::common.page') @{{ pageNumber }}/ @{{ pageCount }}</i>
        <span v-if="pageCount>1">
            &nbsp;
            <button type="button" class="btn-nav small" v-on:click=prevPage :disabled="pageNumber===1"><i class="fa fa-step-backward"></i></button>
            &nbsp;
            <button type="button" class="btn-nav small" v-on:click=nextPage :disabled="pageNumber>=pageCount"><i class="fa fa-step-forward"></i></button>
        </span>

    </div>
</div>
