<?php
define("DESTINO", "index.php");
define("ARQUIVO_CSV_ARVORE", "arvore.csv");

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
        break;
    case 'POST':
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        break;
}

switch ($acao) {
    case 'Salvar':
        salvar_arvore();
        break;
    case 'Alterar':
        alterar_arvore();
        break;
    case 'excluir':
        excluir_arvore();
        break;
}

function tela2array_arvore()
{
    $nova_arvore = array(
        'id' => isset($_POST['id']) ? $_POST['id'] : date("YmdHis"),
        'especie' => isset($_POST['especie']) ? $_POST['especie'] : "",
        'codigo' => isset($_POST['codigo']) ? $_POST['codigo'] : "",
        'data_plantada' => isset($_POST['data_plantada']) ? $_POST['data_plantada'] : "",
        'data_ultima_adubacao' => isset($_POST['data_ultima_adubacao']) ? $_POST['data_ultima_adubacao'] : ""
    );
    if ($nova_arvore['id'] == "0") {
        $nova_arvore['id'] = date("YmdHis");
    }
    return $nova_arvore;
}

function salvar_csv_arvore($dados)
{
    $fp = fopen(ARQUIVO_CSV_ARVORE, "a");
    fputcsv($fp, $dados);
    fclose($fp);
}

function ler_csv_arvore()
{
    $fp = fopen(ARQUIVO_CSV_ARVORE, "r");
    $dados = array();
    if ($fp) {
        while ($row = fgetcsv($fp)) {
            $dados[] = array(
                'id' => $row[0],
                'especie' => $row[1],
                'codigo' => $row[2],
                'data_plantada' => $row[3],
                'data_ultima_adubacao' => $row[4]
            );
        }
        fclose($fp);
    }
    return $dados;
}

function carregar_arvore($id)
{
    $dados = ler_csv_arvore();
    foreach ($dados as $key) {
        if ($key['id'] == $id)
            return $key;
    }
}

function alterar_arvore()
{
    $nova_arvore = tela2array_arvore();
    $dados = ler_csv_arvore();

    for ($x = 0; $x < count($dados); $x++) {
        if ($dados[$x]['id'] == $nova_arvore['id']) {
            $dados[$x] = $nova_arvore;
        }
    }

    salvar_csv_arvore($dados);

    header("location:" . DESTINO);
}

function excluir_arvore()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dados = ler_csv_arvore();
    $novo = array();
    foreach ($dados as $item) {
        if ($item['id'] != $id)
            array_push($novo, $item);
    }
    salvar_csv_arvore($novo);

    header("location:" . DESTINO);
}

function salvar_arvore()
{
    $nova_arvore = tela2array_arvore();
    salvar_csv_arvore([$nova_arvore]);

    header("location:" . DESTINO);
}
