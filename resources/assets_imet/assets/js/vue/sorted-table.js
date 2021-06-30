import filter from './mixins/filter.mixin';
import sorter from './mixins/sorter.mixin';
import paginate from './mixins/paginate.mixin';
import checkboxes from './mixins/checkboxes.mixin';

window.SortedTable = Vue.extend({

    mixins: [
        filter,
        sorter,
        paginate,
        checkboxes
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
