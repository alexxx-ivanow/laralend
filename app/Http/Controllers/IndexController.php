<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Portfolio;
use App\Models\People;
use App\Models\Service;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {

        $pages = Page::all();
        $portfolios = Portfolio::get(['name', 'images', 'filter']);
        $services = Service::where('id','<', '20')->get();
        $peoples = People::take(3)->get();

        //dd($peoples);

        return view('site.index');

    }
}
