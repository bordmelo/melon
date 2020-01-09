<?php 

namespace App\Controllers;

class HomeController {

  private $view;

  public function __construct() {
    $this->view = new \stdClass;
  }

  public function index() {
    $this->view->name = "Lucas Melo";
    require_once __DIR__ . "/../views/home/index.phtml";
  }
}