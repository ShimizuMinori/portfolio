<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// ↓$name＝テーブル「users」につながるためのuse宣言
use Illuminate\Support\Facades\View;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
{
    $this->middleware(function ($request, $next) {


        // viewに共通データを渡す $name＝テーブル「users」につながる
        View::share('name',Auth::user());

        return $next($request);
    });
}
}
