<?php ob_start();
$form = new FormHelper;
?>
	<div class="container">
<div class="row">
    
    <!-- Article main content -->
    <article class="col-xs-12 maincontent">
        <header class="page-header">
            <h1 class="page-title"></h1>
        </header>
        <br><br><br><br>
        
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">   
                <form enctype="multipart/form-data" action="<?php echo ROOT_PATH."coments/add/".array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0]?>" method="POST">
                        <div class="top-margin">
                            <label>Contenido <span class="text-danger"></span></label>
                            <?= $form->input('text', ['name'=>'contenido']) ?>
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