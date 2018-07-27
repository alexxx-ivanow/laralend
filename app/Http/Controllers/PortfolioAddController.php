<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Validator;

class PortfolioAddController extends Controller
{
    //
    public function execute(Request $request) {

        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $messages = [

                'required' => 'Поле :attribute должно быть заполнено',
                'max' => 'Максимальное количество символов в поле :attribute не более :max'

            ];

            $validate = Validator::make($data, [

                'name' => 'required|max:50',
                'filter' => 'required|max:20',
                'images' => 'required'

            ], $messages);

            if($validate->fails()) {

                return redirect()->route('portfolioAdd')->withErrors($validate)->withInput();

            }

            if ($request->hasFile('images')) {

                $file = $request->file('images');

                $data['images'] = $file->getClientOriginalName();

                $file->move(public_path().'/assets/img', $data['images']);

            }

            $port = new Portfolio();
            $port->fill($data);
            if ($port->save()) {
                return redirect()->route('portfolio')->with('status', 'Новая запись с портфолио успешно добавлена в базу данных');
            }


        }

        if (view()->exists('admin.portfolios_add')) {
            return view('admin.portfolios_add')->withTitle('Добавление нового фото в портфолио');
        }
        abort(404);

    }
}
