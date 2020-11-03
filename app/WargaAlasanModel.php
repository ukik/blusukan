<?php

namespace App;
use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class WargaAlasanModel extends Model {
	
	use Orderable;

	protected $table = 'warga_alasan';

    public $incrementing = false;
    protected $foreignKey = 'warga_uuid';
    protected $primaryKey = 'id';

	protected $fillable = [
		'id',
		'warga_uuid',
		'idealisme',
		'pragmatisme',
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
