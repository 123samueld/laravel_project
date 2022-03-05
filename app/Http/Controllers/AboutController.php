<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\TestModel;


class AboutController extends Controller
{
    public function __invoke()
    {
        // $testModel = new TestModel("Samuel");
        // #return $testModel->hello();
        // return $testModel->loop_out();

        return view('test', ['posts' => BlogPost::all()]);
    }
}
