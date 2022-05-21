<?php ob_start(); $form = new FormHelper;?>
<div class="d-flex justify-content-center">
<div class="col-md-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Nueva categoria</h4>
                  <form class="forms-sample"enctype="multipart/form-data" action="<?php echo ROOT_PATH."admin/rol/".$data['user']->id;?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="<?php echo $data['user']['userName']?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email"value="<?php echo $data['user']['correo']?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Rol</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email"value="<?php echo $data['user']['correo']?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Rol</label>
                        <select class="select2-selection select2-selection--single" name="select">
                          <option value="0" <?php if($data['user']->rol == 0){ echo 'selected="selected"'; }?>>0</option>

                          <option value="1"<?php if($data['user']->rol == 1){ echo 'selected="selected"'; }?>>1</option>
                        </select>
                    </div>
                    <?= $form->input('submit', ['name'=>'submit','value'=>'submit', 'class'=>'btn btn-primary me-2']) ?>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
            <?php $content = ob_get_clean()?>
<?php include 'app/views/adminlayout.html.php'?>