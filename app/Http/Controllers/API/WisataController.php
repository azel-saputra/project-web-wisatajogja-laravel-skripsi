<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Wisata;

use App\Models\Fasilitas;
use App\Models\Kategori;

use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $data=Wisata::getWisata();
        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function filter($filter)
     {
        $dataFilter = Wisata::where('id_kategori','LIKE', '%'.$filter.'%')->get();
        return response()->json($dataFilter);
     }

    public function search($cari)
    {
        $dataS = Wisata::where('nama_wisata','LIKE', '%'.$cari.'%')->get();
        return response()->json($dataS);
        // $data=Wisata::all()->where('nama_wisata', 'LIKE',  explode('.', $key)[0]);
        // return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $rating = Wisata::find($id);
        if (!$rating) {
            return response()->json(['message' => 'Rating tidak ditemukan'], 404);
        }
    
        $rating->rating_wisata = $request->rating_wisata;
        $rating->save();
    
        return response()->json(['message' => 'Rating berhasil diperbarui'], 200);
    }
    
    

    // public function store(Request $request)
    // {
    //     // $validasi=$request->validate([
    //     //     'id_kategori'=>'required',
    //     //     'id_fasilitas'=>'required',
    //     //     'nama_wisata'=>'required',
    //     //     'alamat'=>'required',
    //     //     'lokasi'=>'required',
    //     //     'sejarah'=>'required',
    //     //     'harga'=>'required',
    //     //     'rating'=>'required',
    //     //     'jam'=>'required',
    //     //     'fasilitas'=>'required',
    //     //     'gambar'=>'required|file|mimes:png,jpg',
    //     // ]);
    //     // try {
    //     //     $fileName = time().$request->file('gambar')->getClientOriginalName();
    //     //     $path = $request->file('gambar')->storeAs('uploads/wisata',$fileName);
    //     //     $validasi['gambar']=$path;
    //     //     $response = Wisata::create($validasi);
    //     //     return response()->json([
    //     //         'success'  => true,
    //     //         'message' => 'success',
    //     //         'data'=>$response
    //     //     ]);
    //     // } catch (\Exception $e) {
    //     //     return response()->json([
    //     //         'message'=>'Err',
    //     //         'errors'=>$e->getMessage()
    //     //         ],422);
    //     // }
         
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
   {
    $data = Wisata::find($id);
    return response()->json(['wisata'=>$data]);
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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try {
        //     $wisata=Wisata::find($id);
        //     $wisata->delete();
        //     return response()->json([
        //         'success' =>true,
        //         'message'=>'Success'
        // ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message'=>'Err',
        //         'errors'=>$e->getMessage()
        //         ]);
        // }
    }
}
