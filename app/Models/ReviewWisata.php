<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewWisata extends Model
{
    use HasFactory;
    protected $table="review_wisatas";
    protected $primaryKey = 'id_review';
    protected $fillable = [ 'id_wisatas', 'rating_1', 'rating_2','rating_3','rating_4','rating_5'];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_review', 'id_wisata');
    }
}
