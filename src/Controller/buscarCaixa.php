<?php
header('Content-Type: application/json; charset=utf-8');

$codigo = $_POST['codigo_caixa'] ?? '';
$retorno = ['resultado' => $codigo, 'caixa' => null];

if (strlen($codigo) === 5) {
    // Exemplo de conexão PDO
    // $stmt = $pdo->prepare("SELECT descricao, data_criacao, responsavel FROM caixas WHERE codigo = ?");
    // $stmt->execute([$codigo]);
    // $caixa = $stmt->fetch(PDO::FETCH_ASSOC);

    // Simulação de retorno do banco:
    $caixa = [
        'descricao' => 'Documentos Contábeis 2023',
        'data_criacao' => '15/05/2023',
        'responsavel' => 'Setor Financeiro'
    ];



    if ($caixa) {
        $retorno['resultado'] = true;
        $retorno['caixa'] = $caixa;
    }
}

//echo json_encode($retorno);
echo json_encode($retorno);

?>