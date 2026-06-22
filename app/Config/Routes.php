<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('authenticate', 'Auth::authenticate');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    
    $routes->get('dashboard', 'Dashboard::index');
    
    $routes->group('jenis-layanan', static function ($routes) {
        $routes->get('/', 'JenisLayanan::index');
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
        $routes->get('delete/(:num)', 'Pelanggan::delete/$1');
    });

    $routes->group('transaksi', static function ($routes) {
        $routes->get('/', 'Transaksi::index');
        $routes->get('create', 'Transaksi::create');
        $routes->post('store', 'Transaksi::store');
        $routes->get('show/(:num)', 'Transaksi::show/$1');
        $routes->post('update-status/(:num)', 'Transaksi::updateStatus/$1');
        $routes->get('delete/(:num)', 'Transaksi::delete/$1');
    });

    $routes->get('laporan', 'Laporan::index');

    $routes->group('pengaturan', static function ($routes) {
        $routes->get('/', 'Pengaturan::index');
        $routes->post('update', 'Pengaturan::update');
        $routes->get('profile', 'Pengaturan::profile');
        $routes->post('update-profile', 'Pengaturan::updateProfile');
    });
});
