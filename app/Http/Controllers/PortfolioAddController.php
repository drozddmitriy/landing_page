<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioAddController extends Controller
{
    public function execute(Request $request){

        if($request->isMethod('post')){
            $input = $request->except('_token');
            $massages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'
            ];

            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'filter' => 'required|max:255',
              ], $massages);

            if($validator->fails()){
                return redirect()->route('portfolioAdd')->withErrors($validator)->withInput();
            }
            if($request->hasFile('images')){
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'/assets/img',$input['images']);
            }

            $portfolio = new Portfolio();
            $portfolio->fill($input);
            if($portfolio->save()){
                return redirect('admin')->with('status','Портфолио добавлено');
            }

        }

        if(view()->exists('admin.portfolios_add')){
            $data = [
                'title' => 'Новая работа'
            ];
            return view('admin.portfolios_add', $data);
        }
        abort(404);
    }
}
