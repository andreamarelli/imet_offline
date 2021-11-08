window.ModularForms.SortableTable = window.Vue.extend({

    mixins: [
        window.ModularForms.MixinsVue.filter,
        window.ModularForms.MixinsVue.sorter,
        window.ModularForms.MixinsVue.paginate,
        window.ModularForms.MixinsVue.checkboxes
    ] ,

    data: function () {
        return {
            list: null,
            pageSize: 50
        }
    },

    computed: {

        items() {
            let items = this.list;
            items = this.filterList(items);     // from filter mixin
            items = this.sortList(items);       // from sorter mixin
            items = this.paginateList(items);   // from paginate mixin
            return items;
        }

    }

});
