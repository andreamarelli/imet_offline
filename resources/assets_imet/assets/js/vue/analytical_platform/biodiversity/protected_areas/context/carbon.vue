<template>

    <div>

        <div class="list-key-numbers grid_two_cols">
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.protected_area_analytic.carbon.min') }}</span>
                    <span class="number"> {{ api_data[0]| pretty_number  }} </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.protected_area_analytic.carbon.max') }}</span>
                    <span class="number"> {{ api_data[2]| pretty_number  }} </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.protected_area_analytic.carbon.mean') }}</span>
                    <span class="number"> {{ api_data[1]| pretty_number  }} </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.protected_area_analytic.carbon.dev') }}</span>
                    <span class="number"> {{ api_data[3]| pretty_number  }} </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.protected_area_analytic.carbon.sum') }}</span>
                    <span class="number"> {{ api_data[4]| pretty_number  }} </span>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>
