        </main> <!-- Closing tag for main content from header -->
        
        <footer class="bg-dark text-white pt-5 pb-3">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-3">
                        <h5 class="text-uppercase mb-4">O que deseja?</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="index.php" class="text-white text-decoration-none"><i class="fas fa-home me-2"></i> Página inicial</a></li>
                            <li class="mb-2"><a href="clientelogin.php" class="text-white text-decoration-none"><i class="fas fa-sign-in-alt me-2"></i> Login</a></li>
                            <li class="mb-2"><a href="admin.php" class="text-white text-decoration-none"><i class="fas fa-lock me-2"></i> Área admin</a></li>
                            <li class="mb-2"><a href="/produtos" class="text-white text-decoration-none"><i class="fas fa-search me-2"></i> Buscar produto</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3">
                        <h5 class="text-uppercase mb-4">Sobre nós</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="crew.php" class="text-white text-decoration-none"><i class="fas fa-users me-2"></i> Quem somos?</a></li>
                            <li class="mb-2"><a href="/faq" class="text-white text-decoration-none"><i class="fas fa-question-circle me-2"></i> FAQ</a></li>
                            <li class="mb-2"><a href="/historico" class="text-white text-decoration-none"><i class="fas fa-history me-2"></i> Histórico</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3">
                        <h5 class="text-uppercase mb-4">Contato</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-envelope me-2"></i> <a href="mailto:freitasnetuno@gmail.com" class="text-white text-decoration-none">freitasnetuno@gmail.com</a></li>
                            <li class="mb-2"><i class="fas fa-phone me-2"></i> (61) 99284-8223</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Brasília - DF</li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3">
                        <h5 class="text-uppercase mb-4">Legal</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="/termos-servico" class="text-white text-decoration-none"><i class="fas fa-file-contract me-2"></i> Termos de serviço</a></li>
                            <li class="mb-2"><a href="/termos-uso" class="text-white text-decoration-none"><i class="fas fa-file-signature me-2"></i> Termos de uso</a></li>
                            <li class="mb-2"><a href="/privacidade" class="text-white text-decoration-none"><i class="fas fa-shield-alt me-2"></i> Política de privacidade</a></li>
                        </ul>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">Formas de pagamento</h6>
                        <div class="payment-methods">
                            <i class="fab fa-cc-visa fa-2x me-2" title="Visa"></i>
                            <i class="fab fa-cc-mastercard fa-2x me-2" title="Mastercard"></i>
                            <i class="fab fa-cc-paypal fa-2x me-2" title="PayPal"></i>
                            <i class="fab fa-cc-amazon-pay fa-2x me-2" title="Amazon Pay"></i>
                        </div>
                    </div>
                    
                    <div class="col-md-6 text-md-end">
                        <h6 class="mb-3">Siga-nos</h6>
                        <div class="social-links">
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin-in fa-lg"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="mb-0">&copy; <?= date("Y"); ?> Grupo Digicommerce. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
        
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        
        <!-- Custom JS -->
        <script src="/public/assets/js/main.js"></script>
    </body>
</html>