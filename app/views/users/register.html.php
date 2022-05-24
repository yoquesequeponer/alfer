<?php ob_start(); $form = new FormHelper;?>
<div class="d-flex justify-content-center">
<div class="col-md-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Nueva categoria</h4>
                  <form class="forms-sample"enctype="multipart/form-data" action="<?php echo ROOT_PATH."users/register/"?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="userName" required >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nombre" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Apellido</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="apellido"  required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Password</label>
                      <input type="password" class="form-control" id="exampleInputUsername1" name="password" required >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Correo</label>
                      <input type="email" class="form-control" id="exampleInputUsername1" name="correo"  required>
                    </div>
                    <div class="form-group">
                    <div class="top-margin">
                            <label>Foto</label>
                            <input type="file" class="form-control file-upload-info" name="foto" required>
                        </div>

                  </div> 
                   <?= $form->input('submit', ['name'=>'submit','value'=>'submit', 'class'=>'btn btn-primary me-2']) ?>
                   <a class="btn btn-light" href="<?= ROOT_PATH ?>">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            </div>

            <?php $content = ob_get_clean()?>
<?php include 'app/views/adminlayout.html.php'?>


