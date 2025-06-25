<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryService
{
    /**
     * Sube un archivo a Cloudinary y retorna la URL segura
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return string URL segura de la imagen
     */
    public function upload($file, $folder = 'local-connect', $options = [])
    {
        $defaultOptions = [
            'folder' => $folder,
            'resource_type' => 'image',
            'overwrite' => true,
        ];
        $uploadOptions = array_merge($defaultOptions, $options);
        $uploaded = Cloudinary::upload($file->getRealPath(), $uploadOptions);
        return $uploaded->getSecurePath();
    }
}
