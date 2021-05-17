<template>

    <div>
        <div class="content">

            <data_year :year=api_data.last_year></data_year>
            
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D’ici <span class="highlighted">2017</span>, la <span class="highlighted">stratégie sous régionale</span> est disponible.
                    </span>                
                </div>
                <div>
                    <i class="fas text-base" :class="[api_data.existence ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>                
                </div>                
            </div>

        </div>
    </div>



</template>


<script>

    import base from '../../../../components/_base.mixin';

    export default {

        mixins: [
            base,
        ],

        data: function () {
            return {
                baseUrl: window.Laravel.baseUrl
            }
        }
    }
</script>