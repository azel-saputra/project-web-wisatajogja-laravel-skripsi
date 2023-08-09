<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Wisata;
use App\Models\TotalRating;
use App\Models\ReviewWisata;
use App\Models\RatingWisata;




class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rating = Rating::getRating();
        return response()->json($rating);
    }

    public function getRatingByWisata($id_wisata)
{
    $ratings = Rating::where('id_wisata', $id_wisata)->get();
    return response()->json($ratings);
}

    public function total()
    {
        $total = TotalRating::all();
        return response()->json($total);
    }

    public function review(){
        $review = ReviewWisata::all();
        return response()->json($review);
    }

    public function ratingWisata(){
        $rating = RatingWisata::getRating();
        return response()->json($rating);
    }


    public function store(Request $request)
    {
        $id_wisata = $request->input('id_wisata');
        $id_wisatawan = $request->input('id_wisatawan');
    
        $existingData = Rating::where('id_wisatawan', $id_wisatawan)
            ->where('id_wisata', $id_wisata)
            ->first();
    
        if ($existingData) {
            return response()->json(['message' => 'Rating already submitted for this user and attraction'], 400);
        }
    
        $data = new Rating();
        $data->id_wisata = $id_wisata;
        $data->id_wisatawan = $id_wisatawan;
        $data->rating_wisata = $request->input('rating_wisata');
        $data->comment = $request->input('comment');
        $data->save();
    
        //fungsi untuk TotalRating
        // Mengambil semua data rating berdasarkan id_wisata
        $ratings = Rating::where('id_wisata', $id_wisata)->get();
    
        // Menghitung jumlah rating berdasarkan id_wisata
        $totalRating = $ratings->count();
    
        // Menghitung rata-rata rating berdasarkan id_wisata
        $averageRating = $ratings->avg('rating_wisata');
    
        // Menemukan atau membuat data total rating berdasarkan id_wisata
        $totalRatingModel = TotalRating::where('id_wisatas', $id_wisata)->first();
        if ($totalRatingModel) {
            
            $totalRatingModel->total = $totalRating;
            $totalRatingModel->average = $averageRating;
            $totalRatingModel->save();
        } else {
            $totalRatingModel = TotalRating::create([
                'id_wisatas' => $id_wisata,
                'total' => $totalRating,
                'average' => $averageRating
            ]);
        }
    

        //fungsi untuk review_wisata
        // Mengambil semua data rating berdasarkan id_wisata
            $ratings = Rating::where('id_wisata', $id_wisata)->get();

            // Menghitung jumlah rating pada masing-masing nilai rating
            $ratingCounts = [];
            for ($i = 1; $i <= 5; $i++) {
                $ratingCounts[$i] = $ratings->where('rating_wisata', $i)->count();
            }

            // Menemukan atau membuat data review_rating berdasarkan id_wisata
            $reviewRating = ReviewWisata::where('id_wisatas', $id_wisata)->first();
            if ($reviewRating) {
                $reviewRating->rating_1 = $ratingCounts[1];
                $reviewRating->rating_2 = $ratingCounts[2];
                $reviewRating->rating_3 = $ratingCounts[3];
                $reviewRating->rating_4 = $ratingCounts[4];
                $reviewRating->rating_5 = $ratingCounts[5];
                $reviewRating->save();
            } else {
                $reviewRating = new ReviewWisata([
                    'id_wisatas' => $id_wisata,
                    'rating_1' => $ratingCounts[1],
                    'rating_2' => $ratingCounts[2],
                    'rating_3' => $ratingCounts[3],
                    'rating_4' => $ratingCounts[4],
                    'rating_5' => $ratingCounts[5]
                ]);
                $reviewRating->save();
            }

            // Memperbarui kolom id relasi di tabel "wisata"
        $wisata = Wisata::find($id_wisata);
        if ($wisata) {
            $wisata->id_total_rating = $totalRatingModel->id_total_rating;
            $wisata->id_review = $reviewRating->id_review;
            $wisata->save();
        } else {
            return response()->json(['message' => 'Wisata not found'], 404);
        }

 
  
        return response()->json([
            'message' => 'Data created successfully',
            'data' => $data,
            'rating_counts' => $ratingCounts
        ], 201);
    }
    
        
        

    //     return response()->json([
    //         'message' => 'Data created successfully',
    //         'data' => $data
    //     ], 201);
    // }


    // public function store(Request $request)
    // {
    //     $id_wisatawan = $request->input('id_wisatawan');
    //     $existingData = Rating::where('id_wisatawan', $id_wisatawan)->first();
    //     if ($existingData) {
    //         return response()->json(['message' => 'Rating already submitted for this user'], 400);
    //     }

    //     $data = new Rating();
    //     $data->id_wisatawan = $id_wisatawan;
    //     $data->rating_wisata = $request->input('rating_wisata');
    //     $data->save();

    //     // Mengambil semua data rating
    //     $ratings = Rating::all();

    //     // Menghitung jumlah rating
    //     $totalRating = $ratings->count();

    //     // Menghitung rata-rata rating
    //     $averageRating = $ratings->avg('rating_wisata');

    //     // Menyimpan data total rating atau mengupdate jika sudah ada
    //     $totalRatingModel = TotalRating::first();
    //     if ($totalRatingModel) {
    //         $totalRatingModel->total = $totalRating;
    //         $totalRatingModel->average = $averageRating;
    //         $totalRatingModel->save();
    //     } else {
    //         TotalRating::create([
    //             'total' => $totalRating,
    //             'average' => $averageRating
    //         ]);
    //     }      

    //     return response()->json([
    //         'message' => 'Data created successfully',
    //         'data' => $data
    //     ], 201);
    // }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
