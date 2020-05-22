<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['berita'] = 'berita';
$route['produk/data'] = 'produk/produk';
$route['produk/kategori'] = 'produk/kategoriProduk';
$route['opt/data'] = 'opt/opt';
$route['opt/kategori'] = 'opt/kategoriOPT';
$route['opt/laporan'] = 'opt/laporanOPT';
$route['tanaman'] = 'tanaman';
$route['tips/data'] = 'tips/tips';
$route['tips/kategori'] = 'tips/kategoriTips';
$route['user'] = 'users/data';
$route['gejala'] = 'gejala';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
