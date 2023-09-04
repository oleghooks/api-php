<?php

namespace app\controllers;

use app\controllers\DbController;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter as Router;

abstract class AbstractController
{
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var Request
     */
    protected $request;

    protected $db;

    public function __construct()
    {
        $this->request = Router::router()->getRequest();
        $this->response =  new Response($this->request);
        $this->db = new DbController('mysql', '192.168.0.10', 'vesna', 'vesna', 'vesna', 'utf8', '');
        //$this->db = new DbController('mysql', '127.0.0.1', 'root', '', 'vesna', 'utf8', '');
    }

    public function renderTemplate($template) {
        ob_start();
        include $template;
        return ob_get_clean();
    }

    public function setCors()
    {
        $this->response->header('Access-Control-Allow-Origin: *');
        $this->response->header('Access-Control-Request-Method: OPTIONS');
        $this->response->header('Access-Control-Allow-Credentials: true');
        $this->response->header('Access-Control-Max-Age: 3600');
    }
}