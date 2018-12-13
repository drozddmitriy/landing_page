<?php

namespace App\Http\Controllers;

use App\Portfolio;

class PortfolioController extends Controller
{
    public function execute(){
        if(view()->exists('admin.portfolio')){
            $portfolios = Portfolio::all();
            $data = [
                'title' => 'Портфолио',
                'portfolios' => $portfolios
            ];
            //dd($data);
            return view('admin.portfolio', $data);
        }
        abort(404);
    }
}
