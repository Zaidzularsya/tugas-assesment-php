<?php

namespace ZF\App;

class Storage
{
    private $uploadDir;

    public function __construct($uploadDir='/uploads')
    {
        if (!is_dir(BASE_DIR.$uploadDir)) {
            if (!mkdir(BASE_DIR . $uploadDir, 0777, true)) {
                print "Permission denied, please grant to 0775";
            }
        }
        $this->uploadDir = BASE_DIR . $uploadDir;
    }

    public function handleUpload($fileInputName)
    {
        if (!isset($_FILES[$fileInputName])) {
            return ['success' => false, 'message' => 'No file uploaded.'];
        }

        $file = $_FILES[$fileInputName];

        // Validasi jika terjadi error pada unggahan file
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'File upload failed.'];
        }

        // Generate nama unik untuk file
        $fileName = uniqid() . '_' . $file['name'];
        $destination = $this->uploadDir . $fileName;

        // Pindahkan file ke direktori penyimpanan
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return ['success' => true, 'message' => 'File uploaded successfully.', 'fileName' => $fileName];
        } else {
            return ['success' => false, 'message' => 'Failed to move file to destination.'];
        }
    }
}