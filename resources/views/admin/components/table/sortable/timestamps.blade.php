<?php
    $model = $list->count()>0 ? $list->first() : \App\Models\Components\EntityModel::class;
?>

@include('admin.components.table.sortable.link', ['column' => $model::UPDATED_AT, 'label' => trans('entities.common.last_update_date')])
@include('admin.components.table.sortable.link', ['column' => 'update_by_user.last_name', 'label' => trans('entities.common.last_update_by')])
@if($model::CREATED_BY !== null)
    @include('admin.components.table.sortable.link', ['column' => 'created_by_user.last_name', 'label' => trans('entities.common.created_by')])
@endif