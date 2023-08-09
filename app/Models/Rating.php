<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Rating extends Model
{
    use HasFactory;

    protected $table="rating";
    public $primaryKey = 'id_rating';
    protected $fillable = [
        'rating_wisata', 'id_wisatawan', 'id_wisata', 'comment'
    ];

    public function wisatawan()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan');
    }

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_wisata');
    }

    static function getRating()
    {
        $return = Rating::join('wisatawans', 'rating.id_wisatawan', '=', 'wisatawans.id_wisatawan')
            ->get();
        return $return;
    }

}
