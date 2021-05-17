<template>

    <div>
        <table class="lines">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in api_data">
                    <td>
                        {{ item.name }}
                    </td>
                    <td>
                        {{ item.type }}
                    </td>
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