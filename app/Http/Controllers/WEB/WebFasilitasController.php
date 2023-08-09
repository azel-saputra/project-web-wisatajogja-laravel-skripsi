<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class WebFasilitasController extends Controller
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
            $dataf = Fasilitas::where('nama_fasilitas','LIKE','%'.$request->search.'%')->paginate(5);
        }else{
            $dataf=Fasilitas::sortable()->paginate(5);
        }

        return view('admin.fasilitas', compact(['dataf']));
    }

    public function cetakdatafasilitas()
    {
        $cetakdatafasilitas=Fasilitas::all();
        return view('admin.printdatafasilitas', compact(['cetakdatafasilitas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataf=Fasilitas::all();
        return view('admin.createfasilitas', compact('dataf'));
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
            'nama_fasilitas'=>'required',

        ]);
        try {
        
            $response = Fasilitas::create($validasi);
            return redirect('/fasilitas')->with('status', 'Data berhasil ditambahkan!!');
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
        $dataf = Fasilitas::find($id_fasilitas);
        return view('admin.detailfasilitas', compact('dataf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Fasilitas::find($id);
        return view('admin.editfasilitas', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_fasilitas)
    {
        $update = Fasilitas::find($id_fasilitas);
        $validasi=$request->validate([
            'nama_fasilitas'=>'required',

        ]);
        try {
           
            $response = Fasilitas::find($id_fasilitas);
            $response->update ($validasi);
            return redirect('/fasilitas')->with('status', 'Data berhasil diubah!!');
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
           
            $fasilitas=Fasilitas::find($id);
            $fasilitas->delete();
            return redirect('/fasilitas')->with('status', 'Data berhasil dihapus!!');
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ]);
        }
    }
    
}
