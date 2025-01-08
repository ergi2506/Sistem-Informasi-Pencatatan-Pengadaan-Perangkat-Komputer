<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jumlahproduct = Product::count();
        $jumlahuser = User::count();
        $totalAssets = Product::sum('price');

        return view('home', compact('jumlahproduct', 'jumlahuser', 'totalAssets'));
    }

    public function adminHome()
    {
        $jumlahproduct = Product::count();
        $jumlahuser = User::count();
        $totalAssets = Product::sum('price');

        return view('dashboard', compact('jumlahproduct', 'jumlahuser', 'totalAssets'));
    }
    public function userHome()
    {
        $jumlahproduct = Product::count();
        $jumlahuser = User::count();
        $totalAssets = Product::sum('price');

        return view('dashboard', compact('jumlahproduct', 'jumlahuser', 'totalAssets'));
    }
    public function adminUser()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function createUser()
    {
        return view('users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->type,

        ]);

        return redirect()->route('admin/users/index')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:6|confirmed',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->type = $request->type;
        $user->save();
        return redirect()->route('admin/users/index')->with('success', 'User updated successfully.');
    }
    //     $request->validate([

    //     ]);

    //     $user = User::findOrFail($id);
//     $user->name = $request->name;
//     $user->email = $request->email;
//     if ($request->filled('password')) {
//         $user->password = bcrypt($request->password);
//     }
//     $user->type = $request->type;
//     $user->save();

    //     return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
// }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin/users/index')->with('success', 'User Delete successfully.');
    }





    //     public function jumlahAssets()
// {
//     // Menghitung total jumlah harga (assets)


    //     // Passing data ke view
//     return view('dashboard', compact('totalAssets'));
}
// public function jumlahAssets()
// {
//     $assets = new Product();
//     $jumlahassets = $assets->price->count();

//     return view('dashboard', compact('jumlahassets'));
// }
