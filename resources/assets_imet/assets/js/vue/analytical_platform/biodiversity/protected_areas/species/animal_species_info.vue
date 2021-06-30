
<template>

    <div>

        <table class="lines">
            <thead>
                <tr>
                    <th>{{ Locale.getLabel('form/protected_area.species') }}</th>
                    <th>{{ Locale.getLabel('form/protected_area.flagship_species') }}</th>
                    <th>{{ Locale.getLabel('form/protected_area.endangered_species') }}</th>
                    <th>{{ Locale.getLabel('form/protected_area.endemic_species') }}</th>
                    <th>{{Locale.getLabel('form/protected_area.exploited_species')}}</th>
                    <th>{{Locale.getLabel('form/protected_area.invasive_species')}}</th>
                    <th>{{Locale.getLabel('form/protected_area.insufficient_data_species')}}</th>
                    <th>{{Locale.getLabel('form/protected_area.iucn_redlist_category')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in api_data">
                    <td>
                        <b>{{ item.species }}</b><br />
                        <i>{{ item.common_name }}</i>
                    </td>
                    <td>
                        <i v-if="item.flagship_species" class="fas fa-check-circle green_base text-base" />
                        <i v-else-if="item.flagship_species===false" class="fas fa-times-circle red_base text-base" />
                    </td>
                    <td>
                        <i v-if="item.endangered_species" class="fas fa-check-circle green_base text-base" />
                        <i v-else-if="item.endangered_species===false" class="fas fa-times-circle red_base text-base" />
                    </td>
                    <td>
                        <i v-if="item.endemic_species" class="fas fa-check-circle green_base text-base" />
                        <i v-else-if="item.endemic_species===false" class="fas fa-times-circle red_base text-base" />
                    </td>
                    <td>
                        <i v-if="item.exploited_species" class="fas fa-check-circle green_base text-base" />
                        <i v-else-if="item.exploited_species===false" class="fas fa-times-circle red_base text-base" />
                    </td>
                    <td>
                        <i v-if="item.invasive_species" class="fas fa-check-circle green_base text-base" />
                        <i v-else-if="item.invasive_species===false" class="fas fa-times-circle red_base text-base" />
                    </td>
                    <td>
                        <i v-if="item.insufficient_data_species" class="fas fa-check-circle green_base text-base" />
                        <i v-else-if="item.insufficient_data_species===false" class="fas fa-times-circle red_base text-base" />
                    </td>
                    <td><redlist_category :category=item.iucn_redlist_category :compact=true /></td>
                </tr>
            </tbody>

        </table>

    </div>

</template>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>
