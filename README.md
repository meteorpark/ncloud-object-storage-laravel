[![Latest Stable Version](https://poser.pugx.org/meteopark/ncloud-object-storage-laravel/v/stable)](https://packagist.org/packages/meteopark/ncloud-object-storage-laravel)
[![Total Downloads](https://poser.pugx.org/meteopark/ncloud-object-storage-laravel/downloads)](https://packagist.org/packages/meteopark/ncloud-object-storage-laravel)

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

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Meteopark\NcloudObjectStorage\NOSFileUpload;

class FileUploadController extends Controller
{

    public function file(Request $request)
    {
        // $request->files has array ( = files[] )

        $files = (new NOSFileUpload(
                        time(), // default Str::Random(30)
                        "afolder/bfolder",
                        ['png','pdf']
                     ))->move($request->files);
    }
}
 ```

Result

```php
 [
     {
         "org_name": "KakaoTalk_Photo_2019-05-20-18-13-15.png",
         "path": "afolder/bfolder/1559182454.png",
         "mime_type": "image/png",
         "image": {
             "width": 296,
             "height": 40
         }
     },
     {
          "org_name": "test2.pdf",
          "path": "afolder/bfolder/1559182454.pdf",
          "mime_type": "application/pdf",
     }
 ]
 ```