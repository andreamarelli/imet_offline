<template>
    <div v-if="has_guidance()" class="module-bar info-black-bar mt-2 mb-2" id="guidance">
        <div class="icon blue">
            <span class="fas fa-fw fa-file-alt  " style="font-size: 1.4em;"></span>
        </div>
        <div class="message">
            {{ text }}
        </div>
    </div>
</template>

<script>
export default {
    name: "guidance",
    props: {
        text: {
            type: String,
            default: ''
        }
    },
    methods: {
        has_guidance() {

            return this.text.length;
        },
    }
}
</script>
