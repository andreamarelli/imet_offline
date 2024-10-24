<?php

namespace AndreaMarelli\ModularForms\Helpers\API\DOPA;

use AndreaMarelli\ModularForms\Helpers\API\API;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class DOPA extends API
{
    use Country;
    use Wdpa;

    public const API_URL = 'https://dopa-services.jrc.ec.europa.eu/services/';

    /**
     * Override: Check if the API metadata response contains error
     */
    protected static function isSuccessful($response): bool
    {
        return parent::isSuccessful($response)
            && !(
                property_exists($response, 'metadata')
                && property_exists($response->metadata, 'error')
                && $response->metadata->error != null
            );
    }

}
