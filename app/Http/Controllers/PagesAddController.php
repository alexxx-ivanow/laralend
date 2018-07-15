<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Validator;

class PagesAddController extends Controller
{
    //
    public function execute(Request $request) {

        if ($request->isMethod('post')) {

            $input = $request->except('_token');

            $messages = [

                'required' => 'Поле :attribute не может бытьпустым',
                'unique' => 'Поле :attribute должно быть уникальным'

            ];

            $validator = Validator::make($input, [

                'name' => 'required|max:100',
                'alias' => 'required|unique:pages|max:70',
                'text' => 'required'

            ], $messages);

            if($validator->fails()) {
                return redirect(route('pagesAdd'))->withErrors($validator)->withInput();
            }

            $page = new Page();
            $page->fill($input);

            if ($page->save()) {
                return redirect('admin')->with('status', 'Страница успешно добавлена');
            }

            if ($request->hasFile('images')) {

                $file = $request->file('images');

                $input['images'] = $file->getClientOriginalName();

                $file->move(public_path().'/assets/img', $input['images']);

            }


        }

        if(view()->exists('admin.pages_add')) {

            $data = [
                'title' => 'Новая страница'
            ];

            return view('admin.pages_add', $data);

        }
        abort(404);

    }
}
