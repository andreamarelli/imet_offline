<?php
return [

    'settings' => [
        'page_title' => 'Settings',

        'proxy' => [
            'title' => 'Proxy',
            'info' => 'This is required only if the your PC is behind a proxy server.',
            'fields' => [
                'proxy_host' => 'Host',
                'proxy_port' => 'Port',
                'proxy_user' => 'User',
                'proxy_password' => 'Password',
            ]
        ],

        'api_keys' => [
            'title' => 'API keys',
            'fields' => [
                'protected_planet_api_key' => 'Protected Planet API',
            ],
            'protected_planet_api_key_description' => '<b>Required</b> to retrieve protected areas from Protected Planet API. Request a key <a href="https://api.protectedplanet.net/" target="_blank">here</a>',
        ],

        'protected_areas' => [
            'title' => 'Protected Areas',
            'info' => 'A <b>Protected Planet API key</b> is required to retrieve protected areas from Protected Planet API.',
            'api_description' => 'This is required to retrieve protected areas from Protected Planet API.',
            'last_update' => 'Last update',
            'update' => 'Update',
            'download' => 'Download',
        ],

    ],

    'update' => [

        'no_new_version' => 'No new version available',
        'new_version_available' => 'New version available!',
        'update_to_latest' => 'Update to latest version',
        'release_notes' => 'Release notes',
        'release_date' => 'Release date',
        'current_version' => 'Current version',
        'latest_version' => 'Latest version',
        'update_now' => 'Update now',
        'update_later' => 'Update later',
        'require_installation' => 'This update requires an complete re-installation of the software. Please download the installer below. <br /> Backup your IMET assessments before proceeding with the installation.',
        'download_installer' => 'Download installer',
        'downloading' => 'Downloading',
        'download_successful' => 'New version downloaded successfully',
        'download_successful_long' =>
            'New version downloaded successfully.  <br /> Please close completely the application and launch it again
            to apply the updates.',
        'cannot_switch_to_stable' => 'Cannot switch to stable channel',
        'cannot_switch_to_stable_long' =>
            'You cannot switch back to stable channel from the current BETA version. <br /> Some modifications may have
            been applied to the database that are not compatible with the stable version. You will be able to switch back
            to the stable channel when a new stable version, which includes these modifications, is released.',

    ],

    'errors' => [
        'missing_api_token' => 'Missing API token',
        'generic' => 'Request failed',
    ],

];
