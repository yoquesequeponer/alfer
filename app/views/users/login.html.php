
<?php ob_start(); 
$form = new FormHelper;
?>
	<div class="container">
<div class="row">
    
    <!-- Article main content -->
    <article class="col-xs-12 maincontent">
        <header class="page-header">
            <h1 class="page-title">Sign in</h1>
        </header>
        
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="thin text-center">Sign in to your account</h3>
                    <p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signup.html">Register</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
                    <hr>
                    
                    <form enctype="multipart/form-data" action="<?php echo ROOT_PATH."users/login";?>" method="POST">
                        <div class="top-margin">
                            <label>Email <span class="text-danger">*</span></label>
                            <?= $form->input('text', ['name'=>'correo']) ?>
                        </div>
                        <div class="top-margin">
                            <label>Password <span class="text-danger">*</span></label>
                            <?= $form->input('password', ['name'=>'password']) ?>
                        </div>

                        <hr>

                        <div class="row">
                            <!-- <div class="col-lg-8">
                                <b><a href="">Forgot password?</a></b>
                            </div> -->
                            <div class="col-lg-4 text-right">
                                <!-- <button class="btn btn-action" type="submit">Sign in</button> -->
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


