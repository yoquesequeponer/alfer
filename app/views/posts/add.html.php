<?php ob_start();
$form = new FormHelper;
?>
	<div class="container">

<div class="row">
    
    <!-- Article main content -->
    <article class="col-xs-12 maincontent">
        <header class="page-header">
            <h1 class="page-title">Registration</h1>
        </header>
        
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="thin text-center">Register a new account</h3>
                    <p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signin.html">Login</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
                    <hr>

                    <form enctype="multipart/form-data" action="<?php echo ROOT_PATH."posts/add";?>" method="POST">
                        <div class="top-margin">
                            <label>Titulo</label>
                            <input type="text" class="form-control file-upload-info" name="titulo" required>
                        </div>
                        <div class="top-margin">
                            <label>Contenido</label>
                            <input type="text" class="form-control file-upload-info" name="contenido" required>

                        </div>
                        <div class="top-margin">
                            <label>Foto</label>
                            <input type="file" class="form-control file-upload-info" name="foto" required>
                        </div>
                        <div class="top-margin">
                            <label>Categoria</label>
                            <Select name="select">
                            <?php foreach ($data['categorias'] as $categoria) : ?>
                                <option  value="<?php echo($categoria->id)?>"><?php echo($categoria->descripcion)?></option>
                            <?php endforeach?>
                            </Select>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 text-right">
                                <!-- <button class="btn btn-action" type="submit">Register</button> -->
                                <?= $form->input('submit', ['name'=>'submit','value'=>'submit']) ?>
                                 <a class="btn btn-light" href="<?= ROOT_PATH ?>">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        
    </article>
    <!-- /Article -->

</div>
</div>	<!-- /container -->
<?php $content = ob_get_clean()?>
<?php include 'app/views/layout.html.php'?>


