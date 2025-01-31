<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Application;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;

class SellerController extends Controller
{
    /**
     * Route "seller/" handler
     * @return redirect route to 'home'
     */
    public function index() {
        if( auth()->check() ) {
            return redirect()->intended("seller/home");

        } else {
            return redirect()->intended("login");
        }
    }

    /**
     * Route "seller/home" handler
     * @return view
     */
    public function home() {

        $applications = Application::whereHas('service', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();

        return view('seller.home', compact("applications"));
    }

    public function portfolio() {
        $applications = Application::whereHas('service', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();
        return view('seller.portfolio', compact("applications"));
    }

    public function profile(Request $request) {

        $user = Auth::user();
        $name = str_replace(' ', '+', $user->name);
        $picture = "https://avatar.oxro.io/avatar.svg?name=" . $name
            . "&background=ff6b6b&caps=3";
        if($request->id){
            $user = User::find($request->id);
        }
        
        return view("seller.profile", compact(['user', 'picture']));
    }
}
