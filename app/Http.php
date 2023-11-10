<?php
namespace ZF\App;

class Http{
    protected $server;
    protected $cookie;
    protected $get;
    protected $post;
    protected $request;
    protected $session;

    public function __construct()
    {
        $this->server  = $_SERVER;
        $this->cookie  = $_COOKIE;
        $this->get     = $_GET;
        $this->post    = $_POST;
        $this->request = $_REQUEST;
        $this->session = $_SESSION;
    }

    // Getter
    public function getServer()
    {
        return $this->server;
    }

    public function getCookie()
    {
        return $this->cookie;
    }

    public function getGet()
    {
        return $this->get;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getSession()
    {
        return $this->session;
    }

    // Setter
    public function setServer($server)
    {
        $this->server = $server;
    }

    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }

    public function setGet($get)
    {
        $this->get = $get;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }
}
