<template>

    <div>

        <button @click="toggle_hidden('list_imet')" class="btn-nav rounded" >
            Liste des IMETS disponibles
        </button>

        <div  v-if="is_hidden_component_visible('list_imet')">
            <div class="row num_records">
                    <b style="color: #00A74B;">{{ api_data.count }}</b> &nbsp;éléments trouvés.
            </div>
            <table class="striped">
                <thead>
                <tr>
                    <th class="text-center">Année</th>
                    <th class="text-center">Aire protégée</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                    <tr v-for="item in api_data.data">
                        <td><strong>{{ item.Year }}</strong></td>
                        <td class="align-baseline">

                            <div class="imet_name">
                                <div class="imet_pa_name">
                                    <strong style="font-size: 1.1em;">{{ item.name }}</strong>
                                    (<a target="_blank" :href="'https://www.protectedplanet.net/'+ item.wdpa_id">{{ item.wdpa_id }}</a>)
                                    <br />
                                    <flag :iso2=item.iso2></flag>&nbsp;&nbsp;<i>{{ item.country_name }}</i>
                                </div>
                                <br />
                                <div>
                                    Langue d'encodage:
                                    <flag :iso2=item.language></flag>
                                </div>

                                <div>
                                    Version :
                                    <span v-if="item.version==='v2'" class="badge badge-success">v2</span>
                                    <span v-else-if="item.version==='v1'" class="badge badge-secondary">v1</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <imet_radar :width=150 :height=150 :values=item.assessment ></imet_radar>
                        </td>

                 </tr>
                </tbody>

            </table>
        </div>
    </div>
</template>

<script>
    import base from './_base.mixin';

    export default {
        mixins: [base]
    }
</script>
