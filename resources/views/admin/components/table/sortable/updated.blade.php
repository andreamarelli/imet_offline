<?php
$model = $list->count()>0 ? $list->first() : \App\Models\Components\EntityModel::class;
?>

@include('admin.components.table.sortable.link', ['column' => $model::UPDATED_AT, 'label' => trans('entities.common.last_update_date')])