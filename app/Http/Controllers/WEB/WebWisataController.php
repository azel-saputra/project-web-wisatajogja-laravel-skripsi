<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\Kategori;
use App\Models\TotalRating;
use App\Models\Fasilitas;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;  
use Illuminate\Support\Facades\Storage;

class WebWisataController extends Controller
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
            $data = Wisata::where('nama_wisata','LIKE','%'.$request->search.'%') 
            -> orWhere('alamat','LIKE','%'.$request->search.'%') 
            -> orWhereHas('Kategori', function ($query) use ($search){
                $query->where('nama_kategori','LIKE','%'.$search.'%');
            })-> with('kategori', 'totalRating') ->paginate(5);
        }else{
            $data=Wisata::sortable()->with('kategori', 'totalRating')->paginate(5);
        }
        return view('admin.wisata', compact(['data']));
    }

    public function cetakdatawisata()
    {
        $cetakdatawisata=Wisata::all();
        return view('admin.printdatawisata', compact(['cetakdatawisata']));
    }

    public function dasboard(){
        $wisata = Wisata::count();
        $kategori = Kategori::count();
        $fasilitas = Fasilitas::count();
        $location = Wisata::all();
        return view('admin.dasboard', compact('wisata', 'kategori', 'location', 'fasilitas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datak=Kategori::all();
        $dataf=Fasilitas::all();

        return view('admin.createwisata', compact('datak', 'dataf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    // public function store(Request $request)
    // {
    //     $validasi=$request->validate([
    //         'id_kategori'=>'required',
    //         'nama_wisata'=>'required',
    //         'alamat'=>'required',
    //         'sejarah'=>'required',
    //         'harga'=>'required',
    //         'jam_buka'=>'required',
    //         'jam_tutup'=>'required',
    //         'fasilitas'=>'nullable|array',
    //         'latitude'=>'required',
    //         'longitude'=>'required',
    //         'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi tipe dan ukuran gambar
    //         // 'id_wisata',
          
    //     ]);
        
    //     $fasilitas = $request->input('fasilitas', []);
    //     $validasi['fasilitas'] = implode(', ', $fasilitas);
        
    //     $imagePaths = [];
    //     if ($request->hasfile('gambar')) {
    //         foreach ($request->file('gambar') as $image) {
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $path = $image->storeAs('uploads/wisata', $imageName);
    //             $imagePaths[] = $path;
    //         }
    //         $validasi['gambar'] = implode(', ', $imagePaths);
    //     }
    
    //     try {
    //         // Simpan data ke tabel Wisata
    //         $wisata = Wisata::create($validasi);
    //         $idWisata = Wisata::get();
    
    //         // Jika ada gambar yang diunggah, simpan juga data ke tabel Image
    //         if (!empty($imagePaths)) {
    //             foreach ($imagePaths as $imagePath) {
    //                 Image::create(['gambar' => $imagePath]);
    //             }
    //         }
    //         return redirect('/wisata')->with('status', 'Data berhasil ditambahkan!!');
    //     } catch (\Exception $e) {
    //         \Log::error($e);
    //         return response()->json([
    //             'message'=>'Err',
    //             'errors'=> $e->getMessage()
    //             ],422);
    //     }
    // }

    public function store(Request $request)
    {
        $validasi=$request->validate([
            'id_kategori'=>'required',
            'nama_wisata'=>'required',
            'alamat'=>'required',
            'sejarah'=>'required',
            'harga'=>'required',
            'jam_buka'=>'required',
            'jam_tutup'=>'required',
            'fasilitas'=>'nullable|array',
            'latitude'=>'required',
            'longitude'=>'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi tipe dan ukuran gambar
            // 'id_wisata'=>'required',
          
        ]);
        
        $fasilitas = $request->input('fasilitas', []);
        $validasi['fasilitas'] = implode(', ', $fasilitas);
        

        if ($request->hasfile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $image) {
                $imageName = str_replace(' ', ' ', $image->getClientOriginalName());
                $path = $image->storeAs('uploads/wisata', $imageName);
                $gambarPaths[] = $path;
            }
            $validasi['gambar'] = implode(', ', $gambarPaths);
        }

        try {
           
            $response = Wisata::create($validasi);
            return redirect('/wisata')->with('status', 'Data berhasil ditambahkan!!');

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json([
                'message'=>'Err',
                'errors'=> $e->getMessage()
                ],422);
        }
    }



    // public function store(Request $request)
    // {
    //     $validasi=$request->validate([
    //         'id_kategori'=>'required',
    //         'nama_wisata'=>'required',
    //         'alamat'=>'required',
    //         'sejarah'=>'required',
    //         'harga'=>'required',
    //         'jam_buka'=>'required',
    //         'jam_tutup'=>'required',
    //         'fasilitas'=>'nullable|array',
    //         'latitude'=>'required',
    //         'longitude'=>'required',
    //         'gambar'=>'required|file|mimes:png,jpg',
          
    //     ]);

    //     $fasilitas = $request->input('fasilitas', []);
    //     $validasi['fasilitas'] = implode(', ', $fasilitas);

        // try {
        //     $fileName = time().$request->file('gambar')->getClientOriginalName();
        //     $path = $request->file('gambar')->storeAs('uploads/wisata',$fileName);
        //     $validasi['gambar']=$path;

        //     $response = Wisata::create($validasi);
        //     return redirect('/wisata')->with('status', 'Data berhasil ditambahkan!!');

    //     } catch (\Exception $e) {
    //         \Log::error($e);
    //         return response()->json([
    //             'message'=>'Err',
    //             'errors'=> $e->getMessage()
    //             ],422);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_wisata)
    {
        $data = Wisata::find($id_wisata);
        return view('admin.detailwisata', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_wisata)
    {
        $edit = Wisata::find($id_wisata);
        if (empty($edit->latitude)) {
            $edit->latitude = -7.795719;
        }
        if (empty($edit->longitude)) {
            $edit->longitude = 110.369438;
        }
        $datak = Kategori::all();
        
        return view('admin.editwisata', compact('edit', 'datak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_wisata)
    {
        $update = Wisata::find($id_wisata);
        $validasi=$request->validate([
            'id_kategori'=>'required',
            'nama_wisata'=>'required',
            'alamat'=>'required',
            'sejarah'=>'required',
            'harga'=>'required',
            'jam_buka'=>'required',
            'jam_tutup'=>'required',
            'fasilitas'=>'nullable|array',
            'latitude'=>'required',
            'longitude'=>'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'gambar'=>'file|mimes:png,jpg',
        ]);

        $fasilitas = $request->input('fasilitas', []);
        $validasi['fasilitas'] = implode(', ', $fasilitas);

        if ($request->hasfile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $image) {
                $imageName = str_replace(' ', ' ', $image->getClientOriginalName());
                $path = $image->storeAs('uploads/wisata', $imageName);
                $gambarPaths[] = $path;
            }
            $validasi['gambar'] = implode(', ', $gambarPaths);
        }
        
        try {
            $response = Wisata::find($id_wisata);
            $response->update ($validasi);
            return redirect('/wisata')->with('status', 'Data berhasil diubah!!');
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ],422);
        }
    }

    // public function update(Request $request, $id_wisata)
    // {
    //     $update = Wisata::find($id_wisata);
    //     $validasi=$request->validate([
    //         'id_kategori'=>'required',
    //         'nama_wisata'=>'required',
    //         'alamat'=>'required',
    //         'sejarah'=>'required',
    //         'harga'=>'required',
    //         'jam_buka'=>'required',
    //         'jam_tutup'=>'required',
    //         'fasilitas'=>'nullable|array',
    //         'latitude'=>'required',
    //         'longitude'=>'required',
    //         'gambar'=>'file|mimes:png,jpg',
    //     ]);

    //     $fasilitas = $request->input('fasilitas', []);
    //     $validasi['fasilitas'] = implode(', ', $fasilitas);

    //     try {
    //         if($request->file('gambar')){
    //             $fileName = time().$request->file('gambar')->getClientOriginalName();
    //             $path = $request->file('gambar')->storeAs('uploads/wisata',$fileName);
    //             $validasi['gambar']=$path;
    //         }
    //         $response = Wisata::find($id_wisata);
    //         $response->update ($validasi);
    //         return redirect('/wisata')->with('status', 'Data berhasil diubah!!');
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message'=>'Err',
    //             'errors'=>$e->getMessage()
    //             ],422);
    //     }
    // }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     try {
    //         $image = Wisata::find($id);
    //         $image_lama = $image->gambar;
    //         unlink($image_lama);
    //         $wisata=Wisata::find($id);
    //         $wisata->delete();
    //         return redirect('/wisata')->with('status', 'Data berhasil dihapus!!');
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message'=>'Err',
    //             'errors'=>$e->getMessage()
    //             ]);
    //     }
    // }

    public function destroy($id)
    {
        try {
            $wisata = Wisata::findOrFail($id);
            $gambarPaths = explode(', ', $wisata->gambar);
    
            // Delete the images from storage
            foreach ($gambarPaths as $path) {
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }
            $wisata->delete();
            return redirect('/wisata')->with('status', 'Data berhasil dihapus!!');
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ]);
        }
    }
}
