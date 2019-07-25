<?php

namespace App\Http\Controllers\Painel;

use App\Entities\User;
use App\Entities\Empresa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Entities\XmlDownloadControl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    use \App\Traits\HelpersTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listDataTablesCompanys()
    {
        if(request()->ajax())
        {
            return datatables()->of(Empresa::query())
                    ->addColumn('action', function($data){
                        $button = '<a href="'.url('/painel/empresa/'.$data->code.'.xml').'" class="btn btn-primary" target="_blank">Visualizar XML</a>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return response()->json(['status' => 'error'], 403);
    }
    public function listDataTablesDownloads(DataTables $dataTables)
    {
        if(request()->ajax())
        {
            $id = Auth::user()->id;
            $currentuser = User::find($id);
            $model = XmlDownloadControl::query()->where('users_id', $currentuser->id);
            $return = $dataTables->eloquent($model)
                ->addColumn('action', function($data){
                    if(!empty($data->path) && $data->status == 2):
                        $button = '<a href="'.url($data->path).'" class="btn btn-success btn-block btn-md" target="_blank">Download ZIP</a>';
                    else:
                        $button = '<a href="javascript:void(0)" class="btn btn-success btn-block btn-md" target="_blank" disabled>Download ZIP</a>';
                    endif;

                    return $button;
                })
                ->addColumn('process', function($data){
                    if(!empty($data->status) && $data->status == 1):
                        $return = 'Processando';
                    elseif(!empty($data->status) && $data->status == 2):
                            $return = 'Disponivel';
                    else:
                        $return = 'Aguardando processo';
                    endif;

                    return $return;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $return;
        }
        return response()->json(['status' => 'error'], 403);
    }
    public function createDownloads()
    {
        if(request()->ajax())
        {
            $id = Auth::user()->id;
            $currentuser = User::find($id);
            $data_request = request()->only(['name']);
            if(!empty($data_request["name"])):
                $data_control = [
                    'code' => $this->makeCodeHexa(),
                    'name' => trim(Str::upper($data_request["name"])),
                    'status' => 0,
                    'users_id' => $currentuser->id
                ];
               $save = XmlDownloadControl::create($data_control);
               return response()->json(['status' => 'success'], 200);
            endif;

        }
        return response()->json(['status' => 'error'], 403);
    }

}
