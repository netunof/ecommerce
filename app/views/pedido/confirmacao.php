<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm text-center">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h1 class="mb-3">Pedido Confirmado!</h1>
                    <p class="lead mb-4">Obrigado por comprar conosco, <?= htmlspecialchars($cliente->cliente_nome) ?>!</p>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Detalhes do Pedido</h5>
                        </div>
                        <div class="card-body text-start">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Número do Pedido:</strong></p>
                                    <p><?= $pedido->pedido_id ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Data:</strong></p>
                                    <p><?= date('d/m/Y H:i', strtotime($pedido->created_at)) ?></p>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <p class="mb-1"><strong>Total:</strong></p>
                                <p>R$ <?= number_format($pedido->total, 2, ',', '.') ?></p>
                            </div>
                            
                            <div class="mb-3">
                                <p class="mb-1"><strong>Itens do Pedido:</strong></p>
                                <ul class="list-group">
                                    <?php foreach ($itens as $item): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <?php if ($item->file_path): ?>
                                                    <img src="/<?= htmlspecialchars($item->file_path) ?>" 
                                                         alt="<?= htmlspecialchars($item->produto_nome) ?>" 
                                                         width="50" class="me-3">
                                                <?php endif; ?>
                                                <span><?= htmlspecialchars($item->produto_nome) ?></span>
                                            </div>
                                            <span>
                                                <?= $item->pedido_item_quantidade ?> x 
                                                R$ <?= number_format($item->produto_preco, 2, ',', '.') ?>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="/produtos" class="btn btn-outline-primary">Continuar Comprando</a>
                        <a href="/perfil/pedidos" class="btn btn-primary">Meus Pedidos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>