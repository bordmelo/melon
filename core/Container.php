<?php 

namespace Core;

class Container {
  public static function newController($controller) {
    $controller = "App\\Controllers\\" . $controller;
    return new $controller;
  }
}