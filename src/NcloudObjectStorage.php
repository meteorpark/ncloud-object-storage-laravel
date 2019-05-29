<?php


namespace Meteopark;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


/**
 * Class NcloudObjectStorage
 * @package Meteopark
 */
class NcloudObjectStorage
{
    /**
     *
     */
    const STR_RANDOM_COUNT = 30;
    /**
     * @var string
     */
    private $moveFolder = "";
    /**
     * @var string
     */
    private $format = "";
    /**
     * @var array
     */
    private $arrowExtensions;
    /**
     * Disk name to use
     * @var string
     */
    private $disk = "";


    /**
     * NcloudObjectStorage constructor.
     * @param string $disk
     * @param string $format
     * @param string $moveFolder
     * @param array $extensions
     */
    public function __construct(string $disk = "ncloud", string $format = "", string $moveFolder = "", array $extensions = ['png', 'jpeg'])
    {
        $this->disk             = $disk;
        $this->moveFolder       = $moveFolder;
        $this->format           = $format;
        $this->arrowExtensions  = $extensions;
    }

    /**
     * @param array $files
     * @return array
     */
    public function move($files)
    {
        $upload_files = [];

        if (!is_null($files)) {
            foreach ($files as $f) {
                if ($this->arrowExtension($f->getClientOriginalExtension()) !== false) {
                    $upload_files[] = $this->receive($f);
                }
            }
        }
        return $upload_files;
    }


    /**
     * @param UploadedFile $file
     * @return array
     */
    public function receive(UploadedFile $file)
    {
        $receive                = [];
        $receive['org_name']    = $file->getClientOriginalName();
        $receive['path']        = $this->uploadToStorage($file);
        $receive['mime_type']   = $file->getClientMimeType();

        if (strpos($receive['mime_type'], "image") !== false) {
            $data = getimagesize($file);
            $receive['image']['width']  = $data[0];
            $receive['image']['height'] = $data[1];
        }

        return $receive;
    }


    /**
     * @param UploadedFile $file
     * @return string
     */
    public function uploadToStorage(UploadedFile $file)
    {
        $filePath = $this->moveFolder . '/' . $this->setFileName($file);
        Storage::disk($this->disk)->put($filePath, file_get_contents($file));

        return $filePath;
    }


    /**
     * @param string $extension
     * @return mixed
     */
    public function arrowExtension(string $extension)
    {
        return collect($this->arrowExtensions)->search(strtolower($extension), true);
    }


    /**
     * @param UploadedFile $file
     * @return string
     */
    public function setFileName(UploadedFile $file)
    {
        if (empty($this->format)) {
            $fileName = Str::random(self::STR_RANDOM_COUNT);
        } else {
            $fileName = $this->format;
        }

        return $fileName .=  ".".$file->getClientOriginalExtension();
    }
}
