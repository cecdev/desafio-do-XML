<?php

namespace App\Http\Controllers\Painel;

use App\Services\XmlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\XmlZipService;

class XmlController extends Controller
{

    protected $xmlservice;
    protected $zipxmlservice;
    public function __construct(XmlService $xmlservice, XmlZipService $zipxmlservice)
    {
        $this->xmlservice = $xmlservice;
        $this->zipxmlservice = $zipxmlservice;
        $this->middleware('auth');

    }

    public function showCompanyXML($code)
    {
        $return = $this->xmlservice->makeXmlView($code);
        if(!empty($return['error'])):
            return response($return['msg'], 404)->header('Content-Type', 'text/plain');
        endif;
        return response($return, 200)->header('Content-Type', 'application/xml');
    }


}
