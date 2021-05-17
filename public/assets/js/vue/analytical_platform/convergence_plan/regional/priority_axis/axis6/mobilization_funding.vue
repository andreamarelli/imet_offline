<template>

            <div>
                <div class="content">
                    <div class="convergence-plan-2col-indicator">
                        <div>
                            <span class="txt">
                                D’ici <span class="highlighted">2017</span>, au moins <span class="highlighted">01</span> document de <span class="highlighted">stratégie pour la recherche et la mobilisation des financements internationaux</span> est élaboré.
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