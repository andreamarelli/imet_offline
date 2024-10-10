<div v-for="(value, index) in data.props" class="module-body  border-0"
     :id="'{{$name}}-terestial-'+index.replace(' ','')">
    <container_actions :data="value" :name="'{{$name}}-terestial-'+index.replace(' ','')"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template v-slot:default="data_elements">
            <div class="list-key-numbers">
                <div class="list-head" v-html="index">
                </div>
            </div>
            <div class="module-body  border-0" :id="'terrestal_'+index.replace(' ','')">
                <datatable_custom
                    :columns="container.props.config.terrestial_ecoregions.columns"
                    :values="value">
                </datatable_custom>
            </div>
            @include('imet-core::scaling_up.components.copyright_dopa')
        </template>
    </container_actions>
</div>

