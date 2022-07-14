export default {

    data (){
        return {
            initial: null,
            searchKey: null,
        }
    },

    methods: {

        filterList: function(items){
            items = this.filterByInitial(items);
            return items;
        },

        filterByInitial: function (items) {
            if(this.initial!==null){
                items = items.filter((item) => {
                    if(item.name.charAt(0).toLowerCase() === this.initial.toLowerCase()){
                        return true;
                    }
                });
            }
            return items;
        },

        filterByAttribute: function (items, filter_value, filter_on){
            let _this = this;
            filter_value = filter_value==="" || filter_value==='null' ? null : filter_value;
            if(filter_value!==null){
                items = items.filter((item) => {
                    let value = _this.__getAttribute(item, filter_on);
                    if(value.toString().toLowerCase() === filter_value.toString().toLowerCase()){
                        return true;
                    }
                });
            }
            return items;
        },

        __getAttribute: function (item, attribute){
            let value = null;

            /* More than 1 level deep */
            if(attribute.includes('.')){
                let path = attribute.split('.');
                value = item;
                for (let i = 0; i < path.length; ++i) {
                    value = value.hasOwnProperty(path[i]) ? value[path[i]] : '';
                }
            }
            /* simple attribute */
            else {
                value = item[attribute];
            }

            value = value===null ? '' : value;

            return value;
        }

    }

}