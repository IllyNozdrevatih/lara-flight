<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';


//class UserTest
//{
//    public int $id;
//  public function __construct(int $id)
//  {
//      var_dump($id);
//        $this->id = $id;
//  }
//}
//
//function test(UserTest $arg)
//{
//    return $arg;
//}
//
//$result = test(new UserTest(1));
//var_dump($result);
// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
