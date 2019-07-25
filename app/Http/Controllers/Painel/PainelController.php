<?php
namespace App\Http\Controllers\Painel;



use App\Entities\User;
use App\Entities\Empresa;
use Illuminate\Http\Request;
use App\Entities\XmlDownloadControl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $conta_empresas = Empresa::count();

        return view('painel.home.index', compact(['conta_empresas']));
    }
    public function downloads()
    {
        $id = Auth::user()->id;
        $currentuser = User::find($id);



        $conta_download = XmlDownloadControl::count();

        return view('painel.downloads.index', compact(['conta_download']));
    }
}
