<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Ncloud Object Storage
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish.
    |
    */

    'disks' => [
        'ncloud' => [
            'driver'    => 's3',
            'region'    => 'kr-standard',
            'endpoint'  => 'https://kr.object.ncloudstorage.com',
            'version'   => 'latest',
            'key'       => env('NCLOUD_ACCESS_KEY_ID'),
            'secret'    => env('NCLOUD_SECRET_ACCESS_KEY'),
            'bucket'    => env('NCLOUD_BUCKET'),
        ],
    ],
];