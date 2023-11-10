<?php
namespace ZF\App;

class Session
{
    public function __construct()
    {
        // Memulai session jika belum dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Menyimpan nilai ke dalam session
     *
     * @param string $key   Nama kunci untuk menyimpan nilai
     * @param mixed  $value Nilai yang akan disimpan
     */
    public function set($key, $value=null)
    {
        if (is_array($key)) {
            // Jika parameter pertama adalah array, iterasi dan setiap elemen
            foreach ($key as $k => $v) {
                $_SESSION[$k] = $v;
            }
        } else {
            // Jika parameter pertama adalah string, set pasangan kunci-nilai
            $_SESSION[$key] = $value;
        }
    }

    /**
     * Mengambil nilai dari session berdasarkan kunci
     *
     * @param string $key Nama kunci untuk mengambil nilai
     * @return mixed|null Nilai dari session atau null jika kunci tidak ditemukan
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }


    /**
     * Mengambil semua session
     *
     * 
     * @return mixed|null Nilai dari session atau null jika kunci tidak ditemukan
     */
    public function getAll()
    {
        return isset($_SESSION) ? $_SESSION : null;
    }

    

    /**
     * Menghapus nilai dari session berdasarkan kunci
     *
     * @param string $key Nama kunci untuk menghapus nilai
     */
    public function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Mengakhiri dan menghapus semua data dari session
     */
    public function destroy()
    {
        session_unset();
        session_destroy();
    }
}