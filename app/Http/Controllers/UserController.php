<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::where('role', 'Barber')->orderBy('created_at', 'desc')->get();

        return view('user.index', compact('users'));
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
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        return view('user.edit', compact('user'));
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
            'avatar' => 'image|max:1999',
        ],
        [
            'avatar.image' => 'File yang diupload harus berupa gambar',
            'max' => 'Maksimum ukuran file yang diupload adalah 2 MB'
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->alamat = $request->input('alamat');
        $user->bio = $request->input('bio');
        $user->no_telp = $request->input('no_telp');
        $user->facebook = $request->input('facebook');
        $user->twitter = $request->input('twitter');
        $user->instagram = $request->input('instagram');
        
        if($request->hasFile('avatar')){
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $FileNameToStore = $filename.'_'.time().'_.'.$extension;    
            $path = public_path('/img/avatar/');
            $request->file('avatar')->move($path, $FileNameToStore);
            
            if ($user->avatar !== 'no_avatar.png') {
                $file = public_path('/img/avatar/'.$user->avatar);
                unlink($file);
            }
            $user->avatar = $FileNameToStore;
        }

        $user->save();

        return redirect('/user/'.$id)->with('success', 'Profil telah diperbaharui');

    }

    //Edit Password
    public function editpassword($id) {
        if(auth()->user()->id == $id) {
            $user = User::findOrFail($id);
            return view('user.editpassword', compact('user'));

        } else {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
        }

    }

    public function editpassword1(Request $request, $id) {

        $this->validate($request, [
            'password' => 'same:password1'
            ],
            [
                'same' => 'Konfirmasi Password Baru Tidak Sesuai'
            ]);

        
        $oldpassword = $request->input('oldpassword');

        $user = User::findOrFail($id);

        if (Hash::check($oldpassword, $user->password)) {
            $user->password = Hash::make($request->input('password1'));
            $user->save();

            return redirect('/user/'.$id)->with('success', 'Password Berhasil Diperbaharui.');
        } else {
            return redirect('/editpassword/'.$id.'/user')->with('error', 'Password Lama Tidak Sesuai.');
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
        $user = User::findOrFail($id);
        if(count($user->barbershops) > 0) {
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
        }
        if ($user->avatar !== 'no_avatar.png') {
            $file = public_path('/img/avatar/'.$user->avatar);
            unlink($file);
        }
        $user->delete();

        return redirect('/user')->with('success', 'Mitra berhasil dihapus');
    }
}
