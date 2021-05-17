<template>

    <div>
        <div class="content">

            <span class="txt">
                D’ici <span class="highlighted">2020</span>, des financements nouveaux et additionnels sont captés à travers la mise en œuvre de la stratégie pour la recherche et la mobilisation des financements internationaux.
            </span>

            <chart
                title="Financements nouveaux captés"
                :bars=[api_data.amount]
                unit=""
                ></chart>

            <chart
                title="Financements additionnels captés"
                :bars=[api_data.additional_amount]
                unit=""
                ></chart>

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