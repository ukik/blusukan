<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class InformasiModel extends Model {
	
	use Orderable;

    public $incrementing = false;
    protected $primaryKey = 'id';	

	protected $table = 'informasi';

	protected $fillable = [
		'id',
		'deskripsi',
		'judul',
		'gambar',
		'created_at',
		'updated_at',
	];

}
