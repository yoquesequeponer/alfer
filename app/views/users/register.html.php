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
        
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="thin text-center">Register a new account</h3>
                    <p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signin.html">Login</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
                    <hr>

                    <form enctype="multipart/form-data" action="<?php echo ROOT_PATH."users/register";?>" method="POST">
                        <div class="top-margin">
                            <label>User Name</label>
                            <?= $form->input('text', ['name'=>'userName']) ?>
                        </div>
                        <div class="top-margin">
                            <label>Nombre</label>
                            <?= $form->input('text', ['name'=>'nombre']) ?>
                        </div>
                        <div class="top-margin">
                            <label>Apellido</label>
                            <?= $form->input('text', ['name'=>'apellido']) ?>
                        </div>
                        <div class="top-margin">
                            <label>Correo<span class="text-danger">*</span></label>
                            <?= $form->input('text', ['name'=>'correo']) ?>
                        </div>

                        <div class="row top-margin">
                            <div class="col-sm-6">
                                <label>Password <span class="text-danger">*</span></label>
                                <?= $form->input('password', ['name'=>'password']) ?>
                            </div>
                        <div class="top-margin">
                            <label>Foto</label>
                            <div class="dropdown">
                                <button class="btn btn-danger btn-lg dropdown-toggle" type="button" id="dropdownMenuSizeButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton1">

                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                            
                            <input type="file" class="form-control file-upload-info" name="foto" required>
                        </div>






                            <!-- Controlar que antes del login ambas contraseñas sean identicas -->



                            <!-- <div class="col-sm-6">
                                <label>Confirm Password <span class="text-danger">*</span></label>
                                < ?= // $form->input('password', ['name'=>'password']) ?>
                            </div> -->
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-8">
                                <label class="checkbox">
                                    <input type="checkbox"> 
                                    I've read the <a href="page_terms.html">Terms and Conditions</a>
                                </label>                        
                            </div>
                            <div class="col-lg-4 text-right">
                                <!-- <button class="btn btn-action" type="submit">Register</button> -->
                                <?= $form->input('submit', ['name'=>'submit','value'=>'submit']) ?>
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


