
export default {

    CLASS_NAME_SHOWING: 'showing',
    CLASS_NAME_SHOW: 'show',

    toggle (evt){
        let clicked_accordion_item = evt.target.closest('.accordion-item')
        let accordion = clicked_accordion_item.closest('.accordion');
        let is_current_clicked_item_active = clicked_accordion_item.classList.contains(this.CLASS_NAME_SHOW);

        // Close all others
        let accordion_items = accordion.querySelectorAll('.accordion-item');
        accordion_items.forEach((item) => {
            this.close(item);
        });

        // Toggle the clicked item
        if(is_current_clicked_item_active){
            this.close(clicked_accordion_item);
        } else {
            this.open(clicked_accordion_item);
        }
    },

    open (item) {
        let item_body = item.querySelector('.accordion-item-body');
        item_body.style.maxHeight = item_body.scrollHeight + "px";
        item.classList.add(this.CLASS_NAME_SHOWING);
        setTimeout(() => {
            item.classList.add(this.CLASS_NAME_SHOW);
            item.classList.remove(this.CLASS_NAME_SHOWING)
        }, 500);
    },

    close (item){
        item.querySelector('.accordion-item-body').style.maxHeight = null;
        item.classList.remove(this.CLASS_NAME_SHOW)
    }

}
