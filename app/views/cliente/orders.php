<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <!-- Mesmo menu lateral do profile.php -->
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Meus Pedidos</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($pedidos)): ?>
                        <div class="alert alert-info">Você ainda não realizou nenhum pedido.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nº Pedido</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pedidos as $pedido): ?>
                                        <tr>
                                            <td>#<?= str_pad($pedido->pedido_id, 6, '0', STR_PAD_LEFT) ?></td>
                                            <td><?= date('d/m/Y', strtotime($pedido->created_at)) ?></td>
                                            <td>
                                                <span class="badge bg-<?= 
                                                    $pedido->status == 'pendente' ? 'warning' : 
                                                    ($pedido->status == 'cancelado' ? 'danger' : 'success') 
                                                ?>">
                                                    <?= ucfirst($pedido->status) ?>
                                                </span>
                                            </td>
                                            <td>R$ <?= number_format($pedido->total, 2, ',', '.') ?></td>
                                            <td>
                                                <a href="/pedidos/<?= $pedido->pedido_id ?>" class="btn btn-sm btn-outline-primary">
                                                    Detalhes
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>