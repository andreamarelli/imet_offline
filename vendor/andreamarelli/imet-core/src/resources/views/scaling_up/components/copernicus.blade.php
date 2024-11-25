<div v-for="(value, index) in data.props" :id="'{{$name}}-copernicus-'+index"
     class="module-body   border-0">
    <container_actions :data="value" :name="'{{$name}}-copernicus-'+index"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template v-slot:default="data_elements">
            <div class="list-key-numbers">
                <div class="list-head" v-html="index">
                </div>
            </div>
            <div class="module-body  border-0">
                <treemap :values="data_elements.props">
                </treemap>
                <datatable_custom :columns="container.props.config.copernicus.columns"
                                  :values="data_elements.props">
                </datatable_custom>
            </div>
            @include('imet-core::scaling_up.components.copyright_dopa')
        </template>
    </container_actions>
</div>
