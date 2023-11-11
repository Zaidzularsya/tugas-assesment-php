<?php

namespace ZF\App\Kontrak;


interface HttpInterface
{
    /**
     * Mendapatkan metode request (GET, POST, dll.)
     *
     * @return string
     */
    public function getMethod();

    /**
     * Mendapatkan URI request
     *
     * @return string
     */
    public function getUri();

    /**
     * Mendapatkan parameter query dari URL
     *
     * @param string|null $key Kunci parameter yang ingin diambil
     * @return mixed|null
     */
    public function getQuery($key = null);

    /**
     * Mendapatkan data form dari request
     *
     * @param string|null $key Kunci data form yang ingin diambil
     * @return mixed|null
     */
    public function getForm($key = null);

    /**
     * Mendapatkan data file dari request
     *
     * @param string|null $key Kunci data form yang ingin diambil
     * @return mixed|null
     */
    public function getFiles($key = null);

    /**
     * Melakukan redirect ke URL tertentu
     *
     * @param string $url URL yang dituju untuk redirect
     */
    public function redirect($url);

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
