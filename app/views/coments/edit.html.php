<?php ob_start(); $form = new FormHelper;?>
<div class="d-flex justify-content-center">
<div class="col-md-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Editar Comentario</h4>
                  <form class="forms-sample"enctype="multipart/form-data" action="<?php echo ROOT_PATH."coments/edit/".$data['coment']->id;?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputUsername1">Titulo</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="contenido" value="<?php echo $data['coment']['contenido']?>" >
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