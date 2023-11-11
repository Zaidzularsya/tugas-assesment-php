<?php

namespace ZF\App;

use ZF\App\Kontrak\HttpInterface;


class Request implements HttpInterface
{
    private $statusCode = 200;
    private $queryParams = [];
    private $headers = [];
    private $body;
    private $formData = [];
    private $formFiles;
    private $method;
    private $uri;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->queryParams = $_GET;
        $this->formData = $_POST;
        $this->formFiles = $_FILES;
    }

    /**
     * Mendapatkan metode request (GET, POST, dll.)
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Kirim respons HTTP ke browser
     */
    public function send()
    {
        // Atur status code
        http_response_code($this->statusCode);

        // Atur header
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        // Tampilkan body
        echo $this->body;
    }

    public function json(array $data)
    {
        // Atur status code
        http_response_code($this->statusCode);
        $this->addHeader('Content-Type', 'application/json');

        // Atur header
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        // Tampilkan body
        echo json_encode($data);
    }

    /**
     * Atur body respons HTTP
     *
     * @param string $body Konten body respons
     */
    public function setBody($body)
    {
        $this->body = $body;
    }


    /**
     * Set status code untuk respons HTTP
     *
     * @param int $statusCode Kode status HTTP
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Tambahkan header ke respons HTTP
     *
     * @param string $name  Nama header
     * @param string $value Nilai header
     */
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * Mendapatkan URI request
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Mendapatkan parameter query dari URL
     *
     * @param string|null $key Kunci parameter yang ingin diambil
     * @return mixed|null
     */
    public function getQuery($key = null)
    {
        if ($key === null) {
            return $this->queryParams;
        }

        return isset($this->queryParams[$key]) ? $this->queryParams[$key] : null;
    }

    /**
     * Mendapatkan data form dari request
     *
     * @param string|null $key Kunci data form yang ingin diambil
     * @return mixed|null
     */
    public function getForm($key = null)
    {
        if ($key === null) {
            return $this->formData;
        }

        return isset($this->formData[$key]) ? $this->formData[$key] : null;
    }

    /**
     * Mendapatkan data file dari request
     *
     * @param string|null $key Kunci data form yang ingin diambil
     * @return mixed|null
     */
    public function getFiles($key = null)
    {
        if ($key === null) {
            return $this->formFiles;
        }

        return isset($this->formFiles[$key]) ? $this->formFiles[$key] : null;
    }

    /**
     * Melakukan redirect ke URL tertentu
     *
     * @param string $url URL yang dituju untuk redirect
     */
    public function redirect($url)
    {
        header("Location: ".BASE_URL."$url");
        exit();
    }
}