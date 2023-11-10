<?php


function loadEnv()
{
    $envFile = __DIR__ . '/.env';
    if (!file_exists($envFile)) {
        throw new \Exception('.env file not found');
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Pisahkan nama variabel dan nilainya
        list($key, $value) = explode('=', $line, 2);

        // Hapus spasi dari kunci dan nilai
        $key = trim($key);
        $value = trim($value);

        // Atur variabel lingkungan
        putenv("$key=$value");
    }
}


class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace('ZF\\', '', $class);
            $classParts = explode('\\', $class);
            $className = array_pop($classParts);
            $classPath = implode('/', array_map('strtolower', $classParts));
            $file = __DIR__ . "/{$classPath}/{$className}.php";
            if (file_exists($file)) {
                require_once $file;
                return true;
            } else {
                return false;
            }
        });
    }
}