<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pengguna extends CI_Model {
 	
	# ============ CEK DATA PENGGUNA ==============

	public function cek_pengguna($nama_pengguna, $kata_kunci_bersih)
	{
		$kata_kunci = md5(md5(md5($kata_kunci_bersih)));

		$this->db->where('nama_pengguna', $nama_pengguna);
		$this->db->where('kata_kunci', $kata_kunci);
		$this->db->where('aktif', 'Y');

		$query = $this->db->get('pengguna');

		$cocok = $query->num_rows();

		if($cocok)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	# ============ CARI DATA PENGGUNA ==============
	/**/
	public function cari_pengguna($parameter_dicari, $isi_parameter_dicari, $parameter_ditampilkan)
	{
		/*
		* @parameter : 
		* 'id_pengguna' 			: menampilkan ID Pengguna 
		* 'nama_pengguna' 			: menampilkan nama Pengguna 
		* 'nama_lengkap'		 	: menampilkan nama lengkap Pengguna 
		* 'email' 					: menampilkan email Pengguna 
		* 'hp'			 			: menampilkan hp Pengguna 
		* 'id_jabatan'				: menampilkan Jabatan Pengguna
		*/ 

		if ($parameter_dicari == 'id_pengguna')
		{
			$this->db->where('id_pengguna', $isi_parameter_dicari);
		} 
		elseif ($parameter_dicari == 'nama_pengguna') 
		{
			$this->db->where('nama_pengguna', $isi_parameter_dicari);
		}
		elseif ($parameter_dicari == 'nama_lengkap') 
		{
			$this->db->where('nama_lengkap', $isi_parameter_dicari);
		}
		elseif ($parameter_dicari == 'email') 
		{
			$this->db->where('email', $isi_parameter_dicari);
		}
		elseif ($parameter_dicari == 'hp') 
		{
			$this->db->where('hp', $isi_parameter_dicari);
		}
		elseif ($parameter_dicari == 'id_jabatan') 
		{
			$this->db->where('id_jabatan', $isi_parameter_dicari);
		}
		elseif ($parameter_dicari == 'aktif') 
		{
			$this->db->where('aktif', $isi_parameter_dicari);
		}
		
		$this->db->join(
				'jabatan', 
				'pengguna.id_jabatan = jabatan.id_jabatan', 
				'left'
			);

		$query = $this->db->get('pengguna');
		$row = $query->row();

		if ($parameter_ditampilkan == 'id_pengguna')
		{
			return $row->id_pengguna;
		} 
		elseif ($parameter_ditampilkan == 'nama_pengguna') 
		{
			return $row->nama_pengguna;
		}
		elseif ($parameter_ditampilkan == 'nama_lengkap') 
		{
			return $row->nama_lengkap;
		}
		elseif ($parameter_ditampilkan == 'email') 
		{
			return $row->email;
		}
		elseif ($parameter_ditampilkan == 'hp') 
		{
			return $row->hp;
		}
		elseif ($parameter_ditampilkan == 'id_jabatan') 
		{
			return $row->id_jabatan;
		}
		elseif ($parameter_ditampilkan == 'aktif') 
		{
			return $row->aktif;
		}
	}

	# ========= Tambah Pengguna =============

	public function tambah($daftar = "")
	{
		$tambah['id_pengguna'] = $this->input->post('id_pengguna');
		$tambah['nama_lengkap'] = $this->input->post('nama_lengkap');
		$tambah['hp'] = $this->input->post('hp');
		$tambah['email'] = $this->input->post('email');
		$tambah['nama_pengguna'] = $this->input->post('nama_pengguna');
		
		$sandi_bersih = $this->input->post('kata_kunci2');
		$tambah['kata_kunci'] = md5(md5(md5($sandi_bersih)));

		if($daftar == 'daftar')
		{ 
			$tambah['id_jabatan'] = "3";
			$tambah['aktif'] = "N";
			$tambah['keterangan'] = "- Mendaftar sendiri pada " . $this->library_waktu->sekarang();
		}
		elseif(empty($daftar))
		{
			$tambah['id_jabatan'] = $this->input->post('id_jabatan');
			$tambah['aktif'] = "Y";
			$tambah['keterangan'] = $this->input->post('pengguna_keterangan');
		}

		$this->db->insert('pengguna', $tambah);
	}

/** /
 	public function __construct()
	{
		parent::__construct();
	}



	# ========= Jumlah Semua Pengguna =============

	public function pengguna_lihat($jumlah = '')
	{
		$this->db->join(
			'tbl_pengguna_level', 
			'tbl_pengguna.id_jabatan = tbl_pengguna_level.id_jabatan', 
			'left'
		);
		$this->db->order_by('nama_pengguna_lengkap');
		$query = $this->db->get('tbl_pengguna');
		
		if(empty($jumlah))
		{
			return $query->result();
		}
		elseif ($jumlah == 'jumlah') 
		{
			return $query->num_rows();
		}
		
	}

	# ========= Pengguna Ubah =============

	public function ubah($id_pengguna)
	{
		$ubah['id_pengguna'] = $id_pengguna = $this->input->post('id_pengguna');
		$ubah['nama_pengguna'] = $this->input->post('nama_pengguna');
		$ubah['nama_pengguna_lengkap'] = $this->input->post('nama_pengguna_lengkap');
		
		$sandi_bersih = $this->input->post('kata_kunci2');

		if($sandi_bersih)
		{
			$sandi_kotor = $sandi_bersih . $this->config->item('milkhun');
			$ubah['pengguna_password'] = md5($sandi_kotor);
		}
		
		$ubah['pengguna_email'] = $this->input->post('pengguna_email');
		$ubah['pengguna_hp'] = $this->input->post('pengguna_hp');
		$ubah['pengguna_domisili'] = $this->input->post('pengguna_domisili');
		$ubah['pengguna_alamat'] = $this->input->post('pengguna_alamat');
		$ubah['pengguna_nim'] = $this->input->post('pengguna_nim');
		$ubah['id_jabatan'] = $this->input->post('id_jabatan');
		$ubah['aktif'] = $this->input->post('aktif');
		$ubah['keterangan'] = $this->input->post('pengguna_keterangan');

		$this->db->where('id_pengguna', $id_pengguna);
		$this->db->update('tbl_pengguna', $ubah); 
	}

	/**/
}