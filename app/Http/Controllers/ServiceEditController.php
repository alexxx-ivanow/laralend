<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Validator;
use DB;

class ServiceEditController extends Controller
{
    //
    public function execute(Request $request, $id) {

        if ($request->isMethod('delete')) {

            $id = $request->toArray();
            //dd($id['id']);

            $updel = DB::table('services')
                ->where('id', $id['id'])
                ->delete();

            if ($updel) {
                return redirect()->route('services')->with('status', "Услуга с id=". $id['id'] ." успешно удалена");

            }

        }

        if ($request->isMethod('post')) {

            $value = $request->except('_token');

            $messages = [

                'required' => 'Поле :attribute не может быть пустым',
                'max' => 'Поле :attribute не должно быть длиннее :max символов'
            ];

            $validate = Validator::make($value, [

                'name' => 'required|max:50',
                'text' => 'required|max:255',
                'icon' => 'required'

            ], $messages);

            if ($validate->fails()) {

                return redirect()->route('servicesEdit',$value['id'])->withErrors($validate);

            }

            $upd = DB::table('services')
                ->where('id', $value['id'])
                ->update($value);

            if ($upd) {

                return redirect()->route('services')->with('status', "Услуга с id=". $value['id'] ." успешно изменена");

            }

        }

        $service = Service::where('id', $id)->get()->first();

        if(view()->exists('admin.services_edit')) {
            return view('admin.services_edit', ['data' => $service])->withTitle('Редактирование услуги');
        }

    }
}
