

<?php ob_start(); $form = new FormHelper;?>
<div class="d-flex justify-content-center">
<div class="col-md-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Nueva categoria</h4>
                  <form class="forms-sample"enctype="multipart/form-data" action="<?php echo ROOT_PATH."admin/addCategory";?>" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="descripcion">
                    </div>
                    <?= $form->input('submit', ['name'=>'submit','value'=>'submit', 'class'=>'btn btn-primary me-2']) ?>
                    <a class="btn btn-light" href="<?= ROOT_PATH ?>admin/admin">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            </div>
            <?php $content = ob_get_clean()?>
<?php include 'app/views/adminlayout.html.php'?>