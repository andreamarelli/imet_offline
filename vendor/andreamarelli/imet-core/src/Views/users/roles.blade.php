<?php
/** @var \AndreaMarelli\ImetCore\Controllers\UsersController $controller */
/** @var string $role */
/** @var \Illuminate\Database\Eloquent\Collection $users_and_roles */

use \AndreaMarelli\ImetCore\Models\User\Role;

?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    @include('imet-core::users.__menu', ['selected' => $role])

    <div id="users" class="module-container">

        <div class="module-header">
            <div class="module-title col-lg-12">
                {{  ucfirst(trans_choice('imet-core::users.role.'. $role, 2)) }}
            </div>
        </div>

        <div class="module-body">

            <form method="post" action="{{ route('imet-core::users_update') }}">
                @method('PATCH')
                @csrf

                <input type="hidden" name="role_type" value="{{ $role }}" />

                <table class="table module-table">

                    <thead>
                    <tr>
                        <th class="text-center">User</th>
                        @if($role!==Role::ROLE_ADMINISTRATOR)
                            <th class="text-center">Country</th>
                            <th class="text-center">WDPA</th>
                        @endif
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="module-table-item" v-for="(item, index) in records">

                        <!-- user selector -->
                        <td>
                            <selector-user
                                    search-url="{{ route('imet-core::search_users') }}"
                                    v-model="records[index]['user']"
                                    :id="'records_'+index+'_user'"
                                    data-class="field-edit"
                            ></selector-user>
                        </td>

                        @if($role!==Role::ROLE_ADMINISTRATOR)

                            <!-- Country selector -->
                            <td>
                                <dropdown
                                        :multiple="true"
                                        data-values='@json(\AndreaMarelli\ImetCore\Models\Country::selectionList())'
                                        v-model="records[index]['role_isos']"
                                        :id="'records_'+index+'_isos'"
                                        data-class="field-edit"
                                ></dropdown>
                            </td>

                            <!-- WDPA selector -->
                            <td>
                                <selector-wdpa_multiple
                                        search-url="{{ route('imet-core::search_pas') }}"
                                        labels-url="{{ route('imet-core::labels_pas') }}"
                                        v-model="records[index]['role_wdpas']"
                                        :id="'records_'+index+'_wdpas'"
                                        data-class="field-edit"
                                ></selector-wdpa_multiple>
                            </td>

                        @endif


                        <td>
                            <!-- DELETE button -->
                            <span v-if="index < (records.length-1)">
                                @include('modular-forms::buttons.delete_item')
                            </span>
                            <!-- Changed flag -->
                            <input type="hidden"
                                   v-model="records[index]['changed']"
                                   :id="'records_'+index+'_changed'" />
                        </td>

                    </tr>
                    </tbody>
                </table>
            </form>
        </div>

        {{-- save action bars --}}
        @include('modular-forms::module.save_bar')

    </div>

@endsection



@push('scripts')

    <script>
        new Vue({
            el: '#users',

            mixins: [
                window.mixins['status']
            ],

            data: {
                records: @json($users_and_roles),
                empty_record: {
                    'role_isos': null,
                    'role_wdpas': null,
                    'user': null,
                    changed: false
                }
            },

            created: function () {
                this.ensureLastEmpty();
            },

            watch: {

                records:{
                    handler: function () {
                        this.ensureLastEmpty();
                        // this.identifyChanged();
                    },
                    deep: true
                }

            },

            methods: {

                ensureLastEmpty() {
                    if (this.records[this.records.length - 1] !== this.empty_record) {
                        this.records.push(this.empty_record);
                    }
                },

                // identifyChanged(){
                //     let _this = this;
                //     this.records.forEach(function(item, index){
                //         if(_this.records[index] !== _this.records_backup[index]
                //             && _this.records[index] !== _this.empty_record){
                //             console.log('index: ' + index + ' changed');
                //             console.log(_this.records[index]);
                //             console.log(_this.records_backup[index]);
                //         }
                //     });
                // },

                saveData(){

                    let form = this.$el.querySelector('form');
                    let url = form.getAttribute('action');
                    let method = form.getAttribute('method');
                    let form_data = new FormData(form);
                    form_data.append('records', window.ModularForms.Mixins.Payload.encode(this.records));

                    fetch(url, {
                        method: method,
                        body: form_data
                    })
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(data) {
                            console.log('Success:', data);
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                        });
                },

                deleteItem(event){
                    let clicked_button = event.target;
                    let row = clicked_button.closest('tr.module-table-item');
                    let row_index = row.rowIndex;
                    this.records.splice(row_index, 1);
                }

            }

        });
    </script>



@endpush
