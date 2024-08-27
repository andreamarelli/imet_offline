<template>

    <span>
        <span :class=flagClasses ></span>
        <tooltip>
            {{ countryName }}
        </tooltip>
    </span>

</template>

<script>
    export default {
        props: {
            name :  {
                type: String,
                default: null
            },
            iso2 :  {
                type: String,
                default: null
            },
        },
        computed: {
            countryName: function(){
                return this.name || null;
            },
            flagClasses: function () {
                if(this.iso2===null || this.iso2===''){
                    return '';
                }
                let iso2 = this.iso2.toLowerCase();
                iso2 = iso2==='en' ? 'gb' : iso2;
                iso2 = iso2==='sp' ? 'es' : iso2;
                return 'fi fi-'+iso2;
            }
        }
    }
</script>

<style>


</style>
