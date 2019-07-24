<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XmlController extends Controller
{
    public function showCompanyXML($code)
    {


        return response($code, 200)->header('Content-Type', 'text/plain');
    }
}
