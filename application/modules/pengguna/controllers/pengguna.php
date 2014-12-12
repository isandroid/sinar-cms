<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends MX_Controller {
	
	/*
	 |------------------------------------------------------------------------
	 | Rencana
	 |------------------------------------------------------------------------
	 | 					[*] halaman masuk
	 | 					[*] link keluar
	 | 					[ ] halaman pendaftaran
	 | 					[ ] halaman tambah pengguna
	 | 					[ ] halaman lis pengguna
	 | 					[ ] halaman profil
	 | 					[ ] halaman hapus pengguna 
	 | 					[ ] halaman ubah pengguna
	 |------------------------------------------------------------------------
	 | 					[ ] halaman tambah jabatan
	 | 					[ ] halaman lis jabatan
	 | 					[ ] halaman ubah jabatan
	 | 					[ ] halaman hapus jabatan
	 |------------------------------------------------------------------------
	 */

	public function __construct()
	{
		parent::__construct();
	}

	# ============================== HALAMAN DEPAN ==============================

	public function index()
	{
		//show_404();

		$halaman_masuk = 'pengguna/masuk';
		$halaman_beranda = 'halaman/beranda';

		$cek_sesi = $this->library_sesi->cek_sesi();

		if($cek_sesi)
		{
			redirect($halaman_beranda);
		}
		else
		{
			redirect($halaman_masuk);
		}
	}

	# ============================== GERBANG MASUK ==============================
	
	public function masuk()
	{
		$nama_pengguna = $this->input->post('nama_pengguna');
		$kata_kunci_bersih = $this->input->post('kata_kunci');
		
		# Jika pertama kali mau masuk atau 
		# Jika belum menekan tombol masuk

		if(empty($nama_pengguna) AND empty($kata_kunci_bersih))
		{
			$data['judul'] = 'Gerbang Masuk';
			$data['kelas'] = '';
			$data['pesan'] = '&nbsp;';

			$this->load->view('masuk', $data);
		}
		
		# Jika sudah menekan tombol masuk
		else
		{
			$cek_pengguna = $this->model_pengguna->cek_pengguna($nama_pengguna, $kata_kunci_bersih);

			if($cek_pengguna)
			{
				$id_pengguna = $this->model_pengguna->cari_pengguna(
						'nama_pengguna', //$parameter_dicari, 
						$nama_pengguna, //$isi_parameter_dicari, 
						'id_pengguna' //$parameter_ditampilkan
					);
				
				$halaman_selanjutnya = 'halaman/beranda';

				$this->library_sesi->set_sesi($id_pengguna, $halaman_selanjutnya);
			}
			else
			{
				$data['judul'] = 'Gerbang Masuk';
				$data['kelas'] = 'alert alert-warning';
				$data['pesan'] = 'Maaf, nama pengguna atau kata kunci anda salah. Silakan coba kembali...';
				$this->load->view('masuk', $data);
			}
		}
	}

	# ============ KELUAR =================

	public function keluar()
	{
		$this->library_sesi->hapus_sesi();
	}
	
	# ---------------------------- variabel untuk validasi -----------------------------

	
	var $konfigurasi_formulir = array(

		array(
				'field'   => 'nama_lengkap',
				'label'   => 'Nama Lengkap',
				'rules'   => 'required|is_unique[pengguna.nama_lengkap]|xss_clean'
		),

		array(
				'field'   => 'hp',
				'label'   => 'Nomor Handphone',
				'rules'   => 'required|numeric|is_unique[pengguna.hp]|xss_clean'
		),

		array(
				'field'   => 'email',
				'label'   => 'Email',
				'rules'   => 'required|valid_email|is_unique[pengguna.email]|xss_clean'
		),

		array(
				'field'   => 'nama_pengguna',
				'label'   => 'Nama Pengguna',
				'rules'   => 'required|is_unique[pengguna.nama_pengguna]|xss_clean'
		),

		array(
				'field'   => 'kata_kunci1',
				'label'   => 'Kata Kunci',
				'rules'   => 'required|min_length[8]|xss_clean'
		),

		array(
				'field'   => 'kata_kunci2',
				'label'   => 'Ulangi Kata Kunci',
				'rules'   => 'required|min_length[8]|matches[kata_kunci1]|xss_clean'
		),

	);

	# ============================== MENDAFTARKAN PENGGUNA ==============================

	public function daftar()
	{
		$mendaftar = $this->config->item('mendaftar');

		/* ------------------------------------------------------------------------------
		 | JIKA dibolehkan mendaftar
		 | ------------------------------------------------------------------------------
		 */

		if($mendaftar == 'Y')
		{
			#
		}
		
		/* ------------------------------------------------------------------------------
		 | JIKA tidak dibolehkan mendaftar
		 | ------------------------------------------------------------------------------
		 */
		
		elseif($mendaftar == 'T')
		{
			$data['judul'] = "Sukses Tambah Pengguna";
			$data['kelas'] = $this->library_kelas->info("sukses");
			$data['pesan'] = "Alhamdulillah, Data pengguna sukses ditambah!";
			$data['aplikasi_nama'] = $this->config->item('aplikasi_nama');
			$data['pengguna_status_masuk'] = $this->library_pengguna->status_masuk();


			$this->load->view('halaman/kepala', $data);
			$this->load->view('halaman/navigasi', $data);
			$this->load->view('halaman/info', $data);
			$this->load->view('halaman/kaki');
		}
	}

	# ============================== TAMBAH DATA PENGGUNA ==============================


	/** /

	public function tambah($daftar = '')
	{
		$this->form_validation->set_rules($this->konfigurasi_formulir);

		$data['isi_form'] = array(

		);

		$data['array_jabatan'] = array(
			1 => 'Administrator',
			2 => 'Staff Kantor',
			3 => 'Anggota',
		);

		$data['array_aktif'] = array(
			'Y' => 'Ya', 
			'N' => 'Tidak'
		);

		// -------------------- Jika didaftarkan oleh Admin -------------------- 

		if(empty($daftar))
		{
			$this->library_sesi->cek_sesi();
			$this->library_pengguna->halaman_admin();

			$data['judul'] = "Tambah Pengguna";
			$data['tombol'] = "Tambahkan!";
			$data['url'] = "pengguna/tambah";
			$data['isi_form'] = array(
				'id_pengguna' => '',
				'nama_lengkap' => '',
				'hp' => '',
				'email' => '',
				'nama_pengguna' => '',
				'kata_kunci1' => '',
				'kata_kunci2' => '',
				'id_jabatan' => '3',
				'aktif' => 'Y',
				'keterangan' => '- Didaftarkan oleh Admin pada ' . $this->library_waktu->sekarang(),
			);
			
			$data['kelas_aktif'] = 'class="form-control"';
			$data['disabled'] = '';
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				$this->load->view('header-dasbor', $data);
				$this->load->view('dasbor-navigasi-atas', $data);
				$this->load->view('dasbor-navigasi-kanan', $data);
				$this->load->view('pengguna-formulir', $data);
				$this->load->view('footer-dasbor');
			}
			else
			{
				$data['judul'] = "Sukses Tambah Pengguna";
				$data['kelas'] = $this->library_kelas->info("sukses");
				$data['pesan'] = "Alhamdulillah, Data pengguna sukses ditambah!";

				$this->model_pengguna->tambah();

				$this->load->view('header-dasbor', $data);
				$this->load->view('dasbor-navigasi-atas', $data);
				$this->load->view('dasbor-navigasi-kanan', $data);
				$this->load->view('dasbor-info', $data);
				$this->load->view('footer-dasbor');
			}
		}

		// -------------------- Jika pengguna mendaftar sendiri --------------------

		elseif($daftar == 'daftar')
		{
			$data['judul'] = "Pendaftaran Pengguna";
			$data['tombol'] = "Daftarkan!";
			$data['url'] = "pengguna/tambah/daftar";
			$data['isi_form'] = array(
				'id_pengguna' => '',
				'nama_lengkap' => '',
				'hp' => '',
				'email' => '',
				'nama_pengguna' => '',
				'kata_kunci1' => '',
				'kata_kunci2' => '',
				'id_jabatan' => '3',
				'aktif' => 'T',
				'keterangan' => '- Mendaftar sendiri pada ' . $this->library_waktu->sekarang(),
			);

			$data['kelas_aktif'] = 'class="form-control" disabled="TRUE"';
			$data['disabled'] = 'disabled';

			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				$this->load->view('header-pendaftaran', $data);
				$this->load->view('pengguna-formulir', $data);
				$this->load->view('footer-pendaftaran');
			}
			else
			{
				$data['judul'] = "Sukses Mendaftar";
				$data['kelas'] = $this->library_kelas->info("sukses");
				$data['pesan'] = "Alhamdulillah, anda sukses mendaftar. Silakan kontak admin untuk mengaktivasi";

				$this->model_pengguna->tambah($daftar = 'daftar');

				$this->load->view('header', $data);
				$this->load->view('info', $data);
				$this->load->view('footer-dasbor');
			}
		}
		else
		{
			show_404();
		}
	}

	/** /

	# ============================== LIS DATA PENGGUNA ==============================
	
	public function lis()
	{
		$data['judul'] = 'Lis Pengguna';
		$this->load->view('header-dasbor', $data);
		$this->load->view('dasbor-navigasi-atas', $data);
		$this->load->view('dasbor-navigasi-kanan', $data);
		$this->load->view('pengguna-lis', $data);
		$this->load->view('footer-dasbor');
	}

	# ============================== UBAH DATA PENGGUNA ==============================

	# ============================== HAPUS DATA PENGGUNA ==============================

	/**/

}

/* End of file pengguna.php */
/* Location: ./application/modules/pengguna/controllers/pengguna.php */
