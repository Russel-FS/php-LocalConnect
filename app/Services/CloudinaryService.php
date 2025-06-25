<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;
use Throwable;

class CloudinaryService
{
    /**
     * Sube un archivo a Cloudinary y retorna la URL segura
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return string URL segura de la imagen
     */
    public function upload($file, $folder = '', $options = [])
    {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true]
        ]);

        $finalFolder = 'local-connect' . ($folder ? '/' . ltrim($folder, '/') : '');
        $uploadOptions = array_merge([
            'folder' => $finalFolder,
            'resource_type' => 'image',
            'overwrite' => true,
        ], $options);

        try {
            $uploaded = $cloudinary->uploadApi()->upload($file->getRealPath(), $uploadOptions);
            $data = is_object($uploaded) && method_exists($uploaded, 'getArrayCopy')
                ? $uploaded->getArrayCopy()
                : (is_array($uploaded) ? $uploaded : []);
            if (!empty($data['secure_url'])) {
                return $data['secure_url'];
            }
            throw new \Exception('No se recibió secure_url de Cloudinary');
        } catch (Throwable $e) {
            throw new \Exception('Error al subir la imagen a Cloudinary: ' . $e->getMessage());
        }
    }
}
