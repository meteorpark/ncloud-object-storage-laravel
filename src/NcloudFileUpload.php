<?php


namespace Meteopark;

use Illuminate\Http\UploadedFile;

class NcloudFileUpload
{

    private $extensions = [
        'jpg',
        'jpeg',
        'png',
    ];

    public function __construct($extensions = [])
    {
        $this->extensions = $extensions;
    }

    /**
     * @param string $moveFolder
     * @param object $file
     * @return string|null
     */
    public function uploadToStorage(string $moveFolder, object $file)
    {
        $filePath = null;

        if ($this->arrowExtension($file->getClientOriginalExtension())) {

            $filePath = $moveFolder . '/' . time() . $file->getClientOriginalName();
            Storage::disk('ncloud')->put($filePath, file_get_contents($file));
        } else {
            $filePath = "File not allowed";
        }

        return $filePath;
    }
}
