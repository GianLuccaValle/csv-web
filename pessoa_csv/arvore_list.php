<?php
require_once "arvore_acao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<?php include 'cabecalho.php'; ?>

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
            $dados_arvores = ler_csv_arvore();
            if (empty($dados_arvores)) {
                echo "<tr><td colspan='7'>Sem dados de árvores a serem exibidos</td></tr>";
            } else {
                foreach ($dados_arvores as $key) {
                    echo "<tr>
                            <td>{$key['id']}</td>
                            <td>{$key['especie']}</td>
                            <td>{$key['codigo']}</td>
                            <td>{$key['data_plantada']}</td>
                            <td>{$key['data_ultima_adubacao']}</td>
                            <td align='center'><a href='arvore_cad.php?id={$key['id']}' role='button'>Editar</a></td>
                            <td align='center'><a href='javascript:excluirArvore({$key['id']})' role='button'>Excluir</a></td>
                          </tr>";
                }
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
