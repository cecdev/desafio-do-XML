<?php
namespace App\Services;

use Carbon\Carbon;
use ZanySoft\Zip\Zip;
use App\Entities\User;
use App\Entities\Empresa;
use App\Entities\XmlDownloadControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class XmlZipService
{
    protected $path_now;
    protected $path_zip;

    protected $xmlDownloadControl;


    public function makeZipAllCompanysXML(XmlDownloadControl $xmlDownloadControl){
        $this->xmlDownloadControl = $xmlDownloadControl;


        $currentuser = $this->xmlDownloadControl->user;


        $this->path_now = 'xml_'.$this->xmlDownloadControl->code.'_s'.$currentuser->id;
        $this->path_zip = storage_path('app/public').'/'. $this->path_now;
        if(File::exists($this->path_zip.'.zip')):
            unlink($this->path_zip.'.zip');
        endif;
        File::makeDirectory($this->path_zip);
        $empresas = Empresa::all()->map(function($empresa){

            $collection = collect($empresa->toArray());
            $diff = $collection->except(['id','fake_generate','updated_at','created_at'])->all();
            $data_emp = $diff;
            $atividade_principal = $empresa->atividade_principals()->get()->map(function($row2){
                $atividade = $row2->atividade()->first();
                return [
                    "text" => $atividade->text,
                    "code" => $atividade->code
                ];
            })->all();
            $atividades_secundarias = $empresa->atividades_secundarias()->get()->map(function($row2){
                $atividade = $row2->atividade()->first();
                return [
                    "text" =>  $atividade->text,
                    "code" => $atividade->code
                ];


            })->all();

            $output = View::make('templates.xmlTemplate')->with(compact('data_emp', 'atividade_principal', 'atividades_secundarias'))->render();

            $path_file = $this->path_zip.'/empresa_'.$data_emp['code'].'.xml';

            File::put($path_file, $output);
            return $output;
        });

        $zip = Zip::create($this->path_zip.'.zip');
        $zip->add($this->path_zip);
        $zip->setMask(0755);
        $zip->close();

        File::deleteDirectory($this->path_zip);
        return ((File::exists($this->path_zip.'.zip'))? 'storage/'.$this->path_now.'.zip' : null );



    }


    private function array_to_xml( $data, &$xml_data ) {
        foreach( $data as $key => $value ) {
            if( is_numeric($key) ){
                $key = 'Atividade'.$key; //dealing with <0/>..<n/> issues
            }
            if( is_array($value) ) {
                $subnode = $xml_data->addChild($key);
                $this->array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
         }
    }



}
