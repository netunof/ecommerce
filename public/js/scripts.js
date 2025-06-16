// Função para validação de formulários
function setupFormValidation() {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Validação específica para formulários de cliente
            if (form.querySelector('#confirmar_senha')) {
                const senha = document.getElementById('cliente_senha').value;
                const confirmarSenha = document.getElementById('confirmar_senha').value;
                
                if (senha !== confirmarSenha) {
                    event.preventDefault();
                    event.stopPropagation();
                    alert('As senhas não coincidem!');
                    document.getElementById('confirmar_senha').classList.add('is-invalid');
                } else {
                    document.getElementById('confirmar_senha').classList.remove('is-invalid');
                }
            }

            form.classList.add('was-validated');
        }, false);
    });
}

// Função para busca de CEP
function setupCepLookup() {
    const cepField = document.getElementById('cep');
    if (cepField) {
        cepField.addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length !== 8) return;
            
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('logradouro').value = data.logradouro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';
                        if (document.getElementById('numero')) {
                            document.getElementById('numero').focus();
                        }
                    }
                })
                .catch(error => console.error('Erro ao buscar CEP:', error));
        });
    }
}

// Função para manipulação de fotos de produtos
function setupProductPhotos() {
    const deleteModal = document.getElementById('deletePhotoModal');
    if (deleteModal) {
        const modalInstance = new bootstrap.Modal(deleteModal);
        let fotoIdToDelete = null;
        
        // Adiciona evento nos botões de deletar
        document.querySelectorAll('.delete-photo').forEach(button => {
            button.addEventListener('click', function() {
                fotoIdToDelete = this.getAttribute('data-foto-id');
                document.getElementById('foto_id_to_delete').value = fotoIdToDelete;
                modalInstance.show();
            });
        });
        
        // Confirmação de deleção
        document.getElementById('confirmDeletePhoto')?.addEventListener('click', function() {
            if (fotoIdToDelete) {
                fetch(`/produtoFoto/${fotoIdToDelete}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text || 'Network response was not ok');
                        });
                    }
                    return response.json().catch(() => {
                        // Fallback for empty but successful responses
                        return { success: true };
                    });
                })
                .then(data => {
                    if (data.success) {
                        const photoItem = document.querySelector(`.photo-item [data-foto-id="${fotoIdToDelete}"]`)?.closest('.photo-item');
                        if (photoItem) photoItem.remove();
                    } else {
                        alert('Erro ao remover foto: ' + (data.message || 'Erro desconhecido'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Erro ao remover foto: ' + error.message);
                })
                .finally(() => {
                    modalInstance.hide();  // ← This ensures the modal closes in all cases
                });
            }
        });
    }
}

// Função para adicionar ao carrinho
function setupAddToCart() {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            // Implemente sua lógica de carrinho aqui
            console.log('Added product ID:', productId);
            
            // Feedback visual
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Adicionado';
            this.classList.add('btn-success');
            this.classList.remove('btn-outline-primary');
            
            setTimeout(() => {
                this.innerHTML = originalText;
                this.classList.remove('btn-success');
                this.classList.add('btn-outline-primary');
            }, 2000);
        });
    });
}

// Função para atualizar quantidade
function setupQuantityControls() {
    function updateQuantity(change) {
        const quantityInput = document.getElementById('productQuantity');
        if (quantityInput) {
            let newValue = parseInt(quantityInput.value) + change;
            const maxStock = parseInt(quantityInput.max) || 100;
            
            if (newValue < 1) newValue = 1;
            if (newValue > maxStock) newValue = maxStock;
            
            quantityInput.value = newValue;
        }
    }

    const minusBtn = document.querySelector('button[onclick="updateQuantity(-1)"]');
    const plusBtn = document.querySelector('button[onclick="updateQuantity(1)"]');
    
    if (minusBtn && plusBtn) {
        minusBtn.removeAttribute('onclick');
        plusBtn.removeAttribute('onclick');
        
        minusBtn.addEventListener('click', () => updateQuantity(-1));
        plusBtn.addEventListener('click', () => updateQuantity(1));
    }
}

// Função para ordenação
function setupSorting() {
    const sortSelect = document.querySelector('select.form-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            console.log('Sort by:', this.value);
            // Implemente sua lógica de ordenação aqui
        });
    }
}

// Adicionar nova categoria
document.getElementById('salvarNovaCategoria').addEventListener('click', function() {
    const nome = document.getElementById('nova_categoria_nome').value.trim();
    const form = document.getElementById('formNovaCategoria');
    
    if (!nome) {
        form.classList.add('was-validated');
        return;
    }
    
    const formData = new FormData();
    formData.append('categoria_nome', nome);
    
    fetch('/categoria/store', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Adiciona a nova opção ao select
            const select = document.getElementById('categoria_fk');
            const option = document.createElement('option');
            option.value = data.categoria_id;
            option.textContent = nome;
            select.appendChild(option);
            select.value = data.categoria_id;
            
            // Fecha o modal e limpa o formulário
            const modal = bootstrap.Modal.getInstance(document.getElementById('novaCategoriaModal'));
            modal.hide();
            form.reset();
            form.classList.remove('was-validated');
        } else {
            alert('Erro ao criar categoria: ' + (data.message || 'Erro desconhecido'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erro ao criar categoria');
    });
});

// Adicionar nova marca
document.getElementById('salvarNovaMarca').addEventListener('click', function() {
    const nome = document.getElementById('nova_marca_nome').value.trim();
    const form = document.getElementById('formNovaMarca');
    const logoInput = document.getElementById('nova_marca_logo');
    
    if (!nome) {
        form.classList.add('was-validated');
        return;
    }
    
    const formData = new FormData();
    formData.append('marca_nome', nome);
    if (logoInput.files[0]) {
        formData.append('marca_logo', logoInput.files[0]);
    }
    
    fetch('/marca/store', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Adiciona a nova opção ao select
            const select = document.getElementById('marca_fk');
            const option = document.createElement('option');
            option.value = data.marca_id;
            option.textContent = nome;
            select.appendChild(option);
            select.value = data.marca_id;
            
            // Fecha o modal e limpa o formulário
            const modal = bootstrap.Modal.getInstance(document.getElementById('novaMarcaModal'));
            modal.hide();
            form.reset();
            form.classList.remove('was-validated');
        } else {
            alert('Erro ao criar marca: ' + (data.message || 'Erro desconhecido'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erro ao criar marca');
    });
});

// Resetar modais quando fechados
document.getElementById('novaCategoriaModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('formNovaCategoria').reset();
    document.getElementById('formNovaCategoria').classList.remove('was-validated');
});

document.getElementById('novaMarcaModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('formNovaMarca').reset();
    document.getElementById('formNovaMarca').classList.remove('was-validated');
});

//Vai para a barra de pesquisa ao clicar no botão do rodapé
document.getElementById('focusSearchLink').addEventListener('click', function(e) {
e.preventDefault(); // Impede o comportamento padrão do link

// Verifica se o campo de pesquisa existe na página atual
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.focus();
    
    // Rolagem suave até o campo (opcional)
    searchInput.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });
}});

// Inicializa todas as funções quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    setupFormValidation();
    setupCepLookup();
    setupProductPhotos();
    setupAddToCart();
    setupQuantityControls();
    setupSorting();
});