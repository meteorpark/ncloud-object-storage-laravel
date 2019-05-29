


# Ncloud Object Storage for Laravel

<!-- [![Latest Version on Packagist](https://img.shields.io/packagist/v/seungmun/laravel-sens.svg?style=flat-square)](https://packagist.org/packages/seungmun/laravel-sens) -->
<!-- [![Total Downloads](https://img.shields.io/packagist/dt/seungmun/laravel-sens.svg?style=flat-square)](https://packagist.org/packages/seungmun/laravel-sens) -->

It is a package that can easily upload files through Object Storage which is a service provided by Ncloud.

## Installation
``` bash
composer require meteopark/ncloud-object-storage
```

The package will automatically register itself.

You can publish the config with:
```bash
    ...
    
'disks' => [
    'ncloud' => [
        'driver'    => 's3',
        'region'    => 'kr-standard',
        'endpoint'  => 'https://kr.object.ncloudstorage.com',
        'version'   => 'latest',
        'key'       => env('NCLOUD_ACCESS_KEY_ID'),
        'secret'    => env('NCLOUD_SECRET_ACCESS_KEY'),
        'bucket'    => env('NCLOUD_BUCKET'),
    ]
]
```

Also, you can use it without publish the config file can be used simply by adding environment variables with:

```bash
NCLOUD_ACCESS_KEY_ID=your-ncloud-access-key-id
NCLOUD_SECRET_ACCESS_KEY=your-ncloud-secret-access-key
NCLOUD_BUCKET=your-ncloud-bucket
```

## Usage

test abcd
```php
<?php

```

```php
```



## Features


