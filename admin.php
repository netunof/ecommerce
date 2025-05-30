<?php include_once 'topo.php'; ?>
<section class="clean-block clean-form dark" style="margin:20px auto 0px auto;padding-bottom:30px;margin-top:0px;">
    <div class="container">
        <div class="block-heading" style="padding-top:30px;margin-bottom:0px;padding-bottom:30px;">
            <h2 class="text-center text-info">Login de Administrador</h2>
        </div>
        <form action="adminvalida.php" method="post">
            <div class="form-group">
                <label for="name">Login</label>
                <input class="form-control item" type="text" id="name" name="admin">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input class="form-control item" type="password" id="password" name="admpass">
            </div>
                <button class="btn btn-primary btn-block" type="submit">Acessar</button>
        </form>
    </div>
</section>
<?php include_once 'fundo.php'; ?>