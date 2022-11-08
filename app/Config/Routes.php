<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('/login', ['filter' => 'ceklogin'], function(RouteCollection $routes){
    $routes->get('lupa', 'DokterController::viewLupaPassword');
    $routes->get('/', 'DokterController::viewLogin');
    $routes->post('/', 'DokterController::login');
    $routes->patch('/', 'DokterController::lupaPassword');
});
$routes->delete('login', 'DokterController::logout');

$routes->group('dokter',['filter'=> 'login'], function(RouteCollection $routes){
    $routes->get('/', 'DokterController::index');
    $routes->post('/', 'DokterController::store');
    $routes->patch('/', 'DokterController::update');
    $routes->delete('/', 'DokterController::delete');
    $routes->get('(:num)', 'DokterController::show/$1');
    $routes->get('all', 'DokterController::all');

});

$routes->group('poli', function(RouteCollection $routes){
    $routes->get('/', 'PoliController::index');
    $routes->post('/', 'PoliController::store');
    $routes->patch('/', 'PoliController::update');
    $routes->delete('/', 'PoliController::delete');
    $routes->get('(:num)', 'PoliController::show/$1');
    $routes->get('all', 'PoliController::all');

});

$routes->group('polidokter', function(RouteCollection $routes){
    $routes->get('/', 'PoliDokterController::index');
    $routes->post('/', 'PoliDokterController::store');
    $routes->patch('/', 'PoliDokterController::update');
    $routes->delete('/', 'PoliDokterController::delete');
    $routes->get('(:num)', 'PoliDokterController::show/$1');
    $routes->get('all', 'PoliDokterController::all');

});

$routes->group('spesialis', function(RouteCollection $routes){
    $routes->get('/', 'SpesialisController::index');
    $routes->post('/', 'SpesialisController::store');
    $routes->patch('/', 'SpesialisController::update');
    $routes->delete('/', 'SpesialisController::delete');
    $routes->get('(:num)', 'SpesialisController::show/$1');
    $routes->get('all', 'SpesialisController::all');

});

$routes->group('spesialisdokter', function(RouteCollection $routes){
    $routes->get('/', 'SpesialisDokterController::index');
    $routes->post('/', 'SpesialisDokterController::store');
    $routes->patch('/', 'SpesialisDokterController::update');
    $routes->delete('/', 'SpesialisDokterController::delete');
    $routes->get('(:num)', 'SpesialisDokterController::show/$1');
    $routes->get('all', 'SpesialisDokterController::all');

});

$routes->group('jadwalpraktek', function(RouteCollection $routes){
    $routes->get('/', 'JadwalPraktekController::index');
    $routes->post('/', 'JadwalPraktekController::store');
    $routes->patch('/', 'JadwalPraktekController::update');
    $routes->delete('/', 'JadwalPraktekController::delete');
    $routes->get('(:num)', 'JadwalPraktekController::show/$1');
    $routes->get('all', 'JadwalPraktekController::all');

});

$routes->group('petugas',['filter'=> 'login'], function(RouteCollection $routes){
    $routes->get('/', 'PetugasController::index');
    $routes->post('/', 'PetugasController::store');
    $routes->patch('/', 'PetugasController::update');
    $routes->delete('/', 'PetugasController::delete');
    $routes->get('(:num)', 'PetugasController::show/$1');
    $routes->get('all', 'PetugasController::all');

});

$routes->group('pasien',['filter'=> 'login'], function(RouteCollection $routes){
    $routes->get('/', 'PasienController::index');
    $routes->post('/', 'PasienController::store');
    $routes->patch('/', 'PasienController::update');
    $routes->delete('/', 'PasienController::delete');
    $routes->get('(:num)', 'PasienController::show/$1');
    $routes->get('all', 'PasienController::all');

});

$routes->group('pendaftarankonsultasi', function(RouteCollection $routes){
    $routes->get('/', 'PendaftaranKonsultasiController::index');
    $routes->post('/', 'PendaftaranKonsultasiController::store');
    $routes->patch('/', 'PendaftaranKonsultasiController::update');
    $routes->delete('/', 'PendaftaranKonsultasiController::delete');
    $routes->get('(:num)', 'PendaftaranKonsultasiController::show/$1');
    $routes->get('all', 'PendaftaranKonsultasiController::all');

});

$routes->group('rekammedis', function(RouteCollection $routes){
    $routes->get('/', 'RekamMedisController::index');
    $routes->post('/', 'RekamMedisController::store');
    $routes->patch('/', 'RekamMedisController::update');
    $routes->delete('/', 'RekamMedisController::delete');
    $routes->get('(:num)', 'RekamMedisController::show/$1');
    $routes->get('all', 'RekamMedisController::all');

});

$routes->group('tagihan', function(RouteCollection $routes){
    $routes->get('/', 'TagihanController::index');
    $routes->post('/', 'TagihanController::store');
    $routes->patch('/', 'TagihanController::update');
    $routes->delete('/', 'TagihanController::delete');
    $routes->get('(:num)', 'TagihanController::show/$1');
    $routes->get('all', 'TagihanController::all');

});

$routes->group('jasabarang', function(RouteCollection $routes){
    $routes->get('/', 'JasaBarangController::index');
    $routes->post('/', 'JasaBarangController::store');
    $routes->patch('/', 'JasaBarangController::update');
    $routes->delete('/', 'JasaBarangController::delete');
    $routes->get('(:num)', 'JasaBarangController::show/$1');
    $routes->get('all', 'JasaBarangController::all');

});

$routes->group('rinciantagihan', function(RouteCollection $routes){
    $routes->get('/', 'RincianTagihanController::index');
    $routes->post('/', 'RincianTagihanController::store');
    $routes->patch('/', 'RincianTagihanController::update');
    $routes->delete('/', 'RincianTagihanController::delete');
    $routes->get('(:num)', 'RincianTagihanController::show/$1');
    $routes->get('all', 'RincianTagihanController::all');

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
