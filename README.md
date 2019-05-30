# Ncloud Object Storage for Laravel

<!-- [![Latest Version on Packagist](https://img.shields.io/packagist/v/seungmun/laravel-sens.svg?style=flat-square)](https://packagist.org/packages/seungmun/laravel-sens) -->
<!-- [![Total Downloads](https://img.shields.io/packagist/dt/seungmun/laravel-sens.svg?style=flat-square)](https://packagist.org/packages/seungmun/laravel-sens) -->

It is a package that can easily upload files through Object Storage which is a service provided by Ncloud.

## Installation
``` bash
composer require meteopark/ncloud-object-storage-laravel
```

Set the `filesystems.php`

```bash
<?php

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

And add environment variables.


```bash
NCLOUD_ACCESS_KEY_ID=your-ncloud-access-key-id
NCLOUD_SECRET_ACCESS_KEY=your-ncloud-secret-access-key
NCLOUD_BUCKET=your-ncloud-bucket
```

## Basic Usage

```php

<?php

use

```

```php
```



## Features


