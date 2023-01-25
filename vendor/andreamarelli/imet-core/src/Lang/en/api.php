<?php

return [
    'error_messages' => [
        'no_combination_found' => 'No records found for the combination of ',
        'mismatch_wdpa_ids_years' => 'wdpa_ids and years key mismatch. The number of keys of wdpa_ids must be equal with years!',
        'mismatch_group_ids_years' => 'group and years key mismatch. The number of keys of group must be equal with years!',
        'something_went_wrong' => 'Please check your querystring something is wrong!',
        'ids_and_years' => 'wdpa_id : {0} for year: {1}',
        'wdpa_ids_missing' => 'wdpa_ids key is missing or value not assigned',
        'group_ids_missing' => 'group_* key is missing or value not assigned',
        'multiple_records_found' => 'Multiple records found!',
        'no_records_found' => 'No records found!',
        'no_protected_areas_found' => 'No records for the requested protected areas found!',
        'more_than_one_protected_areas_found' => 'More than one record with the same wdpa id found. Please add the year parameter to filter the requested record!',
        'page_not_found' => 'Api page not found'
    ]
];
