<?php 

namespace App\Controllers;

use Core\BaseController;

class HomeController extends BaseController {
  public function index() {
    $this->view->name = "Lucas Melo";
    $this->renderView('home/index', 'layout');
  }
}