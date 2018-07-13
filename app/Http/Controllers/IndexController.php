<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Portfolio;
use App\Models\People;
use App\Models\Service;
use DB;
use Mail;
use Session;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {

        dump(Session::all());

            $pages = Page::all();
            $portfolios = Portfolio::get(['name', 'images', 'filter']);
            $services = Service::where('id', '<', '20')->get();
            $peoples = People::take(3)->get();

            $filters = DB::table('portfolios')->distinct()->pluck('filter');
            //dd($filters);
            $menu = [];
            foreach ($pages as $page) {
                $item = ['title' => $page->name, 'alias' => $page->alias];
                array_push($menu, $item);
            }

            $item = ['title' => 'Services', 'alias' => 'service'];
            array_push($menu, $item);

            $item = ['title' => 'Portfolio', 'alias' => 'Portfolio'];
            array_push($menu, $item);

            $item = ['title' => 'Team', 'alias' => 'team'];
            array_push($menu, $item);

            $item = ['title' => 'Contact', 'alias' => 'contact'];
            array_push($menu, $item);

            return view('site.index', [
                'menu' => $menu,
                'pages' => $pages,
                'services' => $services,
                'portfolios' => $portfolios,
                'peoples' => $peoples,
                'filters' => $filters

            ]);
    }

    public function show(Request $request) {

        if($request->isMethod('post')) {

            $messages = [

                'required' => "Поле :attribute обязательно к заполнению",
                'email' => "Поле :attribute должно соответствовать email адресу"

            ];

            $this->validate($request,[

                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'


            ], $messages);

            $data = $request->all();

            /*$result = Mail::send('site.email',['data'=>$data], function($message) use ($data) {

                $mail_admin = env('MAIL_ADMIN');

                $message->from($data['email'],$data['name']);
                $message->to($mail_admin,'Mr. Admin')->subject('Question');


            });*/

           Mail::to(env('MAIL_ADMIN'))->send(new OrderShipped($data));

            //if($result) {
                //$request->session()->forget('status');
                session()->flash('status', 'done email send');
            return redirect( route('home'));
            //}

            //mail


            //}
            //return view('site.done');
        }

    }
}
