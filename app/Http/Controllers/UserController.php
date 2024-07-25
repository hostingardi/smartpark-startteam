<?php

namespace App\Http\Controllers;

use App\Models\Tbkendaraan;
use App\Models\Tbriwayatparkir;
use App\Models\Tbuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    

    public function kendaraan()
    {
        $userId = Auth::id();
        $kendaraans = Tbkendaraan::where('user_id', $userId)->get();
    
        return view('users.kendaraan', compact('kendaraans'));
    }

     // Menyimpan data pengguna baru
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:tbuser',
             'password' => 'required|string|min:8',
             'role' => 'required|string',
             'Status' => 'required|string',
         ]);
 
         $user = new User();
         $user->name = $validatedData['name'];
         $user->email = $validatedData['email'];
         $user->password = bcrypt($validatedData['password']); // Menggunakan bcrypt untuk hash password
         $user->role = $validatedData['role'];
         $user->Status = $validatedData['Status'];
         $user->save();
 
         return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function create()
    {
        return view('users.create');
    }

    
    
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:tbuser,email,'.$user->Id_user.',Id_user',
            'password' => 'nullable|max:100',
            'role' => 'required|in:Admin,Kasir,Pengguna',
            'Status' => 'required|in:Member,Nonmember',
        ]);

        $data = $request->only(['name', 'email', 'role', 'Status']);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function uploadAvatar(Request $request)
    {
        // Validasi request
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk tipe file gambar
        ]);

        // Simpan foto profil ke dalam direktori public/images/users
        $path = $request->file('avatar')->store('images/users', 'public');

        // Simpan path ke dalam kolom avatar di tabel users untuk user yang sedang login
        Auth::user()->update([
            'avatar' => $path,
        ]);

        return redirect()->back()->with('success', 'Foto profil berhasil diunggah.');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $riwayatParkir = Tbriwayatparkir::where('user_id', $user->id)->get();
        return view('user.dashboard', compact('user', 'riwayatParkir'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function riwayatParkir()
    {
        $user = Auth::user();
        $riwayatParkir = Tbriwayatparkir::where('user_id', $user->id)->get();
        return view('user.riwayatparkir', compact('user', 'riwayatParkir'));
    }
    

    
    
}
