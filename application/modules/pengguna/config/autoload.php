<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 |------------------------------------------------------------------------
 | Helper
 |------------------------------------------------------------------------
 */

$autoload['helper'] = array('url'); 

/*
 |------------------------------------------------------------------------
 | Library
 |------------------------------------------------------------------------
 */

$autoload['libraries'] = array(
		'database',
		'session',
		'form_validation',
		'pengguna/library_pengguna',
		'pengguna/library_sesi',
		'halaman/library_kelas',
	); 

/*
 |------------------------------------------------------------------------
 | Model
 |------------------------------------------------------------------------
 */

$autoload['model'] = array('pengguna/model_pengguna');  

/*
 |------------------------------------------------------------------------
 | Konfiguasi
 |------------------------------------------------------------------------
 */

$autoload['config'] = array(
		'pengguna/config',
		'halaman/config'
	); 