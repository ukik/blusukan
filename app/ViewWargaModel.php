<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

use App\WargaAlasanModel;
use App\WargaKegiatanModel;
use App\WargaMinatModel;

class ViewWargaModel extends Model {
	
	use Orderable;

    public $incrementing = false;
    protected $primaryKey = 'id';	

	protected $table = 'view_warga';

	protected $fillable = [
		'id',
		'uuid',
		'user_id',
		'nama',
		'kartu_keluarga',
		'nik',
		'telepon',
		'whatsapp',
		'tempat_lahir',
		'tanggal_lahir',
		'umur',
		'agama',
		'perkawinan',
		'kelamin',
		'alamat_jalan',
		'alamat_nomor',
		'alamat_rt',
		'alamat_rw',
		'alamat_kelurahan',
		'alamat_kecamatan',
		'disabilitas',
		'nomer_tps',
		'pekerjaan',
		'pilihan',
		'catatan',
		'lat',
		'lang',
		'antusiasme',

		'nama',
		'telepon',
		'peran',		

		'created_at',
		'updated_at'		
	];

	public function minat() {
		return $this->hasOne(WargaMinatModel::class, 'warga_uuid', 'uuid');
	}

	public function kegiatan() {
		return $this->hasOne(WargaKegiatanModel::class, 'warga_uuid', 'uuid');
	}

	public function alasan() {
		return $this->hasOne(WargaAlasanModel::class, 'warga_uuid', 'uuid');
	}		
}
