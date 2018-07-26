<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    //
    public  function execute() {

        $value = Portfolio::all()->toArray();

        if (view()->exists('admin.portfolios')) {
            return view('admin.portfolios', ['value' => $value])->withTitle('Раздел портфолио');
        }

    }
}
