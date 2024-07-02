<?php require_once "arvore_acao.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR" data-theme="ligth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Árvores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
    <main class="container">
        <?php include 'menu.php'; ?>
        <table role="grid">
            <tr>
                <th>Id</th>
                <th>Espécie</th>
                <th>Código</th>
                <th>Data Plantada</th>
                <th>Data Última Adubação</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            function ler_csv_arvore($nome_arquivo) {
                // Lógica para ler o arquivo CSV e processar seus dados
                $dados = array(); // Inicializa um array para armazenar os dados do CSV
                
                if (($handle = fopen($nome_arquivo, "r")) !== FALSE) {
                    // Loop para ler cada linha do arquivo CSV
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        // Cria um array associativo com os dados de cada linha
                        $dados[] = array(
                            'id' => $data[0],
                            'especie' => $data[1],
                            'codigo' => $data[2],
                            'data_plantada' => $data[3],
                            'data_ultima_adubacao' => $data[4],
                        );
                    }
                    fclose($handle); // Fecha o arquivo após a leitura
                }
                
                return $dados; // Retorna o array com os dados do CSV
            }
            ?>
        </table>
    </main>
    <!-- Função de confirmação em JavaScript para a exclusão -->
    <script>
        function excluirArvore(id) {
            if (confirm("Confirmar Exclusão?")) {
                window.location.href = "arvore_acao.php?acao=excluir&id=" + id;
            }
        }
    </script>
</body>
</html>
