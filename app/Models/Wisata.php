<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class wisata extends Model
{
    // use HasFactory;
    use Sortable;
    use HasFactory;
    protected $table="wisata";
    public $primaryKey = 'id_wisata';
    protected $fillable = [
        'id_wisata','nama_wisata', 'alamat', 'lokasi', 'harga', 'sejarah', 'fasilitas', 'gambar','id_kategori', 'jam_buka', 'jam_tutup',  'fasilitas', 'latitude', 'longitude', 'id_total_rating', 'total', 'average', 'id_review'
    ];

    public $sortable =['nama_wisata', 'alamat', 'lokasi', 'harga', 'sejarah','fasilitas', 'gambar',  'jam_buka', 'jam_tutup', 'fasilitas', 'library', 'latitude', 'longitude'];

    public function totalRating()
    {
        return $this->hasMany(TotalRating::class, 'id_total_rating', 'id_total_rating');
    }

    public function review()
    {
        return $this->hasMany(ReviewWisata::class, 'id_review', 'id_review');
    }

    public function getTotalRatings()
    {
        return $this->totalRating()->get(); // Mengambil data total_ratings yang terkait
    }
    
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    static function getWisata()
    {
        $return = Wisata::join('kategori', 'wisata.id_kategori', '=', 'kategori.id_kategori')
            ->leftJoin('total_ratings', 'wisata.id_wisata', '=', 'total_ratings.id_wisatas')
            ->leftJoin('review_wisatas', 'wisata.id_review', '=', 'review_wisatas.id_review')
            ->get();
        return $return;
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_wisata');
    }
}
