<?php


namespace Meteopark\NcloudObjectStorage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Class NOSFileUpload
 * @package Meteopark\NOSFileUpload
 */
class NOSFileUpload
{
    /**
     *
     */
    const STR_RANDOM_COUNT = 30;
    /**
     * Folder in which to save the file
     * @var string
     */
    private $moveFolder = "";
    /**
     * File name to convert
     * @var string
     */
    private $format = "";
    /**
     * Accessible extensions
     * @var array
     */
    private $arrowExtensions;
    /**
     * Disk name to use
     * @var string
     */
    private $disk = "";

    /**
     * @var bool
     */
    private $is_public = false;


    /**
     * NOSFileUpload constructor.
     * @param string $format
     * @param string $moveFolder
     * @param array $extensions
     * @param string $disk
     * @param bool $is_public
     */
    public function __construct(string $format = "", string $moveFolder = "", array $extensions = ['png', 'jpeg'], string $disk = "ncloud", bool $is_public = true)
    {
        $this->disk = $disk;
        $this->moveFolder = $moveFolder;
        $this->format = $format;
        $this->arrowExtensions = $extensions;
        $this->is_public = $is_public;
    }

    /**
     * @param $files
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
        $receive = [];
        $receive['org_name'] = $file->getClientOriginalName();
        $receive['path'] = $this->uploadToStorage($file);
        $receive['mime_type'] = $file->getClientMimeType();

        if (strpos($receive['mime_type'], "image") !== false) {
            $data = getimagesize($file);
            $receive['image']['width'] = $data[0];
            $receive['image']['height'] = $data[1];
        }

        return $receive;
    }


    /**
     * @param UploadedFile $file
     * @return string
     */
    public function uploadToStorage(UploadedFile $file): string
    {
        $filePath = $this->moveFolder . '/' . $this->setFileName($file);
        Storage::disk($this->disk)->put($filePath, file_get_contents($file), $this->is_public ? 'public' : '');

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
    public function setFileName(UploadedFile $file): string
    {
        if (empty($this->format)) {
            $fileName = Str::random(self::STR_RANDOM_COUNT);
        } else {
            $fileName = $this->format;
        }

        return $fileName .= "." . $file->getClientOriginalExtension();
    }
}
