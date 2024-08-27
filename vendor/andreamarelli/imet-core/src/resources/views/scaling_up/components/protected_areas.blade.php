<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'imet-core::analysis_report.guidance.list_of_pas'">
    <template slot-scope="container">
        <div id="{{$name}}-image">
            <container_actions :data="container.props" :name="'{{$name}}-image'"
                               :show_comments="false"
                               :event_image="'save_entire_block_as_image'"
                               :exclude_elements="'{{$exclude_elements}}'">
                <template>
                    <table id="short_names" class="table module-table table-bordered">

                        <thead>
                        <tr>
                            <th class="text-center">{{trans('imet-core::analysis_report.name')}}</th>
                            <th class="text-center">{{trans('imet-core::analysis_report.category')}}</th>
                            <th class="text-center">{{trans('imet-core::analysis_report.short_name')}}</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($custom_items as $key => $pa)
                            <tr class="module-table-item">
                                {{--  fields  --}}

                                <td class="text-center width90px border">{{ $protected_areas['models'][$pa->FormID]->name }}
                                </td>
                                <td class="text-center width60px border">{{ $protected_areas['categories'][$pa->FormID] }}
                                </td>
                                <td class="text-center width90px border">
                                    <div class="flex">
                                        <div class="mx-3 h-5 w-5" style="background-color: {{ $custom_items[$pa->FormID]->color }};"></div>
                                        <div> {{ $custom_items[$pa->FormID]->name }}</div>
                                    </div>
                                </td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </template>
            </container_actions>
        </div>
    </template>
</container_section>
