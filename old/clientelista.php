<?php include_once 'topo.php'; ?>
<section style="margin-top:0px;padding:20px;height:auto;">
    <div>
        <h1 class="text-center text-info" style="padding-top:30px;padding-bottom:30px;">Clientes cadastrados</h1>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Alterar</th>
                    <th>Apagar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'DAO.php';
                try {
                    $stmt = $conn->prepare("SELECT idcliente, nome, email FROM Cliente");
                    $stmt->execute();

                    foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $result) {
                        //define as colunas da tabela como variáveis pra passar via URL e pra preencher o escaninho
                        $id = $result['idcliente'];
                        echo "<tr>
                                <td>" . $result['idcliente'] . "</td>
                                <td>" . $result['nome'] . "</td>
                                <td>" . $result['email'] . "</td>
                                <td>
                                    <a href='clienteform.php?id=$id'><i class='fa fa-pencil-square' style='width:27px;font-size:30px;height:27px;'></i></a>
                                </td>
                                <td>
                                    <a href='clientedelete.php?id=$id'><i class='fa fa-trash' style='font-size:30px;'></i></a>
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