<?php
namespace ZF\App;

use ZF\App\Request;
use ZF\App\Response;
use ZF\App\Session;

abstract class Http{
    protected $header;
    protected $request;
    protected $response;
    protected $cookie;
    protected $method;
    protected $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->request = new Request();
        $this->response= new Response();
    }

    public function getSession(){
        $this->session = new Session();
        return $this->session;
    }

    abstract public function forward($callback);
}
