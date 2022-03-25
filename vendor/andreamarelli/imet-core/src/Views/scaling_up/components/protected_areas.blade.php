<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'imet-core::analysis_report.guidance.list_of_pas'">
    <template slot-scope="container">
        <div id="{{$name}}-image">
            <container_actions :data="container.props" :name="'{{$name}}-image'"
                               :show_comments="false"
                               :event_image="'save_entire_block_as_image'"
                               :exclude_elements="'{{$exclude_elements}}'">
                <template>
                    @foreach($custom_items as $key => $pa)
                        <div class="row justify-content-center mb-2">
                            <div class="col-5">{{ $protected_areas['models'][$pa->FormID]->name }} - {{ $protected_areas['categories'][$pa->FormID] }}</div>
                            <div class="col-1">
                                <div class="ml-auto"
                                     style="background-color: {{ $custom_items[$pa->FormID]->color }};width:30px;height: 20px; ">
                                </div>
                            </div>
                            <div class="col-5">{{ $custom_items[$pa->FormID]->name }}</div>
                        </div>
                    @endforeach
                </template>
            </container_actions>
        </div>
    </template>
</container_section>
