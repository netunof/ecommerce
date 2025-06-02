<?php include_once 'topo.php'; ?>
<main class="page registration-page">
    <section class="clean-block clean-form dark" style="margin:20px auto 0px auto;padding-bottom:30px;">
        <div class="container" style="margin:0px auto;">
            <div class="block-heading" style="padding-top:30px;padding-bottom:30px;margin-bottom:0px;">
                <h2 class="text-center text-info">Cadastre-se</h2>
                <p>Faça seu cadastro e aproveite todas as vantagens da nossa loja.</p>
            </div>
            <form action="clientecreate.php">
                <div class="form-group">
                    <label for="name">Nome</label><input class="form-control item" type="text" id="name" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="name">E-mail</label><input class="form-control item" type="email" id="name" name="email" required>
                </div>
                <div class="form-group">
                    <label for="formCheck-1">Sexo</label>
                    <div class="form-check" style="width:100px;">
                        <input class="form-check-input" type="radio" id="formCheck-1" name="sexo" value="F">
                        <label class="form-check-label" for="formCheck-2">Feminino</label>
                    </div>
                    <div class="form-check" style="width:100px;">
                        <input class="form-check-input" type="radio" id="formCheck-1" name="sexo" value="M">
                        <label class="form-check-label" for="formCheck-1">Masculino</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Telefone Fixo</label>
                    <input class="form-control item" type="text" id="name" name="fixo">
                </div>
                <div class="form-group">
                    <label for="name">Celular</label>
                    <input class="form-control item" type="text" id="name" name="celular" required>
                </div>
                <div class="form-group">
                    <label for="name">CPF</label>
                    <input class="form-control item" type="text" id="name" name="cpf" required>
                </div>
                <div class="form-group">
                    <label for="name">RG</label>
                    <input class="form-control item" type="text" id="name" name="rg" required>
                </div>
                <div class="form-group">
                    <label for="name">Data de nascimento</label>
                    <input class="form-control item" type="date" id="name" name="nascimento" placeholder="aaaa-mm-dd" required>
                </div>
                <div class="form-group">
                    <label for="name">CEP</label>
                    <input class="form-control item" type="text" id="cep" name="cep" onblur="buscaCEP(this.value);" required>
                </div>
                <div class="form-group">
                    <label for="name">Logradouro</label>
                    <input class="form-control item" type="text" id="logradouro" name="logradouro" required>
                </div>
                <div class="form-group">
                    <label for="name">Bairro</label>
                    <input class="form-control item" type="text" id="bairro" name="bairro">
                </div>
                <div class="form-group">
                    <label for="name">Cidade</label>
                    <input class="form-control item" type="text" id="cidade" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="name">UF</label>
                    <input class="form-control item" type="text" id="uf" name="uf" required>
                </div>
                <div class="form-group">
                    <label for="name">Número</label>
                    <input class="form-control" type="number" name="numero" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control item" type="password" id="password" name="senha" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
                <button class="btn btn-danger btn-block" type="reset">Limpar</button>
            </form>
        </div>
    </section>
</main>
<script>
    function buscaCEP(vl_cep)
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function ()
        {
            //alert(xmlhttp.readyState);
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {

                var obj = JSON.parse(xmlhttp.responseText);
                //document.getElementById("cep").innerHTML = obj.cep;
                document.getElementById("logradouro").value = obj.logradouro;
                document.getElementById("bairro").value = obj.bairro;
                document.getElementById("cidade").value = obj.localidade;
                document.getElementById("uf").value = obj.uf;
            }
        }
        xmlhttp.open("GET", "https://viacep.com.br/ws/" + vl_cep + "/json/", true);
        xmlhttp.send();
    }
</script>
<?php include_once 'fundo.php'; ?>