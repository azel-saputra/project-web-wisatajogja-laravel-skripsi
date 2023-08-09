<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Kategori::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validasi=$request->validate([
        //     'nama_kategori'=>'required',
        // ]);
        // try {
        //     $response = Kategori::create($validasi);
        //     return response()->json([
        //         'success'  => true,
        //         'message' => 'success',
        //         'data'=>$response
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message'=>'Err',
        //         'errors'=>$e->getMessage()
        //         ],422);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kategori)
    {
        $data = Kategori::find($id_kategori)->first();
        return response()->json($data);
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
        // $validasi=$request->validate([
        //     'nama_kategori'=>'required',
        // ]);
        // try {
        //     $response = Kategori::find($id);
        //     $response->update ($validasi);
        //     return response()->json([
        //         'success'  => true,
        //         'message' => 'success',
        //         'data'=>$response
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message'=>'Err',
        //         'errors'=>$e->getMessage()
        //         ],422);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try {
        //     $wisata=Kategori::find($id);
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
