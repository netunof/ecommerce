<?php
include_once 'topo.php';
include_once 'DAO.php';
$id = filter_input(INPUT_GET, 'id');
try {
    $stmt = $conn->prepare("SELECT * FROM Cliente AS c
        INNER JOIN Moradia AS m
        INNER JOIN Endereco AS e
        WHERE c.idcliente = $id");
    $stmt->execute();
    
    foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $result);
} catch (Exception $ex) {
    echo "Não foi possível consultar: " . $ex->getMessage();
}
?>
<main class="page registration-page">
    <section class="clean-block clean-form dark" style="margin:20px auto 0px auto;padding-bottom:30px;">
        <div class="container" style="margin:0px auto;">
            <div class="block-heading" style="padding-top:30px;padding-bottom:30px;margin-bottom:0px;">
                <h2 class="text-center text-info">Atualizar dados</h2>
                <p>Modifique os dados do cliente</p>
            </div>
            <form action="clienteupdate.php">
                <input type="hidden" name="id" value="<?php echo $result['idcliente']?>">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control item" type="text" id="name" name="nome" value="<?php echo $result['nome']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">E-mail</label>
                    <input class="form-control item" type="email" id="name" name="email" value="<?php echo $result['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="formCheck-1">Sexo</label>
                    <div class="form-check" style="width:100px;">
                        <input class="form-check-input" type="radio" id="formCheck-1" name="sexo" value="F">
                        <label class="form-check-label" for="formCheck-2">Feminino</label>
                    </div>
                    <div class="form-check" style="width:100px;">
                        <input class="form-check-input" type="radio" id="formCheck-1" name="sexo" value="M">
                        <label class="form-check-label" for="formCheck-1">Masculino</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Telefone Fixo</label>
                    <input class="form-control item" type="text" id="name" name="fixo" value="<?php echo $result['fixo']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Celular</label>
                    <input class="form-control item" type="text" id="name" name="celular" value="<?php echo $result['celular']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">CPF</label>
                    <input class="form-control item" type="text" id="name" name="cpf" value="<?php echo $result['cpf']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">RG</label>
                    <input class="form-control item" type="text" id="name" name="rg" value="<?php echo $result['rg']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Data de nascimento</label>
                    <input class="form-control item" type="date" id="name" name="nascimento" value="<?php echo $result['nascimento']?>">
                </div>
                <div class="form-group">
                    <label for="name">CEP</label>
                    <input class="form-control item" type="text" id="name" name="cep" value="<?php echo $result['cep']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Logradouro</label>
                    <input class="form-control item" type="text" id="name" name="logradouro" value="<?php echo $result['logradouro']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Bairro</label>
                    <input class="form-control item" type="text" id="name" name="bairro" value="<?php echo $result['bairro']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Cidade</label>
                    <input class="form-control item" type="text" id="name" name="cidade" value="<?php echo $result['cidade']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">UF</label>
                    <input class="form-control item" type="text" id="name" name="uf" value="<?php echo $result['uf']; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Número</label>
                    <input class="form-control" type="number" name="numero" value="<?php echo $result['numero']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label><input class="form-control item" type="password" id="password" name="senha"></div>
                <button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
                <button class="btn btn-danger btn-block" type="reset">Limpar</button>
            </form>
        </div>
    </section>
</main>
<?php include_once 'fundo.php'; ?>