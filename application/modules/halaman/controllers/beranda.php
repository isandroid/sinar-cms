<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends MX_Controller {

	/*
	 |------------------------------------------------------------------------
	 | Rencana
	 |------------------------------------------------------------------------
	 | 					[*] halaman beranda
	 | 					[ ] halaman kontak
	 |------------------------------------------------------------------------
	 */

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['judul'] 						= 'Aplikasi ' . $this->config->item('aplikasi_nama');
		
		$data['aplikasi_nama'] 				= $this->config->item('aplikasi_nama');
		$data['pengguna_status_masuk']		= $this->library_pengguna->status_masuk();

		$data['beranda_isi'] 				= $this->config->item('beranda_isi');
		$data['beranda_tombol_nama'] 		= $this->config->item('beranda_tombol_nama');
		$data['beranda_tombol_link'] 		= $this->config->item('beranda_tombol_link');

		$data['keterangan_judul_1']			= $this->config->item('keterangan_judul_1');
		$data['keterangan_isi_1'] 			= $this->config->item('keterangan_isi_1');
		$data['keterangan_tombol_nama_1'] 	= $this->config->item('keterangan_tombol_nama_1');
		$data['keterangan_tombol_link_1'] 	= $this->config->item('keterangan_tombol_link_1');

		$data['keterangan_judul_2']			= $this->config->item('keterangan_judul_2');
		$data['keterangan_isi_2'] 			= $this->config->item('keterangan_isi_2');
		$data['keterangan_tombol_nama_2'] 	= $this->config->item('keterangan_tombol_nama_2');
		$data['keterangan_tombol_link_2'] 	= $this->config->item('keterangan_tombol_link_2');

		$data['keterangan_judul_3']			= $this->config->item('keterangan_judul_3');
		$data['keterangan_isi_3'] 			= $this->config->item('keterangan_isi_3');
		$data['keterangan_tombol_nama_3'] 	= $this->config->item('keterangan_tombol_nama_3');
		$data['keterangan_tombol_link_3'] 	= $this->config->item('keterangan_tombol_link_3');

		$data['keterangan_judul_4']			= $this->config->item('keterangan_judul_4');
		$data['keterangan_isi_4'] 			= $this->config->item('keterangan_isi_4');
		$data['keterangan_tombol_nama_4'] 	= $this->config->item('keterangan_tombol_nama_4');
		$data['keterangan_tombol_link_4'] 	= $this->config->item('keterangan_tombol_link_4');

		$this->load->view('kepala', $data);
		$this->load->view('navigasi');
		$this->load->view('beranda', $data);
		$this->load->view('kaki');
	}
}

/* End of file beranda.php */
/* Location: ./modules/halaman/controllers/beranda.php */