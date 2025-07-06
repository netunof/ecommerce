<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="" alt="Avatar" class="rounded-circle mb-3" width="100">
                    <h5 class="card-title"><?= htmlspecialchars($cliente->cliente_nome) ?></h5>
                    <p class="text-muted mb-1"><?= htmlspecialchars($cliente->cliente_email) ?></p>
                    <p class="text-muted"><?= htmlspecialchars($cliente->cliente_telefone) ?></p>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/perfil" class="list-group-item list-group-item-action">Meus Dados</a>
                    <a href="/perfil/endereco" class="list-group-item list-group-item-action active">Endereço</a>
                    <a href="/perfil/pedidos" class="list-group-item list-group-item-action">Meus Pedidos</a>
                    <a href="/logout" class="list-group-item list-group-item-action text-danger">Sair</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Endereço atualizado com sucesso!</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Ocorreu um erro ao atualizar o endereço.</div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Meu Endereço</h5>
                </div>
                <div class="card-body">
                    <form action="/perfil/endereco/atualizar" method="POST">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" 
                                    value="<?= htmlspecialchars($endereco->endereco_cep ?? '') ?>" required>
                            </div>
                            <div class="col-md-7 mb-3">
                                <label for="logradouro" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" id="logradouro" name="logradouro" 
                                    value="<?= htmlspecialchars($endereco->endereco_logradouro ?? '') ?>" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" 
                                    value="<?= htmlspecialchars($endereco->endereco_numero ?? '') ?>" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" 
                                    value="<?= htmlspecialchars($endereco->endereco_cidade ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Selecione...</option>
                                    <option value="AC" <?= ($endereco->endereco_estado ?? '') == 'AC' ? 'selected' : '' ?>>Acre</option>
                                    <option value="AL" <?= ($endereco->endereco_estado ?? '') == 'AL' ? 'selected' : '' ?>>Alagoas</option>
                                    <option value="AP" <?= ($endereco->endereco_estado ?? '') == 'AP' ? 'selected' : '' ?>>Amapá</option>
                                    <option value="AM" <?= ($endereco->endereco_estado ?? '') == 'AM' ? 'selected' : '' ?>>Amazonas</option>
                                    <option value="BA" <?= ($endereco->endereco_estado ?? '') == 'BA' ? 'selected' : '' ?>>Bahia</option>
                                    <option value="CE" <?= ($endereco->endereco_estado ?? '') == 'CE' ? 'selected' : '' ?>>Ceará</option>
                                    <option value="DF" <?= ($endereco->endereco_estado ?? '') == 'DF' ? 'selected' : '' ?>>Distrito Federal</option>
                                    <option value="ES" <?= ($endereco->endereco_estado ?? '') == 'ES' ? 'selected' : '' ?>>Espírito Santo</option>
                                    <option value="GO" <?= ($endereco->endereco_estado ?? '') == 'GO' ? 'selected' : '' ?>>Goiás</option>
                                    <option value="MA" <?= ($endereco->endereco_estado ?? '') == 'MA' ? 'selected' : '' ?>>Maranhão</option>
                                    <option value="MT" <?= ($endereco->endereco_estado ?? '') == 'MT' ? 'selected' : '' ?>>Mato Grosso</option>
                                    <option value="MS" <?= ($endereco->endereco_estado ?? '') == 'MS' ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                                    <option value="MG" <?= ($endereco->endereco_estado ?? '') == 'MG' ? 'selected' : '' ?>>Minas Gerais</option>
                                    <option value="PA" <?= ($endereco->endereco_estado ?? '') == 'PA' ? 'selected' : '' ?>>Pará</option>
                                    <option value="PB" <?= ($endereco->endereco_estado ?? '') == 'PB' ? 'selected' : '' ?>>Paraíba</option>
                                    <option value="PR" <?= ($endereco->endereco_estado ?? '') == 'PR' ? 'selected' : '' ?>>Paraná</option>
                                    <option value="PE" <?= ($endereco->endereco_estado ?? '') == 'PE' ? 'selected' : '' ?>>Pernambuco</option>
                                    <option value="PI" <?= ($endereco->endereco_estado ?? '') == 'PI' ? 'selected' : '' ?>>Piauí</option>
                                    <option value="RJ" <?= ($endereco->endereco_estado ?? '') == 'RJ' ? 'selected' : '' ?>>Rio de Janeiro</option>
                                    <option value="RN" <?= ($endereco->endereco_estado ?? '') == 'RN' ? 'selected' : '' ?>>Rio Grande do Norte</option>
                                    <option value="RS" <?= ($endereco->endereco_estado ?? '') == 'RS' ? 'selected' : '' ?>>Rio Grande do Sul</option>
                                    <option value="RO" <?= ($endereco->endereco_estado ?? '') == 'RO' ? 'selected' : '' ?>>Rondônia</option>
                                    <option value="RR" <?= ($endereco->endereco_estado ?? '') == 'RR' ? 'selected' : '' ?>>Roraima</option>
                                    <option value="SC" <?= ($endereco->endereco_estado ?? '') == 'SC' ? 'selected' : '' ?>>Santa Catarina</option>
                                    <option value="SP" <?= ($endereco->endereco_estado ?? '') == 'SP' ? 'selected' : '' ?>>São Paulo</option>
                                    <option value="SE" <?= ($endereco->endereco_estado ?? '') == 'SE' ? 'selected' : '' ?>>Sergipe</option>
                                    <option value="TO" <?= ($endereco->endereco_estado ?? '') == 'TO' ? 'selected' : '' ?>>Tocantins</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Salvar Endereço</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>