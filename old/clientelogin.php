<?php include_once 'topo.php'; ?>
<?php if (isset($_SESSION['logado'])){
    echo "<div class='jumbotron text-center'>".$_SESSION['email']." já está logado</div>";
}
else {
    echo "<main class='page login-page' style='height:500px;'>
    <section class='clean-block clean-form dark' style='margin:20px auto 0px auto;padding:0;margin-top:0px;'>
        <div class='container' style='height:500px;'>
            <div class='block-heading' style='padding:45px;margin:0;padding-top:30px;padding-bottom:30px;padding-right:0px;padding-left:0px;'>
                <h2 class='text-info'>Faça seu login</h2>
                <p>Ainda não possui login?&nbsp;<a href='clientecadastro.php'>Cadastre-se</a></p>
            </div>
            <form style='margin-right:auto;margin-left:auto;' action='clientevalida.php' method='post'>
                <div class='form-group'>
                    <label for='email'>Login</label>
                    <input class='form-control item' type='email' id='email' name='email'>
                </div>
                <div class='form-group'>
                    <label for='password'>Senha</label>
                    <input class='form-control' type='password' id='password' name='senha'>
                </div>
                <div class='form-group'>
                    <br>
                    <!-- por enquanto não implementa
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' id='checkbox'>
                        <label class='form-check-label' for='checkbox'>Me mantenha conectado</label>
                    </div>
                    -->
                </div>
                <button class='btn btn-primary btn-block' type='submit'>Entrar</button>
            </form>
        </div>
    </section>
</main>";
}
?>

<?php include_once 'fundo.php'; ?>