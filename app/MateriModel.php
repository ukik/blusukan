<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class MateriModel extends Model {
	
	use Orderable;

    public $incrementing = false;
    protected $primaryKey = 'id';	

	protected $table = 'materi';

	protected $fillable = [
		'id',
		'dilihat',
		'gambar',
		'created_at',
		'updated_at',
	];

}
