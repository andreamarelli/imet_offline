<template>
    <span :class=dataClass>
        <select :id=id :name=id>
            <option :value=selectedValue selected="selected">{{ selectedLabel }}</option>
        </select>
    </span>

</template>

<script>
    import dropdown from '../mixins/dropdown.mixin';

    export default {

        mixins: [dropdown],

        mounted() {
            let $elem = $(this.$el);
            $elem.removeClass('field-edit');
            if($elem.hasClass("width100px")){
                $elem.removeClass('width100px');
                $elem.find('span.select2').addClass('width100px').css("width", "");
            }
        },

    }
</script>