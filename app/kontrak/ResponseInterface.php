<?php

namespace ZF\App\Kontrak;

interface ResponseInterface
{
    /**
     * Set status code untuk respons HTTP
     *
     * @param int $statusCode Kode status HTTP
     */
    public function setStatusCode($statusCode);

    /**
     * Tambahkan header ke respons HTTP
     *
     * @param string $name  Nama header
     * @param string $value Nilai header
     */
    public function addHeader($name, $value);

    /**
     * Atur body respons HTTP
     *
     * @param string $body Konten body respons
     */
    public function setBody($body);

    /**
     * Kirim respons HTTP ke browser
     */
    public function send();

    /**
     * Mengirim respons HTTP dalam format JSON
     *
     * @param array $data Data yang akan diubah menjadi JSON
     */
    public function json(array $data);
}