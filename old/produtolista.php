<?php include_once 'topo.php'; ?>
<section style="margin-top:0px;padding:20px;height:auto;">
    <div>
        <h1 class="text-center text-info" style="padding-top:30px;padding-bottom:30px;">Produtos cadastrados</h1>
    </div>
    <a href='produtocadastro.php'>
        <button class='btn btn-primary' type='button'>Adicionar produtos</button>
    </a>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Preco</th>
                    <th>Alterar</th>
                    <th>Apagar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'DAO.php';
                try {
                    $stmt = $conn->prepare("SELECT idproduto, fotoproduto, nome, valor FROM Produto");
                    $stmt->execute();

                    foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $result) {
                        //define as colunas da tabela como variáveis pra passar via URL e pra preencher o escaninho
                        $id = $result['idproduto'];
                        echo "<tr>
                                <td><img class='img-thumbnail' height='100px' width='100px' src='assets/img/produtos/" . $result['fotoproduto'] . "'></td>
                                <td><a href='produto.php?id=$id'>" . $result['nome'] . "</a></td>
                                <td>" . $result['valor'] . "</td>
                                <td>
                                    <a href='produtoform.php?id=$id'><i class='fa fa-pencil-square' style='width:27px;font-size:30px;height:27px;'></i></a>
                                </td>
                                <td>
                                    <a href='produtodelete.php?id=$id'><i class='fa fa-trash' style='font-size:30px;'></i></a>
                                </td>
                            </tr>";
                    }
                } catch (Exception $ex) {
                    echo "Não foi possível consultar: " . $ex->getMessage();
                }
                $conn = null;
                ?>
            </tbody>
        </table>
    </div>
</section>
<?php include_once 'fundo.php'; ?>