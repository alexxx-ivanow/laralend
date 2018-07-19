<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Validator;

class ServiceAddController extends Controller
{
    //
    public function execute(Request $request)
    {

        if ($request->isMethod('post')) {

            $input = $request->except('_token');

            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'max' => 'Поле :attribute превышает количество положенных символов - :max',
            ];

            $validator = Validator::make($input, [
                'name' => 'required|max:50',
                'text' => 'required',
                'icon' => 'required'
            ], $messages);

            if ($validator->fails()) {
                return redirect('admin/services/add')
                    ->withErrors($validator)
                    ->withInput();
            }

            $page = new Service();
            $page->fill($input);

            if ($page->save()) {
                return redirect('admin')->with('status', 'Страница успешно добавлена');

            }
            return abort(404);
        }
            if (view()->exists('admin.services_add')) {

                $data = ['title' => 'Добавить новую услугу'];

                return view('admin.services_add', $data);

            }


    }
}
