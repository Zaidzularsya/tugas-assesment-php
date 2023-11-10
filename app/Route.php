<?php
namespace ZF\App;

use ZF\App\Session;
use ZF\App\Request;
use ZF\App\Response;

class Route
{
    protected $callback = null;
    private $session;
    private $request;
    private $response;

    public function __construct()
    {
      $this->request = new Request();
      $this->session = new Session();
      $this->response = new Response();
    }

    public function get($uri, $callback)
    {
        $this->callback = $callback;
        if ($this->pathValid($uri, __FUNCTION__)) {
            $this->forward();
        }
    }

    public function post($uri, $callback)
    {
        $this->callback = $callback;
        if ($this->pathValid($uri, __FUNCTION__)) {
            $this->forward();
        }
    }

    public function put($uri, $callback){
        $this->callback = $callback;
        if ($this->pathValid($uri, __FUNCTION__)) {
            $this->forward();
        }
    }

    public function delete($uri, $callback){
        $this->callback = $callback;
        if ($this->pathValid($uri, __FUNCTION__)) {
            $this->forward();
        }
    }

    public function patch($uri, $callback){
        $this->callback = $callback;
        if ($this->pathValid($uri, __FUNCTION__)) {
            $this->forward();
        }
    }

    public function options($uri, $callback){
        $this->callback = $callback;
        if ($this->pathValid($uri, __FUNCTION__)) {
            $this->forward();
        }
    }

    private function pathValid($uri, $methodName)
    {
        // print var_dump($uri === '/');
        if ( (($uri === $_SERVER['PATH_INFO'] || ( !isset($_SERVER['PATH_INFO']) && $uri === '/')) && strtoupper($methodName) === $_SERVER['REQUEST_METHOD']) ) {
            return true;
        }else{
            return false;
        }
    }

    private function forward(){
        if (is_array($this->callback) && count($this->callback) == 2) {
            // Jika $callback adalah array [namaController, namaMetode]
            $controllerName = $this->callback[0];
            $methodName = $this->callback[1];

            // Membuat instance dari controller
            $controller = new $controllerName();

            // Memanggil metode pada controller
            $controller->$methodName($this->request, $this->response, $this->session);
        } else {
            // Tindakan lain sesuai dengan kebutuhan Anda
            echo "Invalid callback format";
        }
    }
}