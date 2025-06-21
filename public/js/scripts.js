// Utility functions
const debounce = (fn, delay = 300) => {
  let timeoutId;
  return (...args) => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => fn.apply(this, args), delay);
  };
};

const showAlert = (message, type = 'error') => {
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
  alertDiv.setAttribute('role', 'alert');
  alertDiv.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;
  document.body.prepend(alertDiv);
  setTimeout(() => alertDiv.remove(), 5000);
};

// Form validation
const setupFormValidation = () => {
  const forms = document.querySelectorAll('.needs-validation');
  
  forms.forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      // Password confirmation validation
      const confirmPasswordField = form.querySelector('#confirmar_senha');
      if (confirmPasswordField) {
        const password = document.getElementById('cliente_senha').value;
        const confirmPassword = confirmPasswordField.value;
        
        if (password !== confirmPassword) {
          event.preventDefault();
          event.stopPropagation();
          showAlert('As senhas não coincidem!');
          confirmPasswordField.classList.add('is-invalid');
        } else {
          confirmPasswordField.classList.remove('is-invalid');
        }
      }

      form.classList.add('was-validated');
    }, false);
  });
};

// CEP lookup with debounce
const setupCepLookup = () => {
  const cepField = document.getElementById('cep');
  if (!cepField) return;

  const handleCepLookup = debounce(async () => {
    const cep = cepField.value.replace(/\D/g, '');
    if (cep.length !== 8) return;
    
    try {
      const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
      if (!response.ok) throw new Error('CEP não encontrado');
      
      const data = await response.json();
      if (data.erro) throw new Error('CEP não encontrado');

      document.getElementById('logradouro').value = data.logradouro || '';
      document.getElementById('cidade').value = data.localidade || '';
      document.getElementById('estado').value = data.uf || '';
      
      const numeroField = document.getElementById('numero');
      if (numeroField) numeroField.focus();
    } catch (error) {
      console.error('Erro ao buscar CEP:', error);
      showAlert('CEP não encontrado ou erro na consulta');
    }
  });

  cepField.addEventListener('blur', handleCepLookup);
};

// Product photos management
const setupProductPhotos = () => {
  const deleteModal = document.getElementById('deletePhotoModal');
  if (!deleteModal) return;

  const modalInstance = new bootstrap.Modal(deleteModal);
  let fotoIdToDelete = null;
  
  // Delete photo handlers
  document.querySelectorAll('.delete-photo').forEach(button => {
    button.addEventListener('click', () => {
      fotoIdToDelete = button.dataset.fotoId;
      document.getElementById('foto_id_to_delete').value = fotoIdToDelete;
      modalInstance.show();
    });
  });
  
  // Confirm deletion
  document.getElementById('confirmDeletePhoto')?.addEventListener('click', async () => {
    if (!fotoIdToDelete) return;

    try {
      const response = await fetch(`/produtoFoto/${fotoIdToDelete}/delete`, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const data = await response.json().catch(() => ({ success: response.ok }));
      
      if (data.success) {
        document.querySelector(`.photo-item [data-foto-id="${fotoIdToDelete}"]`)?.closest('.photo-item')?.remove();
      } else {
        throw new Error(data.message || 'Erro desconhecido');
      }
    } catch (error) {
      console.error('Error:', error);
      showAlert(`Erro ao remover foto: ${error.message}`);
    } finally {
      modalInstance.hide();
    }
  });
};

// Cart functionality
const setupAddToCart = () => {
  document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', async function() {
      const productId = this.dataset.productId;
      
      try {
        // Example API call - replace with your actual implementation
        // const response = await fetch('/cart/add', {
        //   method: 'POST',
        //   body: JSON.stringify({ productId }),
        //   headers: { 'Content-Type': 'application/json' }
        // });
        // if (!response.ok) throw new Error('Failed to add to cart');
        
        // Visual feedback
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Adicionado';
        this.classList.replace('btn-outline-primary', 'btn-success');
        
        setTimeout(() => {
          this.innerHTML = originalText;
          this.classList.replace('btn-success', 'btn-outline-primary');
        }, 2000);
      } catch (error) {
        console.error('Error adding to cart:', error);
        showAlert('Erro ao adicionar ao carrinho');
      }
    });
  });
};

