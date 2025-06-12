<?php include_once __DIR__.'/../layout/cabecalho.php'; ?>

<div class="container my-5">
    <div class="row g-4">
        <!-- Product Images Gallery -->
        <div class="col-lg-6">
            <div class="product-gallery">
                <!-- Main Image -->
                <div class="mb-3 border rounded p-2 bg-light text-center" style="height: 400px;">
                    <?php if (!empty($produtoFotos)): ?>
                        <img id="mainProductImage" 
                             class="img-fluid h-100 object-fit-contain" 
                             src="/public/img/produtos/<?= htmlspecialchars($produtoFotos[0]->file_name) ?>" 
                             alt="<?= htmlspecialchars($produto->produto_nome) ?>">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <span class="text-muted">No images available</span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Thumbnail Gallery -->
                <?php if (count($produtoFotos) > 1): ?>
                <div class="thumbnail-gallery d-flex flex-wrap gap-2">
                    <?php foreach ($produtoFotos as $index => $foto): ?>
                        <div class="border rounded p-1 cursor-pointer" style="width: 80px; height: 80px;">
                            <img class="img-fluid h-100 object-fit-cover" 
                                 src="/public/img/produtos/<?= htmlspecialchars($foto->file_name) ?>" 
                                 alt="Thumbnail <?= $index + 1 ?>"
                                 onclick="document.getElementById('mainProductImage').src = this.src">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div>
                <h1 class="mb-3"><?= htmlspecialchars($produto->produto_nome) ?></h1>
                
                <div class="d-flex align-items-center mb-4">
                    <span class="h3 text-primary fw-bold me-3">R$ <?= number_format($produto->produto_preco, 2, ',', '.') ?></span>
                </div>

                <div class="d-flex gap-2 mb-4">
                    <div class="input-group" style="width: 120px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(-1)">-</button>
                        <input type="number" id="productQuantity" class="form-control text-center" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(1)">+</button>
                    </div>
                    <button class="btn btn-primary flex-grow-1" type="button">
                        <i class="bi bi-cart-plus me-2"></i>Adicionar ao Carrinho
                    </button>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Descrição do Produto</h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($produto->produto_descricao)) ?></p>
                    </div>
                </div>

                <?php if (!empty($produto->produto_caracteristicas)): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Características</h5>
                        <ul class="list-unstyled">
                            <?php foreach (explode("\n", $produto->produto_caracteristicas) as $feature): ?>
                                <?php if (trim($feature)): ?>
                                    <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i><?= htmlspecialchars(trim($feature)) ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function updateQuantity(change) {
        const quantityInput = document.getElementById('productQuantity');
        let newValue = parseInt(quantityInput.value) + change;
        if (newValue < 1) newValue = 1;
        quantityInput.value = newValue;
    }
</script>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>