<?php

namespace Core;

class Route {
  private $routes;

  public function __construct(array $routes) {
    $this->setRoutes($routes);
    $this->run();
  }

  private function setRoutes($routes) {
    foreach ($routes as $route) {
      $routeArray = explode('@', $route[1]);
      $r = [$route[0], $routeArray[0], $routeArray[1]];
      $newRoutes[] = $r;
    }

    $this->routes = $newRoutes;
  }

  private function getRequest() {
    $obj = new \stdClass;

    foreach($_GET as $key => $value) {
      @$obj->get->$key = $value;
    }

    foreach($_POST as $key => $value) {
      @$obj->post->$key = $value;
    }

    return $obj;
  }

  private function getUrl() {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }

  private function run() {
    $url = $this->getUrl();
    $urlArray = explode('/', $url);
    
    foreach ($this->routes as $route) {
      $routeArray = explode('/', $route[0]);
      for ($i = 0; $i < count($routeArray); $i++) {
        if((strpos($routeArray[$i], '{') !== false) && (count($urlArray) == count($routeArray)) && (is_numeric($urlArray[$i]))) {
          $routeArray[$i] = $urlArray[$i];
          $param = $urlArray[$i];
        }
        $route[0] = implode('/', $routeArray);
      }
      if($url == $route[0]) {
        $controller = $route[1];
        $action = $route[2];
        break;
      }
    }

    if(isset($controller)) {
      $controller = Container::newController($controller);
      if(isset($param)) {
        $controller->$action($param, $this->getRequest());
      } else {
        $controller->$action($this->getRequest());
      }
    } else {
      echo "Página não encontrada.";
    }
  }
}