<?php
namespace ZF\App;

use ZF\App\Kontrak\HttpInterface;
use ZF\App\Http;
class Response extends Http implements HttpInterface
{
    private $statusCode = 200;
    private $headers = [];
    private $body;
    private $queryParams = [];
    private $formData = [];
    private $formFiles;
    protected $method;
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
     * Set status code untuk respons HTTP
     *
     * @param int $statusCode Kode status HTTP
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
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
     * Atur body respons HTTP
     *
     * @param string $body Konten body respons
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Melakukan redirect ke URL tertentu
     *
     * @param string $url URL yang dituju untuk redirect
     */
    public function redirect($url)
    {
        header("Location: " . BASE_URL . "$url");
        exit();
    }

    /**
     * Kirim respons HTTP ke browser
     */
    public function send()
    {
        // Atur status code
        http_response_code($this->statusCode);

        $this->addHeader('Content-Type', 'text/plain');
        // Atur header
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        // Tampilkan body
        echo $this->body;
    }

    public function json(array $data){
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

    public function view($view, $data)
    {
        // Atur status code
        http_response_code($this->statusCode);
        $this->addHeader('Content-Type', 'text/html; charset=UTF-8');

        // Atur header
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        $session = $this->getSession();
        extract($data);
        require "views/".$view.".php";
    }

    /**
     * Forward to controller 
     * 
     * @param   array   [HomeController::class,'index']
     */
    public function forward($callback)
    {
        if (is_array($callback) && count($callback) == 2) {
            // Jika $callback adalah array [namaController, namaMetode]
            $controllerName = $callback[0];
            $methodName = $callback[1];

            // Membuat instance dari controller
            $controller = new $controllerName();

            // Memanggil metode pada controller
            return $controller->$methodName($this->request, $this->response, $this->session);
        } else {
            // Tindakan lain sesuai dengan kebutuhan Anda
            echo "Invalid callback format";
        }
    }
}