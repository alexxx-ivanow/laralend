<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Validator;

class PagesEditController extends Controller
{
    //
    public  function execute(Page $page, Request $request) {

        /*$page = Page::find($id);*/

        if ($request->isMethod('post')) {

            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name' => 'required|max:50',
                'alias' => 'required|max:100|unique:pages,alias,'.$input['id'],
                'text' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('pagesEdit', $input['id'])
                    ->withErrors($validator);
            }
            if ($request->hasFile('images')) {

                $file = $request->file('images');

                $file->move(public_path().'/assets/img', $file->getClientOriginalName());
                $input['images'] = $file->getClientOriginalName();

            }
            else{
                $input['images'] = $input['old_images'];
            }
            unset ($input['old_images']);

            $page->fill($input);

            if ($page->update()) {
                return redirect('admin')->with('status', 'Страница обновлена');
            }

        }

        if ($request->isMethod('delete')) {

            $page->delete();
            return redirect('admin')->with('status', 'Страница удалена');


        }

        $old = $page->toArray();

        if (view()->exists('admin.pages_edit')) {

            $data = [
                'title' => 'Редактирование страницы - '.$old['name'],
                'data' => $old
            ];

            return view('admin.pages_edit', $data);

        }

    }
}
