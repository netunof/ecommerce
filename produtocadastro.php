<?php include_once 'topo.php'; ?>
<main class="page product-page">
    <section class="clean-block clean-product dark" style="padding:0px;padding-bottom:0px;margin:0px;margin-top:0px;">
        <div class="container">
            <form action="produtocreate.php">
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <label style="margin:10px;">Faça o upload das fotos do produto</label>
                                <input type="file" name="fotoproduto" style="padding:0px;width:392px;margin:10px;margin-top:10px;">
                                <input type="file" name="fotoproduto1" style="padding:0px;width:392px;margin:10px;margin-top:10px;">
                                <input type="file" name="fotoproduto2" style="padding:0px;width:392px;margin:10px;margin-top:10px;">
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <input type="text" name="nomeproduto" placeholder="Insira o nome">
                                    <div class="price">
                                        <input type="number" name="precoproduto" placeholder="Insira o preço" min="0" max="999999" step="0.01" style="width:128px;">
                                    </div>
                                    <div class="summary">
                                        <textarea name="descproduto" placeholder="Insira a descrição" style="width:400px;height:100px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div>
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <a class="nav-link active" role="tab" data-toggle="tab" href="#description" id="description-tab">Descrição</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane active fade show description" role="tabpanel" id="description">
                                    <textarea name="detalhada" placeholder="Insira a descrição detalhada" style="width:740px;height:114px;"></textarea>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <figure class="figure">
                                                <label style="margin:12px;">Faça o upload da foto da feature</label>
                                                <input type="file" name="fotofeature1" style="height:33px;width:294px;margin:0px;margin-top:41px;">
                                            </figure>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="titulofeature1" placeholder="Insira o título da feature" style="width:400px;">
                                            <textarea name="feature1" placeholder="Insira alguma feature" style="width:400px;height:150px;"></textarea></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 right">
                                            <input type="text" name="titulofeature2" placeholder="Insira o título da feature" style="width:400px;">
                                            <textarea name="feature2" placeholder="Insira alguma feature" style="width:400px;height:150px;"></textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <figure class="figure">
                                                <label style="margin:12px;">Faça o upload da foto da feature</label>
                                                <input type="file" name="fotofeature2" style="height:33px;width:294px;margin:0px;margin-top:41px;">
                                            </figure>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control-sm" name="categoria">
                            <option value="acessorio">Acessório</option>
                            <option value="armazenamento">Armazenamento</option>
                            <option value="gabinete">Gabinete</option>
                            <option value="memoria">Memória</option>
                            <option value="periferico">Periférico</option>
                            <option value="placamae">Placa-mãe</option>
                            <option value="placadevideo">Placa de vídeo</option>
                            <option value="processador">Processador</option>
                        </select>
                        <label>Marca</label>
                        <select class="form-control-sm" name="marca">
                            <option value="adata">Adata</option>
                            <option value="amd">AMD</option>
                            <option value="asrock">Asrock</option>
                            <option value="asus">Asus</option>
                            <option value="coolermaster">Coolermaster</option>
                            <option value="corsair">Corsair</option>
                            <option value="edifier">Edifier</option>
                            <option value="dell">Dell</option>
                            <option value="gigabyte">Gigabyte</option>
                            <option value="intel">Intel</option>
                            <option value="kingston">Kingston</option>
                            <option value="logitech">Logitech</option>
                            <option value="microsoft">Microsoft</option>
                            <option value="msi">MSI</option>
                            <option value="nvidia">Nvidia</option>
                            <option value="radeon">Radeon</option>
                            <option value="razer">Razer</option>
                            <option value="seagate">Seagate</option>
                            <option value="thermaltake">Thermaltake</option>
                            <option value="wd">WD</option>
                        </select>
                    </div>
                    <textarea name="specsproduto" placeholder="Insira as especificações técnicas" style="width:740px;margin-left:72px;"></textarea>
                    <button class="btn btn-primary" type="submit" style="margin-left:300px;">Submeter</button>
                    <button class="btn btn-danger" type="reset" style="margin-left:30px;margin-bottom:0px;margin-right:0px;">Limpar</button>
                </div>
            </form>
        </div>
    </section>
</main>
<?php include_once 'fundo.php'; ?>