// Quantity controls
const setupQuantityControls = () => {
  const updateQuantity = (change) => {
    const quantityInput = document.getElementById('productQuantity');
    if (!quantityInput) return;

    let newValue = parseInt(quantityInput.value) + change;
    const maxStock = parseInt(quantityInput.max) || 100;
    
    newValue = Math.max(1, Math.min(newValue, maxStock));
    quantityInput.value = newValue;
  };

  document.querySelector('button[onclick="updateQuantity(-1)"]')?.addEventListener('click', () => updateQuantity(-1));
  document.querySelector('button[onclick="updateQuantity(1)"]')?.addEventListener('click', () => updateQuantity(1));
};

// Sorting functionality
const setupSorting = () => {
  const sortSelect = document.querySelector('select.form-select');
  if (!sortSelect) return;

  sortSelect.addEventListener('change', function() {
    // Implement your sorting logic here
    console.log('Sort by:', this.value);
  });
};

// Category management
const setupCategoryManagement = () => {
  const modal = document.getElementById('novaCategoriaModal');
  if (!modal) return;

  const form = document.getElementById('formNovaCategoria');
  const saveBtn = document.getElementById('salvarNovaCategoria');

  saveBtn?.addEventListener('click', async () => {
    const nome = document.getElementById('nova_categoria_nome').value.trim();
    if (!nome) {
      form.classList.add('was-validated');
      return;
    }
    
    try {
      const formData = new FormData();
      formData.append('categoria_nome', nome);
      
      const response = await fetch('/categoria/store', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      
      const data = await response.json();
      if (!data.success) throw new Error(data.message || 'Erro desconhecido');

      // Add new category to select
      const select = document.getElementById('categoria_fk');
      const option = new Option(nome, data.categoria_id);
      select.add(option);
      select.value = data.categoria_id;
      
      // Close modal and reset form
      bootstrap.Modal.getInstance(modal).hide();
      form.reset();
      form.classList.remove('was-validated');
    } catch (error) {
      console.error('Error:', error);
      showAlert(`Erro ao criar categoria: ${error.message}`);
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    form.classList.remove('was-validated');
  });
};

// Brand management
const setupBrandManagement = () => {
  const modal = document.getElementById('novaMarcaModal');
  if (!modal) return;

  const form = document.getElementById('formNovaMarca');
  const saveBtn = document.getElementById('salvarNovaMarca');

  saveBtn?.addEventListener('click', async () => {
    const nome = document.getElementById('nova_marca_nome').value.trim();
    if (!nome) {
      form.classList.add('was-validated');
      return;
    }
    
    try {
      const formData = new FormData();
      formData.append('marca_nome', nome);
      
      const response = await fetch('/marca/store', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      
      const data = await response.json();
      if (!data.success) throw new Error(data.message || 'Erro desconhecido');

      // Add new brand to select
      const select = document.getElementById('marca_fk');
      const option = new Option(nome, data.marca_id);
      select.add(option);
      select.value = data.marca_id;
      
      // Close modal and reset form
      bootstrap.Modal.getInstance(modal).hide();
      form.reset();
      form.classList.remove('was-validated');
    } catch (error) {
      console.error('Error:', error);
      showAlert(`Erro ao criar marca: ${error.message}`);
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    form.classList.remove('was-validated');
  });
};

// Search focus
const setupSearchFocus = () => {
  document.getElementById('focusSearchLink')?.addEventListener('click', (e) => {
    e.preventDefault();
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
      searchInput.focus();
      searchInput.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
      });
    }
  });
};

// Initialize all functionality
document.addEventListener('DOMContentLoaded', () => {
  setupFormValidation();
  setupCepLookup();
  setupProductPhotos();
  setupAddToCart();
  setupQuantityControls();
  setupSorting();
  setupCategoryManagement();
  setupBrandManagement();
  setupSearchFocus();
});