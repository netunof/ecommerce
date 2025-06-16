<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Seu Carrinho</h1>
            
            <?php if (empty($produtos)): ?>
                <div class="alert alert-info">
                    Seu carrinho está vazio. <a href="/produtos">Continue comprando</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= htmlspecialchars($produto->file_path)?>" alt="" width="50" class="me-3">
                                            <?= htmlspecialchars($produto->produto_nome) ?>
                                        </div>
                                    </td>
                                    <td>R$ <?= number_format($produto->produto_preco, 2, ',', '.') ?></td>
                                    <td>
                                        <form action="/carrinho/atualizar" method="POST" class="d-flex">
                                            <input type="hidden" name="produto_id" value="<?= $produto->produto_id ?>">
                                            <input type="number" name="quantidade" value="<?= $produto->quantidade ?>" min="1" class="form-control form-control-sm" style="width: 70px;">
                                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Atualizar</button>
                                        </form>
                                    </td>
                                    <td>R$ <?= number_format($produto->subtotal, 2, ',', '.') ?></td>
                                    <td>
                                        <a href="/carrinho/remover/<?= $produto->produto_id ?>" class="btn btn-sm btn-outline-danger">Remover</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2"><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="/produtos" class="btn btn-outline-secondary">Continuar comprando</a>
                    <div>
                        <a href="/carrinho/limpar" class="btn btn-outline-danger me-2">Limpar carrinho</a>
                        <a href="<?= isset($_SESSION['cliente_id']) ? '/checkout' : '/login?redirect=/checkout' ?>" class="btn btn-primary">Finalizar compra</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>