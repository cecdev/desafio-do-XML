<?php

use Faker\Factory;
use App\Entities\Empresa;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Database\Seeder;
use App\Entities\AtividadePrincipal;
use App\Entities\AtividadesSecundaria;

class AddEmpresasSeeder extends Seeder
{
    use \App\Traits\HelpersTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($a=0;$a<5000;$a++):
            $response_cnpj = Curl::to('http://geradorapp.com/api/v1/cnpj/generate?token=9a2999d5403fda100f490d300aea2990')
        ->withResponseHeaders()
        ->returnResponseObject()
        ->get();
        $content_cnpj = (!empty($response_cnpj->content))? $response_cnpj->content :'error';
        $min=1;
        $max=50;
        $atividade = rand($min,$max);


        if(preg_match("/number_formatted/",$content_cnpj)):
            $content_cnpj = json_decode($content_cnpj, TRUE);
            $cnpj = $content_cnpj["data"]["number"];
            $faker = Factory::create('pt_BR');
            //dd($faker->company);
            $empresa = [
                'code' => $this->makeCodeHexa(),
                'data_situacao' => $this->getRandomTimestamps()->format('Y-m-d'),
                'nome' => $faker->company,
                'uf' => $faker->stateAbbr,
                'situacao' => "ATIVA",
                'bairro' => $faker->cityPrefix.' '.$faker->citySuffix,
                'logradouro' => $faker->streetName,
                'numero' => $this->NumbersOnly($faker->buildingNumber),
                'cep' => $this->NumbersOnly($faker->postcode),
                'municipio' => $faker->city,
                'porte' => "DEMAIS",
                'abertura' => $this->getRandomTimestamps()->format('d/m/Y'),
                'natureza_juridica' => "206-2 - Sociedade Empresária Limitada",
                'cnpj' => $this->NumbersOnly($cnpj),
                'ultima_atualizacao' => '2019-07-12 16:39:26',
                'status' => "OK",
                'tipo' => "FILIAL",
                'fake_generate' => 1
            ];
            $empresa = Empresa::create($empresa);
            $atividade_principal = [
                'empresas_id' => $empresa->id,
                'atividades_id' => $atividade
            ];
            AtividadePrincipal::create($atividade_principal);
            $conta = ((50 - $atividade) < 3)? 6 : (50 - $atividade);

            $min=1;
            $max=$conta;
            $conta_atividade = rand($min,$max);
            $conta_atividade = (($conta_atividade) < 3)? 6 : ($conta_atividade);
            for($i=0;$i<$conta_atividade; $i++):
                if($atividade != ($i+1)):
                    $atividade_sec = [
                        'empresas_id' => $empresa->id,
                        'atividades_id' => $i+1
                    ];
                    AtividadesSecundaria::create($atividade_sec);
                endif;

            endfor;

            echo $a.' PROCESS '.$empresa->id."\n";
        endif;
        sleep(1);
        endfor;



    }
    function getRandomTimestamps($backwardDays = -800){

        $backwardCreatedDays = rand($backwardDays, 0);
		return \Carbon\Carbon::now()->addDays($backwardCreatedDays)->addMinutes(rand(0,60 * 23))->addSeconds(rand(0, 60));
    }
}
