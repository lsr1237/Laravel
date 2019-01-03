<?php

namespace App\Http\Controllers\Boke;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class bokeController
 * 写个博客用用
 *
 * @package App\Http\Controllers\Boke
 */
class BokeController extends Controller
{
    //
    public function index(){
//        echo 'sadasdsadsa';
        return view('Boke.boke');
    }
}
