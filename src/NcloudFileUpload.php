<?php


namespace Meteopark;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Class NcloudFileUpload
 * @package Meteopark
 */
class NcloudFileUpload
{
    const STR_RANDOM_COUNT = 30;

    /**
     * @var string
     */
    protected $moveFolder = "";
    /**
     * @var string
     */
    protected $format = "";
    /**
     * @var array
     */
    protected $arrowExtensions = ['png', 'jpeg'];

    /**
     * NcloudFileUpload constructor.
     * @param string $format
     * @param string $moveFolder
     * @param array $extensions
     */
    public function __construct($format = "", $moveFolder = "", array $extensions = ['png', 'jpeg'])
    {
        $this->moveFolder       = $moveFolder;
        $this->format           = $format;
        $this->arrowExtensions  = $extensions;
    }

    /**
     * @param UploadedFile $files
     * @return array
     */
    public function uploadToStorage(UploadedFile $files)
    {
        $upload_files = [];

        foreach ($files as $file) {
            if ($this->arrowExtension($file->getClientOriginalExtension()) !== false) {
                $upload_files[] = $this->move($this->moveFolder, $file);
            } else {
                $upload_files[] = "File Not Allowed";
            }
        }


        return $upload_files;
    }


    /**
     * @param string $moveFolder
     * @param UploadedFile $file
     * @return string
     */
    public function move(string $moveFolder, UploadedFile $file)
    {
        $filePath = $moveFolder . '/' . $this->setFileName($file);
        Storage::disk('ncloud')->put($filePath, file_get_contents($file));

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
