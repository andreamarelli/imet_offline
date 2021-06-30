<template>

    <span>
        <date :date=last_update_date></date>
        <br />
        <i>
            <user :user_name=last_update_by.name :user_id=last_update_by.id></user>
        </i>
    </span>

</template>

<script>
    export default {
        props: {
            last_update_by : {
                type: Object,
                default: () => {}
            },
            last_update_date: {
                type: String,
                default: ''
            },
        }
    }
</script>

<style>


</style>