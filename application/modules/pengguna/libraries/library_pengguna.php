<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library_pengguna {

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	/*
	 |--------------------------------------------------------------------
	 | Status yang menerangkan, apakah ia sudah masuk atau belum
	 | - Jika sudah masuk maka akan ditampilkan kata "Keluar" beserta tautannya
	 | - Jika belum masuk maka akan ditampilkan kata "Masuk" beserta tautannya
	 */

	public function status_masuk()
	{
		//$this->ci->load->model('pengguna/library_sesi');

		$cek_sesi = $this->ci->library_sesi->cek_sesi();

		if($cek_sesi)
		{
			return "<a href=". site_url('pengguna/keluar') .">Keluar</a>";
		}
		else
		{
			return "<a href=". site_url('pengguna/masuk') .">Masuk</a>";
		}
	}
}

/* End of file Library_pengguna.php */