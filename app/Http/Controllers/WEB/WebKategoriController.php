<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Wisata;

use Illuminate\Http\Request;

class WebKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
        if($request->has('search')){
            $datak = Kategori::where('nama_kategori','LIKE','%'.$request->search.'%')->paginate(5);
        }else{
            $datak=Kategori::sortable()->paginate(5);
        }

        return view('admin.kategori', compact(['datak']));
    }

    public function cetakdatakategori()
    {
        $cetakdatakategori=Kategori::all();
        return view('admin.printdatakategori', compact(['cetakdatakategori']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datak=Kategori::all();
        return view('admin.createkategori', compact('datak'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi=$request->validate([
            'nama_kategori'=>'required',
            'gambar_kategori'=>'required|file|mimes:png,jpg',

        ]);
        try {
            $fileName = time().$request->file('gambar_kategori')->getClientOriginalName();
            $path = $request->file('gambar_kategori')->storeAs('uploads/kategori',$fileName);
            $validasi['gambar_kategori']=$path;
            $response = Kategori::create($validasi);
            return redirect('/kategori')->with('status', 'Data berhasil ditambahkan!!');
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datak = Kategori::find($id_kategori);
        return view('admin.detailkategori', compact('datak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Kategori::find($id);
        return view('admin.editkategori', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kategori)
    {
        $update = Kategori::find($id_kategori);
        $validasi=$request->validate([
            'nama_kategori'=>'required',
            'gambar_kategori'=>'file|mimes:png,jpg',

        ]);
        try {
            if($request->file('gambar_kategori')){
                $fileName = time().$request->file('gambar_kategori')->getClientOriginalName();
                $path = $request->file('gambar_kategori')->storeAs('uploads/kategori',$fileName);
                $validasi['gambar_kategori']=$path;
            }
            $response = Kategori::find($id_kategori);
            $response->update ($validasi);
            return redirect('/kategori')->with('status', 'Data berhasil diubah!!');
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $image = Kategori::find($id);
            $image_lama = $image->gambar_kategori;
            unlink($image_lama);
            $kategori=Kategori::find($id);
            $kategori->delete();
            return redirect('/kategori')->with('status', 'Data berhasil dihapus!!');
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ]);
        }
    }
}
