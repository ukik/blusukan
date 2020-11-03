<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class BrosurModel extends Model {
	
	use Orderable;

    public $incrementing = false;
    protected $primaryKey = 'id';	

	protected $table = 'brosur';

	protected $fillable = [
		'id',
		'uuid',
		'user_id',
		'alamat_jalan',
		'alamat_nomor',
		'alamat_rt',
		'alamat_rw',
		'alamat_kelurahan',
		'alamat_kecamatan',
		'catatan',
		'lat',
		'lang',
		'brosur_kondisi',
		'brosur_respon',
		'created_at',
		'updated_at'		
	];
}
