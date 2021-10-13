export default {

    methods:{

        calculateAverage: function (field, group = null) {
            let sum = 0;
            let count = 0;

            let values = group === null ? this.records : this.records[group];
            values.forEach(function (item) {
                if (item[field] !== null && item[field] !== -99 && item[field] !== '-99') {
                    sum += parseInt(item[field]);
                    count++;
                }
            });
            return count > 0 ? (sum / count).toFixed(2) : 0; // simple average
        },

        sumColumn: function (field, group = null) {
            let sum = 0;
            let values = group === null ? this.records : this.records[group];
            values.forEach(function (item) {
                if (item[field] !== null && item[field] !== "") {
                    sum += parseInt(item[field]);
                }
            });
            sum = sum === 0 ? null : sum; // do not show 0
            return sum;
        },

        sumColumnFloat: function (field, group = null) {
            let sum = 0;
            let tmp = null;
            let pos = null;
            let values = group === null ? this.records : this.records[group];
            values.forEach(function (item) {
                if (item[field] !== null && item[field] !== "") {
                    tmp = item[field];
                    pos = item[field].toString().indexOf(",");
                    if (pos !== -1) {
                        tmp = tmp.replace(",", ".");
                    }
                    sum += parseFloat(tmp);
                }
            });

            sum = sum === 0 ? null : sum; // do not show 0

            if (sum !== null) {
                if (!Number.isInteger(sum)) {
                    sum = sum.toFixed(2);
                }
            }

            return sum;
        },

    }

}