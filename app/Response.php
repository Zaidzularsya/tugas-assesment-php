<?php
namespace ZF\App;

class Response
{
    private $statusCode = 200;
    private $headers = [];
    private $body;

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
     * Atur body respons HTTP
     *
     * @param string $body Konten body respons
     */
    public function setBody($body)
    {
        $this->body = $body;
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
}