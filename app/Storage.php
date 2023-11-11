<?php

namespace ZF\App;

class Storage
{
    private $file = null;
    private $uploadDir;
    private $allowedType = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    private $allowedMaxSize = 5 * 1024 * 1024; // Maksimum size 5 MB

    public function __construct($uploadDir='/uploads')
    {
        $this->uploadDir = BASE_DIR . $uploadDir;

        // Pastikan direktori ada
        $this->ensureDirectoryExists();

        // Pastikan direktori dapat ditulisi
        $this->ensureDirectoryWritable();
    }

    public function upload($fileInputName = null)
    {
        if ($fileInputName == null && $this->file == null) {
            return ['success' => false, 'message' => 'No file to upload'];
        }
        
        // Generate nama unik untuk file
        $fileName = uniqid() . '_' . $this->file['name'];
        $destination = $this->uploadDir . '/' . $fileName;

        // Pindahkan file ke direktori penyimpanan
        if (move_uploaded_file($this->file['tmp_name'], $destination)) {
            return ['success' => true, 'message' => 'File uploaded successfully.', 'fileName' => $fileName];
        } else {
            return ['success' => false, 'message' => 'Failed to move file to destination.'];
        }
    }

    public function setType(array $type)
    {
        $this->allowedType = $type;

        return $this;
    }

    public function setMaxSize(int $size)
    {
        $this->allowedMaxSize = $size;
        
        return $this;
    }
    /**
     * Validasi file sebelum upload 
     * 
     * @param string $filename Nama File
     */
    public function validate($fileName)
    {
        $this->file = $_FILES[$fileName];
        
        // Validasi jika terjadi error pada unggahan file
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception("File upload failed Max size 2 MB");
        }

        // Validasi bahwa nama file tidak mengandung tanda '-'
        if (strpos($this->file['name'], '-') !== false) {
            throw new \Exception("File name cannot contain the '-' character.");
        }

        // Validasi ekstensi file
        $allowedExtensions = $this->allowedType;
        $fileExtension = strtolower(pathinfo($this->file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new \Exception("File extension not allowed.");
        }

        // Validasi ukuran file (contoh: maksimum 2 MB)
        $maxFileSize = 2 * 1024 * 1024;
        if ($this->file['size'] > $maxFileSize) {
            throw new \Exception("File size exceeds the maximum limit.");
        }

        return $this;
    }

    private function ensureDirectoryExists()
    {
        if (!is_dir($this->uploadDir) && !mkdir($this->uploadDir, 0775, true))
        {
            throw new \Exception("Failed to create directory: {$this->uploadDir}");
        }
    }

    private function ensureDirectoryWritable()
    {
        if (!is_writable($this->uploadDir) && !chmod($this->uploadDir, 0775))
        {
            throw new \Exception("Failed to make directory writable: {$this->uploadDir}");
        }
    }
}