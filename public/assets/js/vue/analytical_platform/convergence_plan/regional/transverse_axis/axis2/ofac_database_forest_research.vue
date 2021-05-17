<template>

    <div>
        <div class="content">
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt"> 
                        <span class="highlighted">La base des données OFAC</span> fournit des données actualisées sur les résultats de recherche forestière d’ici <span class="highlighted">2020</span>
                    </span>                
                </div>

                <div>
                    <i class="fas text-base fa-check-circle green_base"></i>                
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