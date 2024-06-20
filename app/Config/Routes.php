<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/beranda', 'Home::beranda');
$routes->get('/dasbor', 'Dasbor::index');

$routes->get('/tes', 'Dasbor::tes');

$routes->get('/login', 'Login::index');
$routes->get('/loginsso', 'Login::loginsso');
$routes->get('/logout', 'Login::logout');

$routes->get('/fetchdata_ptk', 'Home::fetchdata_ptk');

$routes->post('/dasbor/list_provinsi', 'Dasbor::list_provinsi');
$routes->post('/dasbor/list_kabupaten', 'Dasbor::list_kabupaten');
$routes->post('/dasbor/get_data_wilayah', 'Dasbor::get_data_wilayah');

$routes->group('', ['filter' => 'rolefilter'], function ($routes) {
    $routes->get('/data_ptk', 'Home::data_ptk');
});

$routes->group('residu', ['filter' => 'rolefilter'], function ($routes) {
    $routes->get('satminkal', 'Residu::satminkal');
    $routes->get('nuptk', 'Residu::nuptk');
    $routes->get('kepegawaian', 'Residu::kepegawaian');
    $routes->get('kependudukan', 'Residu::kependudukan');
});
