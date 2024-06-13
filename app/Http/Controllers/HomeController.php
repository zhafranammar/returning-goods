<?php

namespace App\Http\Controllers;

use App\Models\ReportIncomingProduct;
use App\Models\ReportReturningProduct;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $suppliers = Supplier::count();

        $damaged_products = ReportIncomingProduct::where('quality_status', 'Damaged')->sum('quantity');
        $good_products = ReportIncomingProduct::where('quality_status', 'Good')->sum('quantity');

        $widget = [
            'users' => $users,
            'suppliers' => $suppliers,
            'damaged_products' => $damaged_products,
            'good_products' => $good_products,
        ];

        return view('home', compact('widget'));
    }
}
