<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;



class fasilitas extends Model
{
    use HasFactory;
    use Sortable;

    protected $table="fasilitas";
    public $primaryKey = 'id_fasilitas';
    protected $fillable = [
        'nama_fasilitas'
    ];

    public $sortable = ['id_fasilitas', 'nama_fasilitas'  ];
    
    static function getFasilitas(){
        $return=DB::table('fasilitas');
        return $return;
    }

}
