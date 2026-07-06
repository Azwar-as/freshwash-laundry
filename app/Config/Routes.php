<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('authenticate', 'Auth::authenticate');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    
    $routes->get('dashboard', 'Dashboard::index');
    
    $routes->get('jenis-layanan', 'JenisLayanan::index');
    $routes->get('jenis-layanan/export-pdf', 'JenisLayanan::exportPdf');
    $routes->group('jenis-layanan', ['filter' => 'role:admin'], static function ($routes) {
        $routes->get('create', 'JenisLayanan::create');
        $routes->post('store', 'JenisLayanan::store');
        $routes->get('edit/(:num)', 'JenisLayanan::edit/$1');
        $routes->post('update/(:num)', 'JenisLayanan::update/$1');
        $routes->get('delete/(:num)', 'JenisLayanan::delete/$1');
    });

    $routes->group('pelanggan', static function ($routes) {
        $routes->get('/', 'Pelanggan::index');
        $routes->get('create', 'Pelanggan::create');
        $routes->post('store', 'Pelanggan::store');
        $routes->get('edit/(:num)', 'Pelanggan::edit/$1');
        $routes->post('update/(:num)', 'Pelanggan::update/$1');
    });
    $routes->get('pelanggan/delete/(:num)', 'Pelanggan::delete/$1', ['filter' => 'role:admin']);

    $routes->group('transaksi', static function ($routes) {
        $routes->get('/', 'Transaksi::index');
        $routes->get('create', 'Transaksi::create');
        $routes->post('store', 'Transaksi::store');
        $routes->get('show/(:num)', 'Transaksi::show/$1');
        $routes->post('update-status/(:num)', 'Transaksi::updateStatus/$1');
    });
    $routes->get('transaksi/delete/(:num)', 'Transaksi::delete/$1', ['filter' => 'role:admin']);

    $routes->group('cart', static function ($routes) {
        $routes->get('/', 'CartController::index');           
        $routes->post('add', 'CartController::add');          
        $routes->post('update', 'CartController::update');    
        $routes->post('remove', 'CartController::remove');    
        $routes->post('destroy', 'CartController::destroy');  
        $routes->get('total', 'CartController::total');       
        $routes->post('checkout', 'CartController::checkout');
    });

    $routes->get('laporan', 'Laporan::index', ['filter' => 'role:admin']);

    $routes->get('pengaturan', 'Pengaturan::index', ['filter' => 'role:admin']);
    $routes->post('pengaturan/update', 'Pengaturan::update', ['filter' => 'role:admin']);
    $routes->get('pengaturan/profile', 'Pengaturan::profile');
    $routes->post('pengaturan/update-profile', 'Pengaturan::updateProfile');
});
