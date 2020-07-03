<?php 

//função com os mesmos conteudos da criacao-jwt.php
function token(){
    $key = 'chave-aplicacao';

    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];

    $header = json_encode($header);
    $header = base64_encode($header);

    $payload = [
        'iss' => 'localhost',
        
        /*Dados a serem trafegados */
        'username' => 'Vinicius',
        'email' => 'vinicius@gmail.com'
    ];

    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $signature = hash_hmac('sha256',"$header.$payload",$key,true);
    $signature = base64_encode($signature);

    $token = "$header.$payload.$signature";
    return $token;
}

/*Suponha-se que o token armazenado na variavel abaixo tenho sido recebido por uma requisição $_GET[''] */

$received_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJ1c2VybmFtZSI6IlZpbmljaXVzIiwiZW1haWwiOiJ2aW5pY2l1c0BnbWFpbC5jb20ifQ==.3w1YsWqOwl2VSXy/WkLbGIPuMpzYD48v2jSOLC8P8J8=";

//verificação dos tokens
if($received_token === token()){
    echo "token válido";
}
else{
    echo "Token inválido";
}