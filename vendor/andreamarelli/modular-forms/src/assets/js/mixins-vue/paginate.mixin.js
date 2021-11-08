export default {

    data (){
        return {
            pageNumber: 1,
            pageSize: 4,
            totalCount: 0
        }
    },

    computed: {

        pageCount(){
            return Math.ceil(this.totalCount / this.pageSize);
        }

    },

    methods: {

        paginateList: function(items){
            let _this = this;
            _this.totalCount = items.length;
            if(_this.totalCount > _this.pageSize){
                items = items.filter((row, index) => {
                    let start = (_this.pageNumber - 1) * _this.pageSize;
                    let end = _this.pageNumber * _this.pageSize;
                    if (index >= start && index < end) return true;
                });
            }
            return items;
        },

        isInPage(index){
            const start = (this.pageNumber-1) * this.pageSize,
                end = start + this.pageSize;
            return index >= start && index<end;
        },

        nextPage(){
            this.pageNumber++;
        },

        prevPage(){
            this.pageNumber--;
        },

        goToPage(index){
            this.pageNumber = index;
        },


    }

}