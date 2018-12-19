<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceAddController extends Controller
{
    public function execute(Request $request){

        if($request->isMethod('post')){
            $input = $request->except('_token');
            //dd($input);
            $massages = [
                'required' => 'Поле :attribute обязательно к заполнению',
            ];

            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'text' => 'required|max:255',
            ], $massages);

            if($validator->fails()){
                return redirect()->route('serviceAdd')->withErrors($validator)->withInput();
            }

            $services = new Service();
            $services->fill($input);
            if($services->save()){
                return redirect('admin')->with('status','Сервис добавлено');
            }
        }

        if(view()->exists('admin.services_add')){
            $data = [
                'title' => 'Новый сервис'
            ];
            return view('admin.services_add', $data);
        }
        abort(404);
    }
}
