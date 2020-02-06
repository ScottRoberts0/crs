<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/','/login');

// Route::get('/routes', function () {
//   $routes = collect(Route::getRoutes())->map(function ($route) {
//       return [
//           'uri' => $route->uri,
//           'as' => $route->action['as'] ?? '',
//           'methods' => $route->methods,
//           'action' => $route->action['uses'] ?? '',
//           'middleware' => $route->action['middleware'] ?? [],
//       ];
//   });

//   return response()->json($routes);
// });
