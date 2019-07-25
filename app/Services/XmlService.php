<?php
namespace App\Services;

use App\Entities\Empresa;
use Illuminate\Support\Facades\View;

class XmlService
{
    public function makeXmlView($code_client){

        $empresa = Empresa::where('code', $code_client)->first();
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

                return [
                    "text" => $row2->atividade()->first()->text,
                    "code" => $row2->atividade()->first()->code
                ];


            })->all();




        $output = View::make('templates.xmlTemplate')->with(compact('data_emp', 'atividade_principal', 'atividades_secundarias'))->render();

        return $output;
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
