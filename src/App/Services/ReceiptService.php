<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class ReceiptService
{
    public function __construct(private Database $db)
    {
    }
    public function validateFile(?array $file)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException(['receipt' => ['Failed to upload file']]);
        }
        $maxFileSizeMB = 3 * 1024 * 1024;
        if ($file['size'] > $maxFileSizeMB) {
            throw new ValidationException(['receipt' => ['File size should not be greater then 3 MB']]);
        }
        $originalFileName = $file['name'];

        if (!preg_match('/^[A-Za-z0-9\s._-]+$/', $originalFileName)) {
            throw new ValidationException(['receipt' => ['Invalid file name']]);
        }
        $clientMimeType = $file['type'];
        $allowTypes = ['image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($clientMimeType, $allowTypes)) {
            throw new ValidationException(['receipt' => ['Invalid file type']]);
        }
    }

    public function upload(array $file)
    {
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName =  bin2hex(random_bytes(16)) . "." . $fileExtension;
        dd($newFileName);
    }
}
