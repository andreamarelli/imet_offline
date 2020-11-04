@include('admin.components.table.sortable.link', [
    'column' => $list->count()>0 ? $list->first()->getKeyName() : '',
    'label' => trans('entities.common.id')
])