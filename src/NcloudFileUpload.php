<?php


namespace Meteopark;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class NcloudFileUpload
{

    private $extensions = [];

    public function __construct(array $extensions = [])
    {
        $this->extensions = $extensions;
    }

    /**
     * @param string $moveFolder
     * @param object $file
     * @return string|null
     */
    public function uploadToStorage(string $moveFolder, UploadedFile $file)
    {
        $filePath = "File Not Allowed";

        if ($this->arrowExtension($file->getClientOriginalExtension())) {

            $filePath = $moveFolder . '/' . time() . $file->getClientOriginalName();
            Storage::disk('ncloud')->put($filePath, file_get_contents($file));
        }

        return $filePath;
    }

    /**
     * @param string $extension
     * @return bool
     */
    private function arrowExtension(string $extension)
    {
        return collect($this->extensions)->search(strtolower($extension));
    }
}
