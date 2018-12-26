<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\PageSite;

use Illuminate\Support\Facades\Mail;


class IndexController extends Controller
{
    public function execute(Request $request)
    {
        if($request->isMethod('post')){
            $result = PageSite::sendMail($request);

            if(!$result){
                return redirect()->route('home')->with('status','Email is send');
            }
        }

        $data = PageSite::all();
        return view('site.index', $data);
    }
}
