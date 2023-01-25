<template>
    <div>
        <a target="_blank" :href="'http://www.iucnredlist.org/details/' + redlist_id + '/0'">
            <img src="/assets/images/iucn_red_list.png"/>
        </a>
    </div>
</template>


<style lang="scss" scoped>
    a img{
        height: 24px;
    }
</style>

<script>

    export default {
        props: {
            redlist_id: {
                type: [String, Number],
                default: null
            }
        },
    }

</script>
