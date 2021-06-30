<template>

    <div>

        <button @click="toggle_hidden('list_imet')" class="btn-nav rounded" >
            Nombre d'IMET réalisés par pays
        </button>

        <div  v-if="is_hidden_component_visible('list_imet')" class="list-key-numbers">
            <div class="content">
                <b style="color: #00A74B;">{{ api_data.total }}</b> &nbsp;IMET réalisés.
            </div>
            <table class="striped">
                <thead>
                    <tr>
                        <th>Pays</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(item,value) in api_data.per_country" v-if="item!==null">
                        <td>  {{ value }} </td>
                        <td> {{ item }} </td>
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
