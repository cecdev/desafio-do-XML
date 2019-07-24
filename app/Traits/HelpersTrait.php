<?php
namespace App\Traits;

trait HelpersTrait {

    public function criaHexa($baseHexa = NULL) {
        if ($baseHexa == NULL):
            $baseHexa = $this->NumbersOnly(date("YmdHis").microtime());
        endif;
        $vogais = $baseHexa;
        // A variável $consoante recebendo valor
        $consoante = 'bcdfghjklmnpqrstvwxyzbcdfghjklmnpqrstvwxyz';
        // A variável $numerosHexa recebendo valor
        $numerosHexa = '123456789';
        // A variável $resultadoHexa vazia no momento
        $resultadoHexa = '';
        // strlen conta o nº de caracteres da variável $vogais
        $a = strlen($vogais) - 1;
        // strlen conta o nº de caracteres da variável $consoante
        $b = strlen($consoante) - 1;
        // strlen conta o nº de caracteres da variável $numerosHexa
        $c = strlen($numerosHexa) - 1;
        for ($x = 0; $x <= 1; $x++):
            // A função rand() tem objetivo de gerar um valor aleatório
            $aux1 = rand(0, $a);
            $aux2 = rand(0, $b);
            $aux3 = rand(0, $c);
            // A função substr() tem objetivo de retornar parte da string

            // Caso queira números com mais digitos mude de 1 para 2 e teste
            $str1 = substr($consoante, $aux1, 1);
            $str2 = substr($vogais, $aux2, 1);
            $str3 = substr($numerosHexa, $aux3, 1);
            $resultadoHexa .= $str1 . $str2 . $str3;
            // Trim remove os espaços a direita e esquerda
            $resultadoHexa = trim($resultadoHexa);
        endfor;
        return strtoupper($resultadoHexa);
    }
    public function makeCodeHexa($baseHexa = NULL) {
        $baseCode = $this->criaHexa($baseHexa = NULL);
        return $this->criaHexa($baseCode).$this->criaHexa($baseCode).$this->criaHexa($baseCode);
    }

    public function make_return($data = '', $type = FALSE) {
        if ($type == TRUE):
            return unserialize(base64_decode($data));
        endif;
        return base64_decode(unserialize($data));
    }

    public function tipeFone($n){
        $p = substr( $n, (strlen( $n ) == 10 ? 2 : 0), 1 );
        if( $p > 6 && $p < 10 )
        {
            // celular
            return 'CELULAR';
        }else{
            // outro
            return 'FIXO';
        }
    }

    ############################################################
    # Consulta de CEP
    ############################################################
    /**
     * @param string $cep
     * @return mixed
     */
    public function getCEP($cep = '') {
        (string) $resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep=' . urlencode($cep) . '&formato=json');
        if (!$resultado):
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
        endif;
        $myArray = json_decode($resultado, true);
        return (response()->json($myArray));
    }

    /**
     * Mascara para aplicar em string
     * @author Claudio Alexssandro lino <https://github.com/codigosecafe/>
     *
     * Telefone: "3438420000", Máscara: "(##) ####-####", Resultado: "(34)3842-0000";
     * data: "12032010", Máscara: "##/##/##", Resultado: "12/03/2010";
     * hora: "2236", Máscara: "##:##", Resultado: "22:36".
     * Cep: "81260360", Máscara: "## ###-###", Resultado: "81 260-360".
     **/
    public function mascara_string($mascara, $string) {
        $string = preg_replace("/[^0-9]/", "", $string);
        if (strlen($string) > 2):
            for ($i = 0; $i < strlen($string); $i++):
                $mascara[strpos($mascara, "#")] = $string[$i];
            endfor;
            $mascara = str_replace("#", "", $mascara);
            return $mascara;
        else:
            return '';
        endif;
    }
    public function diffDias($dias = '') {
        // Usa a função criada e pega o timestamp das duas datas:
        $time_inicial = $this->geraTimestamp(date('d/m/Y'));
        $time_final = $this->geraTimestamp(date('d/m/Y', strtotime($dias)));
        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial;
        // Calcula a diferença de dias
        $dias = (int) floor($diferenca / (60 * 60 * 24)); //  dias
        return $dias;
    }
    public function geraTimestamp($data) {
        $partes = explode('/', $data);
        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
    }

    public function moeda($valor, $simbolo = true) {

        if (trim($valor) != '' && $valor > -100000) {
            $return = number_format($valor, 2, ',', '.');
        } else {
            $return = "";
        }
        return (($simbolo) ? 'R$ ' : '' ) . $return;

        // return str_replace(".", ",", 'R$: '.number_format($valor,2)); //retorna o valor formatado para gravar no banco
    }

    public function formatDateDB($data = '', $separador = '/') {
        if ($data != ''):
            $data = explode($separador, $data);
            $data = $data[2] . $separador . $data[1] . $separador . $data[0];
            $data = date('Y-m-d', strtotime($data));
        else:
            $data = date('Y-m-d');
        endif;
        return $data;
    }


    public function NumbersOnly($str, $float = false)
    {
        $r = '';
        if ($float) {
            $r = '.';
            $str = str_replace(',', $r, $str);
        }
        return preg_replace('#[^0-9'.$r.']#', '', mb_convert_kana($str, 'n'));
    }
    public function validaCPF($cpf = null) {

        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    public function validar_cnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14):
            return false;
        endif;

        // Lista de CNPJs inválidos
        $invalidos = [
            '00000000000000',
            '11111111111111',
            '22222222222222',
            '33333333333333',
            '44444444444444',
            '55555555555555',
            '66666666666666',
            '77777777777777',
            '88888888888888',
            '99999999999999'
        ];

