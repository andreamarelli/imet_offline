<template>

    <div>
        <table>
            <thead>
                <tr>
                    <th>{{ Locale.getLabel('form/protected_area.protected_area_analytic.fields.gebco_stdev_m') }}</th>
                    <th>{{ Locale.getLabel('form/protected_area.protected_area_analytic.fields.gebco_max_m') }}</th>
                    <th>{{ Locale.getLabel('form/protected_area.protected_area_analytic.fields.gebco_mean_m') }}</th>
                    <th>{{ Locale.getLabel('form/protected_area.protected_area_analytic.fields.gebco_min_m') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ api_data.gebco_stdev_m | pretty_number }}</td>
                    <td> {{ api_data.gebco_max_m | pretty_number }}</td>
                    <td> {{ api_data.gebco_mean_m | pretty_number }}</td>
                    <td> {{ api_data.gebco_min_m | pretty_number }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<style lang="scss" type="text/scss" scoped>

</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {

        mixins: [base],

        mounted() {
            if(this.api_data!==null){
                let data = [
                    null,
                    this.api_data.gebco_min_m,
                    this.api_data.gebco_mean_m,
                    this.api_data.gebco_max_m,
                    null
                ];
            }else{
                
            }
        },
    }
</script>