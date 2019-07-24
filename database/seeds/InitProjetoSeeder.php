<?php

use Illuminate\Database\Seeder;

class InitProjetoSeeder extends Seeder
{
    use \App\Traits\HelpersTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'name' => 'master',
            'label' => 'Master'
        ];
        $data_role = \App\Entities\Role::create($role);

        $usuario_master = [
            'code'=> $this->makeCodeHexa(),
            'email'=> 'codigosecafe@gmail.com',
            'password' => Hash::make('1q2w3e4r'),
            'status' => 1,
            'roles_id'  => $data_role->id
        ];

        $data_user = \App\Entities\User::create($usuario_master);

        $info_user = [
            'user_id' => $data_user->id,
            'nome' => 'Claudio',
            'sobrenome' => 'Alexssandro Lino',
            'doc' => '00884494918',
            'skype' => 'claudio.alexssandro',
            'whatsapp' => '4198294044'
        ];
        $data_info_user = \App\Entities\DataUser::create($info_user);

        echo '======================= FIM =======================';
    }
}