        // Verifica se o CNPJ está na lista de inválidos
        if (in_array($cnpj, $invalidos)):
            return false;
        endif;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)):
            return false;
        endif;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}

    //CALCULANDO DIAS NORMAIS
	/*Abaixo vamos calcular a diferença entre duas datas. Fazemos uma reversão da maior sobre a menor
	para não termos um resultado negativo. */
	public function CalculaDias($xDataInicial, $xDataFinal){
        $time1 = $this->dataToTimestamp($xDataInicial);
        $time2 = $this->dataToTimestamp($xDataFinal);

        $tMaior = $time1>$time2 ? $time1 : $time2;
        $tMenor = $time1<$time2 ? $time1 : $time2;

        $diff = $tMaior-$tMenor;
     //	echo "tmaior = $tMaior  tmenor = $tMenor -> $diff<br>";
        $numDias = $diff/86400; //86400 é o número de segundos que 1 dia possui
        return $numDias;
     }


     //LISTA DE FERIADOS NO ANO
     /*Abaixo criamos um array para registrar todos os feriados existentes durante o ano.*/
     private function Feriados($ano,$posicao){
        $dia = 86400;
        $datas = array();
        $datas['pascoa'] = easter_date($ano);
        $datas['sexta_santa'] = $datas['pascoa'] - (2 * $dia);
        $datas['carnaval'] = $datas['pascoa'] - (47 * $dia);
        $datas['corpus_cristi'] = $datas['pascoa'] + (60 * $dia);
        $feriados = array (
           '01/01',
           //'02/02', // Navegantes
           date('d/m',$datas['carnaval']),
           date('d/m',$datas['sexta_santa']),
           date('d/m',$datas['pascoa']),
           '21/04',
           '01/05',
           date('d/m',$datas['corpus_cristi']),
           '07/09',
           //'20/09', // Revolução Farroupilha \m/
           '12/10',
           '02/11',
           '15/11',
           '25/12',
        );

         return $feriados[$posicao]."/".$ano;
     }

     //FORMATA COMO TIMESTAMP
     /*Esta função é bem simples, e foi criada somente para nos ajudar a formatar a data já em formato  TimeStamp facilitando nossa soma de dias para uma data qualquer.*/
     private function dataToTimestamp($data){
        $ano = substr($data, 6,4);
        $mes = substr($data, 3,2);
        $dia = substr($data, 0,2);
         return mktime(0, 0, 0, $mes, $dia, $ano);
     }

     //SOMA X DIAS
     private function Somaxdias($data, $dias){
        $ano = substr($data, 6,4);
        $mes = substr($data, 3,2);
        $dia = substr($data, 0,2);
         return date("d/m/Y", mktime(0, 0, 0, $mes, $dia+$dias, $ano));
     }
         /**
          *
          * @param type $dataini
          * @param type $dias
          * @param type $formato (= us ou br)
          * @return type
          */
     public function somaDiasUteis($dataini, $dias, $formato='br'){
         $total_dias = 0;
         for ($i=0;$total_dias < $dias;$i++){
             $datafim = $this->Somaxdias($dataini,$dias+$i);
             $total_dias = $this->DiasUteis($dataini,$datafim);
         }
                 if ($formato == 'us') $datafim = $this->DataUS ($datafim);
             return $datafim;
     }

     //CALCULA DIAS UTEIS
     /*É nesta função que faremos o calculo. Abaixo podemos ver que faremos o cálculo normal de dias ($calculoDias), após este cálculo, faremos a comparação de dia a dia, verificando se este dia é um sábado, domingo ou feriado e em qualquer destas condições iremos incrementar 1*/
     private function DiasUteis($yDataInicial,$yDataFinal){
        $diaFDS = 0; //dias não úteis(Sábado=6 Domingo=0)
        $calculoDias = $this->CalculaDias($yDataInicial, $yDataFinal); //número de dias entre a data inicial e a final
        $diasUteis = 0;

        while($yDataInicial!=$yDataFinal){
           $yDataInicial = $this->Somaxdias($yDataInicial,1); //dia + 1
           $diaSemana = date("w", $this->dataToTimestamp($yDataInicial));
           if($diaSemana==0 || $diaSemana==6){
              //se SABADO OU DOMINGO, SOMA 01
              $diaFDS++;
           }else{
           //senão vemos se este dia é FERIADO
              for($i=0; $i<=11; $i++){
                 if($yDataInicial==$this->Feriados(date("Y"),$i)){
                    $diaFDS++;
                 }
              }
           }
        }
         return $calculoDias - $diaFDS;
     }

         /**
          *
          * @param type $Data
          * @return string
          * Converte Data para padrão de banco de dados
          */

         private function DataUS($Data){
            if (strstr($Data, "/")) {
               $d = explode ("/", $Data);//tira a barra
               $rstData = $d[2]."-".$d[1]."-".$d[0]; //separa as datas $d[2] = ano $d[1] = mes etc...
               return $rstData;
            } elseif(strstr($Data, "-")){
              $d = explode ("-", $Data);
              $rstData = $d[2]."-".$d[1]."-".$d[0];
              return $rstData;
           }  else { return "NULL"; }
         }

     //echo somaDiasUteis('09/10/2015',1).'<br>';
     //echo DiasUteis('21/10/2015','24/10/2015').'<br>';
     //echo CalculaDias('21/10/2015','24/10/2015').'<br>';
     //echo date("w", dataToTimestamp('24/10/2015')).'<br>';
}
