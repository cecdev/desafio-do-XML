<?php

use Illuminate\Database\Seeder;
use App\Entities\Atividade;

class AddAtividadesEmpresasSeeder extends Seeder
{
    use \App\Traits\HelpersTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<50;$i++):
            $fillable = [
                'text' => 'Atividade exemplo '.($i+1),
                'code' => $this->makeCodeHexa(),
            ];
            Atividade::create($fillable);
        endfor;
        dd(Atividade::all());
    }
}
