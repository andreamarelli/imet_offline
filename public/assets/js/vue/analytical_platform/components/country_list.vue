<template>

    <div>
        {{ names }}
    </div>

</template>


<script>

import base from './_base.mixin';

export default {

    mixins: [
        base,
    ],

    computed:{

        names: function () {
            let names = [];
            if(typeof this.api_data !== 'undefined' && this.api_data.length > 0){
                this.api_data.forEach(function (iso3) {
                    names.push(window.country_names[iso3])
                });
                names.sort();
                return names.join(', ')
            }
            return null;
        }
    }
}
</script>
