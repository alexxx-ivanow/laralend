<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class PortfolioEditController extends Controller
{
    //
    public function execute(Request $request, $id) {

        $data = DB::table('portfolios')->where('id', $id)->first();

        if ($request->isMethod('post')) {

           $input = $request->except('_token');

            $messages = [

                'required' => 'Поле :attribute должно быть заполнено',
                'max' => 'Максимальное количество символов в поле :attribute не более :max'

            ];

           $validate = Validator::make($input, [

               'name' => 'required|max:30',
               'filter' => 'required|max:12'

           ], $messages);

           if ($validate->fails()) {

               return redirect()->route('portfolioEdit', ['portfolio'=> $id])->withErrors($validate);

           }else{
               $input['images'] = $data->images;
           }

           if ($request->hasFile('images')) {

               $file = $request->file('images');

               $input['images'] = $file->getClientOriginalName();

               $file->move(public_path().'/assets/img', $input['images']);

           }

           $arr = [
               'name' => $input['name'],
               'filter' => $input['filter'],
               'images' => $input['images']
           ];

            $ins = DB::table('portfolios')
                ->where('id', $id)
                ->update($arr);

            if($ins) {
                return redirect()->route('portfolio')->with('status', 'Запись в таблице портфолио успешно обновлена');
            }

        }

        if ($request->isMethod('delete')) {
            $del = DB::table('portfolios')->where('id', $id)->delete();
            if ($del) {
                return redirect()->route('portfolio')->with('status', 'Запись с id='.$id.' успешно удалена из таблицы portfolios');
            }
        }

        if (view()->exists('admin.portfolios_edit')) {

            //dump($data);

            return view('admin.portfolios_edit')->withTitle('Редактирование портфолио')->with('data', $data);

        }

    }
}
