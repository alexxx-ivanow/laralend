<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    //
    public function execute(Service $service, Request $request) {

        $services = Service::all();

        $data = $services->toArray();


        return view('site.service', ['data' => $data])->withTitle('Наши услуги');

    }
}
