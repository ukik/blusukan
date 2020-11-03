<?php

namespace App;
use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class WargaKegiatanModel extends Model {
	
	use Orderable;

	protected $table = 'warga_kegiatan';

    public $incrementing = false;
    protected $foreignKey = 'warga_uuid';
    protected $primaryKey = 'id';

	protected $fillable = [
		'id',
		'warga_uuid',
		'kegiatan0',
		'kegiatan1',
		'kegiatan2',
		'kegiatan3',
		'kegiatan4',
		'kegiatan5',
		'kegiatan6',
		'kegiatan7',
		'kegiatan8',
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
