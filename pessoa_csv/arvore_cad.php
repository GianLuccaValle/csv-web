<?php 
$title = "Cadastro de Árvores";
include 'cabecalho.php'; 
?>
<?php include "arvore_acao.php"; ?>
<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar_arvore($id);
?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">
        <form action="arvore_acao.php" method="post">
            <fieldset>
                <legend>Cadastro de Árvores</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="especie">Espécie</label>
                <input type="text" size="40" name="especie" id="especie" value="<?php if ($id != 0) echo $dados['especie']; ?>" required><br>

                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" value="<?php if ($id != 0) echo $dados['codigo']; ?>"><br>

                <label for="data_plantada">Data Plantada</label>
                <input type="date" name="data_plantada" id="data_plantada" value="<?php if ($id != 0) echo $dados['data_plantada']; ?>"><br>

                <label for="data_ultima_adubacao">Data Última Adubação</label>
                <input type="date" name="data_ultima_adubacao" id="data_ultima_adubacao" value="<?php if ($id != 0) echo $dados['data_ultima_adubacao']; ?>"><br>

                <input class="primary" type="submit" name="acao" id="acao" value="<?php if ($id == 0) echo "Salvar"; else echo "Alterar"; ?>">
                <input type="reset" value="Cancelar" />
            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>
