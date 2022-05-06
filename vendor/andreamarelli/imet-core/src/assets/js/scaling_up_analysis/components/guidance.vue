<template>
    <div v-if="has_guidance()" class="module-bar info-bar mt-2 mb-2 guidance" style="grid-column: span 2;" id="guidance">
        <div class="icon blue"><span class="fas fa-fw fa-info-circle" style="font-size: 1.4em;"></span></div>
        <div class="message">
            <div>
                <span v-html="stores.BaseStore.localization(text+'.intro')"></span>
                <a href="#" v-on:click.prevent="toggle_more()" v-if="!show_more && key_exist()">show more...</a>
                <a href="#" v-on:click.prevent="toggle_more()" v-else-if="key_exist()">show less</a>
            </div>
            <div class="mt-2" v-if="show_more && key_exist()"
                 v-html="stores.BaseStore.localization(text+'.info')">
            </div>
            <div class="mt-5 p-2 border border-dark" v-if="show_more && key_exist('.table')"
                 v-html="stores.BaseStore.localization(text+'.table')">
            </div>
            <div class="mt-2" v-if="show_more && key_exist('.extra_info')"
                 v-html="stores.BaseStore.localization(text+'.extra_info')">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "guidance",
    inject: ['stores', 'config'],
    props: {
        text: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            show_more: false

        }
    },
    methods: {
        has_guidance() {
            return this.text.length && this.key_exist('.intro');
        },
        key_exist(element = '.info'){
          return this.stores.BaseStore.localization(this.text+element).toUpperCase() !== (this.text+element).toUpperCase();
        },
        toggle_more: function () {
            this.show_more = !this.show_more;
        }

    }
}
</script>
