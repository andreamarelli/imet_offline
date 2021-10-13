export default {

    data: function () {
        return {
            are_checked_all: false,
            checkboxes: [],
            listItems: [],
            itemsToChecked: 0
        }
    },

    mounted: function () {

        this.$root.$on('reset_checkboxes', () => {
            this.clearSelections();
        });
    },

    methods: {
        selectValue: function (value) {
            if (this.checkboxes.includes(value)) {
                this.checkboxes = this.checkboxes.filter(item => item !== value);
            } else {
                this.checkboxes.push(value);
                this.selected();
            }
        },
        is_value_included(id) {
            return this.checkboxes.some(check => {
                return parseInt(check.id) === id}
            )
        },
        selectValueByIdAndValue: function (id, value) {
            if (this.is_value_included(id)) {
                this.checkboxes = this.checkboxes.filter(item => item.id !== id);
            } else {
                this.checkboxes.push({id, value});

            }
            this.selected();
        },
        selected: function () {
            this.$root.$emit('actionData', JSON.stringify(this.checkboxes));
        },
        initSettings: function (items) {
            this.listItems = items;
        },
        toggle: function () {
            this.saveDisabled = this.checkboxes.length === 0;
        },
        is_checked(id){
            return this.checkboxes.some(checkbox => parseInt(checkbox.id) === id);
        },
        check_all: function () {
            if (!this.are_checked_all) {
                const checkboxes = [...document.querySelectorAll(".vue-checkboxes")];
                for (const key in checkboxes) {
                    if (key > 0) {
                        const check_box = checkboxes[key];
                        const exist = this.is_value_included(parseInt(check_box.defaultValue));
                        if(!exist) {
                            this.checkboxes.push({
                                id: check_box.defaultValue,
                                value: check_box.getAttribute('data-name')
                            });
                        }
                    }
                }
            } else {
                this.clearSelections();
            }
            this.selected();
        },
        clearSelections: function () {
            this.checkboxes = [];
            this.are_checked_all = false;
        }
    }

}
