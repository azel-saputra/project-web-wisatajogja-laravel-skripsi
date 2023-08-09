<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TotalRating extends Model
{
    use HasFactory;
    protected $table="total_ratings";
    protected $primaryKey = 'id_total_rating';
    protected $fillable = [ 'total', 'average', 'id_wisatas'];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_total_rating', 'id_wisata');
    }
}
