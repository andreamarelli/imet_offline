<template>
    <div>
        <div class="content">
            
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt"> 
                        D’ici <span class="highlighted">2025</span>, au moins <span class="highlighted">02</span> pôles d’excellence sont créés au niveau régional et opérationnels.
                    </span>                
                    <br>
                    <span> 
                        <span class="highlighted">1- Ecole Régionale Postuniversitaire d’Aménagement et de Gestion intégrés des Forêts et Territoires tropicaux (ERAIFT);</span><br>
                        <span class="highlighted">2- Ecole de Faune de Garoua (EFG);</span><br>
                        <span class="highlighted">3- Ecole Nationale des Eaux et Forêts du Gabon(ENEF);</span>
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=100></gauge_cp>                
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