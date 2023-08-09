<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class kategori extends Model
{
    use HasFactory;
    use Sortable;
    protected $table="kategori";
    public $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori', 'gambar_kategori'
    ];

    // public function wisata(){
    //     return $this->hasMany('App\Models\Wisata');
    // }

    public function wisata(){
        return $this->hasMany(Wisata::class, 'id_kategori', 'id_kategori', 'nama_kategori', 'gambar_kategori');
    }

    public $sortable = ['id_kategori', 'nama_kategori'];
}
