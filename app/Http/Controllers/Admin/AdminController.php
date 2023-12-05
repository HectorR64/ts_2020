<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\ Product;
use App\Models\evento;
use App\Models\Sale;
use App\Models\User;
use Auth;


class AdminController extends Controller
{
    public function index(){

        $today = Carbon::today();
        $products = Product::all();
        $sales = Sale::whereDate('created_at', '=', $today);

        return view('admin.home', compact('products','sales'));
    }

    public function profile(User $user){

        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function update(User $user)
    {
            $user->name = request('name');
            $user->email = request('email');
            $user->save();

            return back();
    }
    public function updates(User $user)
    {
        $user->password = bcrypt(request('password'));
        $user->save();

        return back();
    }

}
