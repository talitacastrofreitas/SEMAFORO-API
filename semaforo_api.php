<?php

function calcularTempoProximoSemaforo($distancia, $velocidade, $aceleracao) {
    $tempo_aceleracao = $velocidade / $aceleracao;
    $distancia_aceleracao = 0.5 * $aceleracao * $tempo_aceleracao ** 2;
    if ($distancia_aceleracao >= $distancia) {
        return round($tempo_aceleracao);
    }
    $tempo_percurso = ($distancia - $distancia_aceleracao) / $velocidade;
    
    return round($tempo_aceleracao + $tempo_percurso - 6);
}

$distancia = isset($_POST['distancia']) ? $_POST['distancia'] : null;
$velocidade = isset($_POST['velocidade']) ? $_POST['velocidade'] : null; 
$aceleracao = isset($_POST['aceleracao']) ? $_POST['aceleracao'] : null;

if ($distancia !== null && $velocidade !== null && $aceleracao !== null) {
    $tempo_proximo_semaforo = calcularTempoProximoSemaforo($distancia, $velocidade, $aceleracao);
    echo json_encode(array('tempo_proximo_semaforo' => $tempo_proximo_semaforo));
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Parâmetros incompletos.'));
}

?>
