<?php ob_start(); $form = new FormHelper;?>
<div class="d-flex justify-content-center">
<div class="col-md-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Nueva categoria</h4>
                  <form class="forms-sample"enctype="multipart/form-data" action="<?php echo ROOT_PATH."users/edit/".$data['user']->id;?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="username" value="<?php echo $data['user']['userName']?>" reqired>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nombre"value="<?php echo $data['user']['nombre']?>" reqired>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">apellido</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="apellido"value="<?php echo $data['user']['apellido']?>" reqired>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Password</label>
                      <input type="password" class="form-control" id="exampleInputUsername1" name="password" value="<?php echo $data['user']['password']?>" reqired>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Correo</label>
                      <input type="email" class="form-control" id="exampleInputUsername1" name="correo" value="<?php echo $data['user']['correo']?>" disabled>
                    </div>
                    <div class="form-group">

                        <input accept="image/*" type='file' id="imgInp" name="foto"reqired/>
                        <div class="row">
                          <div class="col-md-6 offset-md-3">
                            <img class="img-fluid" id="blah" src="data:img/jpg;base64,<?php echo base64_encode($data['user']->files->filedata); ?>" alt="your image" />
                          </div>
                        </div>
                        <div>
                        </div>
                      <script>
                        imgInp.onchange = evt => {
                          const [file] = imgInp.files
                          if (file) {
                            blah.src = URL.createObjectURL(file)
                          }
                        }
                      </script>
                    </div>                    
                    <?= $form->input('submit', ['name'=>'submit','value'=>'submit', 'class'=>'btn btn-primary me-2']) ?>
                    <a class="btn btn-light" href="<?= ROOT_PATH ?>users/user">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            </div>
            <?php $content = ob_get_clean()?>
<?php include 'app/views/adminlayout.html.php'?>