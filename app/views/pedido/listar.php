<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Meus Pedidos</h1>
            
            <?php if (empty($pedidos)): ?>
                <div class="alert alert-info">
                    Você ainda não realizou nenhum pedido. <a href="/produtos">Comece a comprar agora</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Data</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?= $pedido->pedido_id ?></td>
                                    <td><?= date('d/m/Y', strtotime($pedido->created_at)) ?></td>
                                    <td>R$ <?= number_format($pedido->total, 2, ',', '.') ?></td>
                                    <td>
                                        <?php
                                        switch ($pedido->estado_nome) {
                                            case 'Rascunho':
                                                echo '<span class="badge bg-primary">Rascunho</span>';
                                                break;
                                            case 'Realizado':
                                                echo '<span class="badge bg-light">Realizado</span>';
                                                break;
                                            case 'Processando':
                                                echo '<span class="badge bg-info">Processando</span>';
                                                break;
                                            case 'Enviado':
                                                echo '<span class="badge bg-warning">Enviado</span>';
                                                break;
                                            case 'Finalizado':
                                                echo '<span class="badge bg-success">Finalizado</span>';
                                                break;
                                            case 'Cancelado':
                                                echo '<span class="badge bg-danger">Cancelado</span>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-dark">Erro</span>';
                                                break;
                                        }?>
                                    </td>
                                    <td>
                                        <a href="/pedido/detalhes/<?= $pedido->pedido_id ?>" 
                                           class="btn btn-sm btn-outline-primary">Detalhes</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>