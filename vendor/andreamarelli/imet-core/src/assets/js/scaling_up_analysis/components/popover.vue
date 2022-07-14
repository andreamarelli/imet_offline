<template>
        <span class="imet_show_popover ml-2">

            <button class="btn-nav small blue"
                    role="button"
                    data-toggle="popover" data-trigger="focus" data-placement="top"
                    :data-popover-content="'popover_show_'+random_num">
               <span class="fas fa-fw fa-info-circle"></span>
            </button>
            <div :id="'popover_show_'+random_num" style="display: none">
                <div class="popover-heading" style="display: none">
                </div>
                <div class="popover-body ">
                    <div class="module-bar info-bar">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </span>
</template>

<script>
export default {
    name: "popover",
    inject: ['stores', 'config'],
    props: {
        id: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            show_popup: false,
            random_num: 0
        }
    },
    mounted: function () {
        this.random_number();
        this.load_jquery();
    },
    methods: {
        random_number: function(){
            this.random_num = Math.random();
        },
        load_jquery: function () {
            $('[data-toggle="popover"]').popover({
                html: true,
                container: 'body',
                content: function () {
                    return document
                        .getElementById(this.getAttribute('data-popover-content'))
                        .querySelector(".popover-body").innerHTML;
                },
                title: function () {
                    return document
                        .getElementById(this.getAttribute('data-popover-content'))
                        .querySelector(".popover-heading").innerHTML;
                }
            });

        }
    }
}
</script>

