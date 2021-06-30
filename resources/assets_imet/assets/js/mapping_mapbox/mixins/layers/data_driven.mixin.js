export default {

    mounted(){
        let _this = this;

        // call toggle functions
        window.vueBus.$on('toggleDataLayer', function (checked, layer_id, source_layer_id, layer_paint) {
            _this.toggle(checked, layer_id, source_layer_id, layer_paint);
        });
    },

    methods: {
        toggle(toggle, layer_id, source_layer_id, layer_paint){
            if(toggle){
                this.map.addLayer(
                    {
                        'id': layer_id,
                        'type': 'fill',
                        'source': source_layer_id,
                        'source-layer': source_layer_id,
                        'paint': layer_paint
                    }
                );
            } else {
                this.map.removeLayer(layer_id);
            }
        },
    }
}