<?php 

$route[] = ['/', 'HomeController@index'];
$route[] = ['/posts/{id}/show', 'PostController@show'];
$route[] = ['/posts', 'PostController@index'];

return $route;