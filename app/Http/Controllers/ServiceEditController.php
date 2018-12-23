<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ServiceEditController extends Controller
{
    public function execute(Service $service, Request $request){

        if($request->isMethod('delete')){
            $service->delete();
            return redirect('admin')->with('status', 'Сервис удаленo!');
        }

        if($request->isMethod('post')){
            $input = $request->except('_token');
            //dd($input);
            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'text' => 'required|max:255',
                'icon' => 'required|max:255',
            ]);
            //dd($validator->fails());
            if($validator->fails()){
                return redirect()
                    ->route('serviceEdit', ['services' => $input['id']])
                    ->withErrors($validator)->withInput();
            }

            $service->fill($input);

            if($service->update()){
                return redirect('admin')->with('status','Сервис обновлен!');
            }
        }

        $old = $service->toArray();
       //dd($old);
        if(view()->exists('admin.services_edit')){
            $data = [
                'title' => 'Редактирование сервисов - '.$old['name'],
                'data' => $old
            ];
            return view('admin.services_edit', $data);
        }
    }
}
