<?php

namespace App;
use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class WargaMinatModel extends Model {
	
	use Orderable;

	protected $table = 'warga_minat';	

    public $incrementing = false;
    protected $foreignKey = 'warga_uuid';
    protected $primaryKey = 'id';

	protected $fillable = [
		'id',
		'warga_uuid',
		'minat0',
		'minat1',
		'minat2',
		'minat3',
		'minat4',
		'minat5',
		'minat6',
		'minat7',
		'minat8',
		'minat9',
		'minat10',
		'minat11',
		'minat12',
		'created_at',
		'updated_at',
	];
	// public function user() {
	// 	return $this->belongsTo(User::class);
	// }

	// public function posts() {
	// 	return $this->hasMany(Post::class);
	// }
}
