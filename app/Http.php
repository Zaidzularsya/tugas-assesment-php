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
    
    private $basic_auth = [
        'username' => 'zaid',
        'password' => '#{Aplication}'
    ];

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

    public function basicAuth_verify(){
        return ($this->basic_auth['username'] === $_SERVER['PHP_AUTH_USER'] 
                && $this->basic_auth['password'] === $_SERVER['PHP_AUTH_PW']);
    }

    abstract public function forward($callback);
}
