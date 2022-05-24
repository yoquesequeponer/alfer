<?php ob_start(); $form = new FormHelper;?>
<div class="d-flex justify-content-center">
<div class="col-md-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Editar post</h4>
                  <form class="forms-sample"enctype="multipart/form-data" action="<?php echo ROOT_PATH."posts/edit/".$data['post']->id;?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputUsername1">Titulo</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="titulo" value="<?php echo $data['post']['titulo']?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contenido</label>
                      <input type="textarea" class="form-control" id="exampleInputEmail1" name="contenido" value="<?php echo $data['post']['contenido']?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Categoria</label>
                        <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="categoria">
                          <?php foreach($data['categorias'] as $categoria):?>
                          <option value="<?php echo $categoria->id?>" <?php if($categoria->id == $data['post']['id'] ){ echo 'selected="selected"'; }?>   ><?php echo $categoria->descripcion?></option>
                          <?php endforeach ?>
                        </select>
                    </div>

                    <?= $form->input('submit', ['name'=>'submit','value'=>'submit', 'class'=>'btn btn-primary me-2']) ?>
                    <a class="btn btn-light" href="<?= ROOT_PATH ?>escritor/escritor">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            </div>
            <?php $content = ob_get_clean()?>
<?php include 'app/views/adminlayout.html.php'?>