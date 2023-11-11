<?php
namespace ZF\App;

use ZF\App\Session;
use ZF\App\Http;

class Route extends Http
{
    protected $callback = null;
    public function __construct()
    {
        // Memanggil konstruktor dari class Http
        parent::__construct();
    }

    /**
     * fungsi untuk menghandli routing setiap method
     * 
     * @param   string namaMethod   (contoh: get, post, put, delete)
     * @param   array  callback controller (contoh: HomeController::class,index)
     */
    public function __call($name, $arguments)
    {
        $this->callback = $arguments[1];
        if ($this->pathValid($arguments[0], $name)) {
            $this->forward($arguments[1]);
        }
    }

    private function pathValid($uri, $methodName)
    {
        if ( (($uri === $_SERVER['PATH_INFO'] || ( !isset($_SERVER['PATH_INFO']) && $uri === '/')) && strtoupper($methodName) === $_SERVER['REQUEST_METHOD']) ) {
            return true;
        }else{
            return false;
        }
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