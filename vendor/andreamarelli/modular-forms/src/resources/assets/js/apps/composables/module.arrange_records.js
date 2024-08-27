import {toRaw, unref} from "vue";

export function useArrangeRecords(component_data) {

    const module_type = component_data.module_type;
    const groups = component_data.groups;
    const group_key_field = component_data.group_key_field;
    const accordion_title_field = component_data.accordion_title_field;
    const records = unref(component_data.records);
    const empty_record = unref(component_data.empty_record);

    function accordionTitle(index){
        let group_key = records[index][group_key_field] || null
        let title = toRaw(records[index][accordion_title_field]) || '';
        let title_index = indexInGroup(index, group_key) + 1;
        return title_index + ' - ' + title;
    }

    function recordIsInGroup(record, group_key) {
        if(!record) return false;
        if(module_type.includes('GROUP_')){
            return record[group_key_field] === group_key;
        }
        return true;
    }

    function numRecordsInGroup(group_key) {
        if(module_type.includes('GROUP_')){
            return records.filter(record => record[group_key_field] === group_key).length;
        }
        return records.length;
    }

    function indexInGroup(index, group_key){
        if(module_type.includes('GROUP_')){
            let group_index = 0;
            records.forEach((record, i) => {
                if(record[group_key_field] === group_key && i <= index){
                    group_index++;
                }
            });
            return group_index - 1;
        }
        return index;
    }

    function ensureAteLeastOneRecordPerGroup(){
        if(module_type.includes('GROUP_')) {
            let used_groups = records.map(record => record[group_key_field]);
            let missing_groups = Object.keys(groups).filter(n => !used_groups.includes(n));
            missing_groups.forEach(group_key => {
                addItem(group_key);
            });
        }
    }

    /**
     * Add a new item to the records list (inject group_key if necessary)
     */
    function addItem(group_key = null){
        let new_empty_record = JSON.parse(JSON.stringify(toRaw(empty_record)));
        if(module_type.includes('GROUP_')){
            new_empty_record[group_key_field] = group_key;
        }
        records.push(new_empty_record);
    }

    /**
     * Remove an item from the records list
     */
    function deleteItem(index, event){
        let num_records= module_type.includes('GROUP_')
            ? numRecordsInGroup(records[index][group_key_field])
            : records.length;
        if(num_records > 1){
            records.splice(index, 1);
        } else {
            let new_empty_record = JSON.parse(JSON.stringify(empty_record));
            if(module_type.includes('GROUP_')){
                new_empty_record[group_key_field] = records[index][group_key_field];
            }
            records[index] = new_empty_record;
        }
    }



    return {
        accordionTitle,
        recordIsInGroup,
        numRecordsInGroup,
        ensureAteLeastOneRecordPerGroup,
        addItem,
        deleteItem
    }
}
