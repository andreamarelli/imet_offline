export default {

    data (){
        return {
            sortBy: null,
            sortDir: 'asc',
        }
    },

    methods: {

        sort: function(sortBy, sortDir = null){
            if(sortBy === this.sortBy && sortDir === null) {
                this.sortDir = this.sortDir==='asc' ? 'desc' : 'asc';
            } else if(this.sortDir !== sortDir){
                this.sortDir = sortDir;
            }
            this.sortBy = sortBy;
            this.pageNumber = 1;
        },

        sortList: function(items){
            return this.sortBy!==null
                ? this.__sorter(items)
                : items;
        },

        __sorter: function(data){
            let _this = this;
            return data.sort(function (a, b) {
                let dir = _this.sortDir==='asc' ? 1 : -1;
                let text_a = _this.__getAttribute(a, _this.sortBy);
                let text_b = _this.__getAttribute(b, _this.sortBy);
                if(typeof text_a !== "undefined" && typeof text_b !== "undefined"){
                    if(text_a.toString().toLowerCase() > text_b.toString().toLowerCase()){ return dir; }
                    if(text_a.toString().toLowerCase() < text_b.toString().toLowerCase()){ return -1*dir; }
                }
                return 0;
            });
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