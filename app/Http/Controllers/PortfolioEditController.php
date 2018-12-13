<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioEditController extends Controller
{
    public function execute(Portfolio $portfolio, Request $request){

        if($request->isMethod('delete')){
            $portfolio->delete();
            return redirect('admin')->with('status', 'Портфолио удаленo');
        }


        if($request->isMethod('post')){
            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'filter' => 'required|max:255',
             ]);

            if($validator->fails()){
                return redirect()
                    ->route('portfolioEdit', ['portfolio' => $input['id']])
                    ->withErrors($validator)->withInput();
            }

            if($request->hasFile('images')){
                $file = $request->file('images');
                $file->move(public_path().'/assets/img',$file->getClientOriginalName());
                $input['images'] = $file->getClientOriginalName();
            }
            else{
                $input['images'] = $input['old_images'];
            }

            unset($input['old_images']);

            $portfolio->fill($input);

            if($portfolio->update()){
                return redirect('admin')->with('status','Портфолио обновлено!');
            }
        }


        $old = $portfolio->toArray();

        if(view()->exists('admin.portfolio_edit')){
            $data = [
                'title' => 'Редактирование портфолио - '.$old['name'],
                'data' => $old
            ];
            return view('admin.portfolio_edit', $data);
        }

    }
}
