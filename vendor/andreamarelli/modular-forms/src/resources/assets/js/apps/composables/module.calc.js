import {unref} from "vue";

export function useCalc(component_data) {

    const records = unref(component_data.records);
    const groups = component_data.groups;
    const group_key_field = component_data.group_key_field;

    /**
     * Calculate the simple average of a field (by group if provided)
     */
    function calculateAverage(field, group = null) {
        let sum = 0;
        let count = 0;

        records.forEach(function (item) {
            if ((group == null || item[group_key_field] === group)
                && item[field] !== null
                && item[field] !== -99
                && item[field] !== '-99') {
                    sum += parseInt(item[field]);
                    count++;
            }
        });

        return count > 0
            ? (sum / count).toFixed(2)
            : 0;
    }

    /**
     * Calculate the average of a field for each group
     */
    function calculateGroupsAverages(field) {
        let averages = [];
        Object.keys(groups).forEach(function(group){
            averages[group] = calculateAverage(field, group);
        });
        return averages;
    }

    /**
     * Calculate the sum of a column
     */
    function sumColumn(field, group = null) {
        let sum = 0;

        records.forEach(function (item) {
            if ((group == null || item[group_key_field] === group)
                && item[field] !== null
                && item[field] !== "") {
                    sum += parseInt(item[field]);
            }
        });

        return sum === 0
            ? null
            : sum;
    }

    /**
     * Calculate the sum of a column with float values
     */
    function sumColumnFloat(field, group = null) {
        let sum = 0;
        let tmp = null;
        let pos = null;

        records.forEach(function (item) {
            if ((group == null || item[group_key_field] === group)
                && item[field] !== null
                && item[field] !== "") {
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
    }


    return{
        calculateAverage,
        calculateGroupsAverages,
        sumColumn,
        sumColumnFloat
    }

}
