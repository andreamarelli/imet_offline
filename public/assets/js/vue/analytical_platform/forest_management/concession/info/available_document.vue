<template>

    <div>

        <div class="list-key-numbers">
            <div v-for="item in api_data">
                <i class="icon-svg icon-file" />
                <div class="content">
                    <span class="txt">
                        <a target="_blank" :href=item.link> {{ item.name }}</a>
                    </span>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>