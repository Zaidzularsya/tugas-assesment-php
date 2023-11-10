<?php

namespace ZF\App;

class Request
{
    private $queryParams = [];
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
        header("Location: $url");
        exit();
    }
}