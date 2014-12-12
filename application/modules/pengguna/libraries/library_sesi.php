<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library_sesi {

	/**/
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('session');
	}
	/**/

	
	# ============== CEK SESI ============== 

	public function cek_sesi()
	{
		if($this->ci->session->userdata('SudahMasuk'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	# ============== SET SESI ============== 

	public function set_sesi($id_pengguna, $halaman_selanjutnya)
	{
		$this->ci->session->set_userdata(array(
			'id_pengguna' => $id_pengguna,
			'SudahMasuk' => TRUE
			)
		);

		redirect($halaman_selanjutnya);
	}

	# ============== HAPUS SESI ============== 

	public function hapus_sesi()
	{
		$this->ci->session->sess_destroy();
		redirect('pengguna/masuk');
	}

	# ============== CARI SESI ============== 

	public function cari_sesi($parameter)
	{
		return $this->ci->session->userdata($parameter);
	}

}