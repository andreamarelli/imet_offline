<template>

    <span data-toggle="tooltip" data-placement="top" :title=countryName :class=flagClasses ></span>

</template>

<script>
    export default {
        props: {
            name : String,
            iso2 : String,
        },
        computed: {
            countryName: function(){
                return this.name;
            },
            flagClasses: function () {
                let iso2 = this.iso2.toLowerCase();
                iso2 = iso2==='en' ? 'gb' : iso2;
                iso2 = iso2==='sp' ? 'es' : iso2;
                return 'flag-icon flag-icon-'+iso2;
            }
        }
    }
</script>

<style>


</style>