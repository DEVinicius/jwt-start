<?php 

//Entendendo as funcionalidades do JSON web Token - JWT

//todo JWT possui uma key
/*Uma key nada mais é do que uma chave utilizada na criptografia */
$key = 'chave-aplicacao';

/*O header contem algumas informações obrigatorias com palavras reservadas */
$header = [
    'typ' => 'JWT',
    'alg' => 'HS256'
];

//convertemos então o $header para JSON
$header = json_encode($header);
//convertemos o JSON $header para base_64
$header = base64_encode($header);
/*Base 64 é a codificação de arquivos binários, trazendo textos como resultados*/

/*Por que base_64 e não json?
    R: pois textos base_64 são mais seguros a serem enviados em uma requisição GET ou então serem adicionados no header
*/

/*Informações enviadas no payload => COMPARTILHAMENTO DE INFORMAÇÃO */

/*O payload possui palavras reservadas */
$payload = [
    'iss' => 'localhost',
    
    /*Dados a serem trafegados */
    'username' => 'Vinicius',
    'email' => 'vinicius@gmail.com'
];


$payload = json_encode($payload);
$payload = base64_encode($payload);

/*A segurança do JWT está em dizer se a segurança do token é legítima */

/*geração da assinatura */
/*Parametros do hash_hmac
=> algoritmo que será utilizado
=> informação("$header.$payload")*/
$signature = hash_hmac('sha256',"$header.$payload",$key,true);
$signature = base64_encode($signature);


//criação do token
$token = "$header.$payload.$signature";
echo $token;