<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hairstyle;

class HairstyleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gambar' => 'image|max:1999',
        ],
        [
            'gambar.image' => 'File yang diupload harus berupa gambar',
            'max' => 'Maksimum ukuran file yang diupload adalah 2 MB'
        ]);

        $hairstyle = new Hairstyle;
        $hairstyle->barbershop_id = $request->input('barbershop_id');
        $hairstyle->kategori = $request->input('kategori');

        $filenameWithExt = $request->file('gambar')->getClientOriginalName();
        $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('gambar')->getClientOriginalExtension();
        $FileNameToStore = $filename.'_'.time().'_.'.$extension;    
        $path = public_path('/img/hairstyle/');
        $request->file('gambar')->move($path, $FileNameToStore);
        
        $hairstyle->gambar = $FileNameToStore;

        $hairstyle->save();

        return redirect('/barbershop/'.$request->input('barbershop_id'))->with('success', 'Model rambut berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/');
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
        $this->validate($request, [
            'gambar' => 'image|max:1999',
        ],
        [
            'gambar.image' => 'File yang diupload harus berupa gambar',
            'max' => 'Maksimum ukuran file yang diupload adalah 2 MB'
        ]);

        $hairstyle = Hairstyle::findOrFail($id);
        $hairstyle->kategori = $request->input('kategori');

        if($request->hasFile('gambar')){

            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $FileNameToStore = $filename.'_'.time().'_.'.$extension;    
            $path = public_path('/img/hairstyle/');
            $request->file('gambar')->move($path, $FileNameToStore);
            
            if ($hairstyle->gambar !== 'no_image.jpg') {
                $file = public_path('/img/hairstyle/'.$hairstyle->gambar);
                unlink($file);
            }
            $hairstyle->gambar = $FileNameToStore;
        }

        $hairstyle->save();

        return redirect('/barbershop/'.$request->input('barbershop_id'))->with('success', 'Model rambut berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hairstyle = Hairstyle::findOrFail($id);
        if ($hairstyle->gambar !== 'no_image.jpg') {
            $file = public_path('/img/hairstyle/'.$hairstyle->gambar);
            unlink($file);
        }
        $barbershop_id = $hairstyle->barbershop_id;
        $hairstyle->delete();
        return redirect('/barbershop/'.$barbershop_id)->with('success', 'Model rambut berhasil dihapus.');
    }
}
