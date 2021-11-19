<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Regency;
use App\District;
use Illuminate\Support\Facades\Input;
use App\Barbershop;
use Map;
use App\Hairstyle;

class BarbershopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['guestindex', 'show', 'regencies', 'districts']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'Admin') {
            $barbershops = Barbershop::orderBy('created_at', 'desc')->get();
            return view('barbershop.adminindex', compact('barbershops'));

        } else {
            return view('barbershop.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        if(auth()->user()->role == 'Admin') {
            $barbershops = Barbershop::where('status', '!=','Terverifikasi')->orderBy('created_at', 'desc')->get();
            return view('barbershop.pending', compact('barbershops'));

        } else {
            return view('barbershop.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guestindex()
    {
        $barbershops = Barbershop::where('status', 'Terverifikasi')->orderBy('name', 'desc')->paginate(16);
        
        return view('barbershop.guestindex', compact('barbershops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view('barbershop.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'gambar' => 'image|max:1999',
        // ],
        // [
        //     'gambar.image' => 'File yang diupload harus berupa gambar',
        //     'max' => 'Maksimum ukuran file yang diupload adalah 2 MB'
        // ]);

        $barbershop = new Barbershop;
        $barbershop->user_id = auth()->user()->id;
        $barbershop->name = $request->input('name');
        $barbershop->email = $request->input('email');
        $barbershop->province_id = $request->input('provinces');
        $barbershop->regency_id = $request->input('regencies');
        $barbershop->district_id = $request->input('districts');
        $barbershop->alamat = $request->input('alamat');
        $barbershop->longitude = $request->input('longitude');
        $barbershop->latitude = $request->input('latitude');
        $barbershop->deskripsi = $request->input('deskripsi');
        $barbershop->no_telp = $request->input('no_telp');
        $barbershop->facebook = $request->input('facebook');
        $barbershop->twitter = $request->input('twitter');
        $barbershop->instagram = $request->input('instagram');

        $filenameWithExt = $request->file('gambar')->getClientOriginalName();
        $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('gambar')->getClientOriginalExtension();
        $FileNameToStore = $filename.'_'.time().'_.'.$extension;    
        $path = public_path('/img/barbershop/');
        $request->file('gambar')->move($path, $FileNameToStore);
        
        $barbershop->gambar = $FileNameToStore;

        $barbershop->save();

        return redirect('/barbershop')->with('success', 'Barbershop berhasil dibuat, silahkan tunggu admin untuk memverifkasi.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barbershop = Barbershop::findOrFail($id);

        $config = array();
        $config['map_height'] = '300px';
        $config['zoom'] = '10';
        $config['draggableCursor'] = 'default';

        Map::initialize($config);

        $config = array();
        $config['center'] = $barbershop->longitude.', '.$barbershop->latitude;
        $config['draggableCursor'] = 'default';
        Map::initialize($config);
  
        $marker = array();
        $marker['position'] = $barbershop->longitude.', '.$barbershop->latitude;
        Map::add_marker($marker);

        Map::initialize($config);
        $map = Map::create_map();

        return view('barbershop.show', compact('barbershop', 'map'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinces = Province::all();
        $barbershop = Barbershop::findOrFail($id);

        return view('barbershop.edit', compact('barbershop', 'provinces'));
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

        $barbershop = Barbershop::findOrFail($id);
        $barbershop->user_id = auth()->user()->id;
        $barbershop->name = $request->input('name');
        $barbershop->email = $request->input('email');
        $barbershop->province_id = $request->input('provinces');
        $barbershop->regency_id = $request->input('regencies');
        $barbershop->district_id = $request->input('districts');
        $barbershop->alamat = $request->input('alamat');
        $barbershop->longitude = $request->input('longitude');
        $barbershop->latitude = $request->input('latitude');
        $barbershop->deskripsi = $request->input('deskripsi');
        $barbershop->no_telp = $request->input('no_telp');
        $barbershop->facebook = $request->input('facebook');
        $barbershop->twitter = $request->input('twitter');
        $barbershop->instagram = $request->input('instagram');

        if($barbershop->status == 'Ditolak') {
            $barbershop->status = 'Belum Terverifikasi';
        }

        if($request->hasFile('gambar')){
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $FileNameToStore = $filename.'_'.time().'_.'.$extension;    
            $path = public_path('/img/barbershop/');
            $request->file('gambar')->move($path, $FileNameToStore);
            
            if ($barbershop->gambar !== 'no_image.jpg') {
                $file = public_path('/img/barbershop/'.$barbershop->gambar);
                unlink($file);
            }
            $barbershop->gambar = $FileNameToStore;
        }

        $barbershop->save();

        return redirect('/barbershop')->with('success', 'Barbershop berhasil diperbaharui.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $id)
    {
        $barbershop = Barbershop::findOrFail($id);
        $barbershop->status = 'Terverifikasi';
        $barbershop->save();

        return redirect('/barbershop/'.$id)->with('success', 'Barbershop ini telah berhasil terverifikasi.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tolak(Request $request, $id)
    {

        $barbershop = Barbershop::findOrFail($id);
        $barbershop->status = 'Ditolak';
        $barbershop->alasan = $request->input('alasan');
        $barbershop->save();

        return redirect('/barbershop/'.$id)->with('success', 'Barbershop ini telah berhasil ditolak.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barbershop = Barbershop::findOrFail($id);
        if(count($barbershop->hairstyles) > 0) {
            foreach($barbershop->hairstyles as $hairstyle) {
                $hairstyle = Hairstyle::findOrFail($id);
                if ($hairstyle->gambar !== 'no_image.jpg') {
                    $file = public_path('/img/hairstyle/'.$hairstyle->gambar);
                    unlink($file);
                }
                $hairstyle->delete();
            }
        }
        if ($barbershop->gambar !== 'no_image.jpg') {
            $file = public_path('/img/barbershop/'.$barbershop->gambar);
            unlink($file);
        }
        $barbershop->delete();

        return redirect('/barbershop')->with('success', 'Barbershop berhasil dihapus.');
    }

    /**
     * Dynamic select form
     *
     * @return \Illuminate\Http\Response
     */
    public function regencies(){
        $provinces_id = Input::get('province_id');
        $regencies = Regency::where('province_id', '=', $provinces_id)->get();
        return response()->json($regencies);
    }
  
    public function districts(){
        $regencies_id = Input::get('regencies_id');
        $districts = District::where('regency_id', '=', $regencies_id)->get();
        return response()->json($districts);
    }
}
