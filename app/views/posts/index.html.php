<?php

use Symfony\Component\Console\Helper\Table;

ob_start(); $form = new FormHelper;?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">

<form enctype="multipart/form-data" action="<?php echo ROOT_PATH."posts/index";?>" method="POST">
<?php foreach ($data['categorias'] as $categoria) : ?>
  <div class="custom-control custom-radio">
  <input type="radio" id="customRadio1" class="custom-control-input" value="<?php echo($categoria->id)?>" name="category">
    <label class="custom-control-label"><?php echo($categoria->descripcion)?></label>
  </div>
<?php endforeach?>
<?= $form->input('submit', ['name'=>'submit','value'=>'submit']) ?>
</form>

  <?php $numero = 0?>
      <div class="row">
        <?php foreach ($data['posts'] as $table) : ?>
          <?php if ($numero == 4) {
            break;
          }?>
          <div class="col-md-3 col-sm-6 highlight">
					  <div class="h-caption"><h4><img src="data:img/jpg;base64,<?php echo base64_encode($table->files->filedata); ?>"></h4></div>
					  <div class="h-body text-center">
					  	<p><?php echo $table->contenido ?></p>
              <a href="<?php echo ROOT_PATH ."posts/read/". $table->id?>">Leer mas</a>
					  </div>
          </div>
          <?php $numero = $numero + 1?>                
        <?php endforeach; ?>
      </div>
  </div>
</div>

<nav aria-label="...">
  <ul class="pagination">
    <?php if ($data['page'] == 1 || $data['page'] == 2) {
      $resta = 0;
      $disabled = 'disabled';
      if ($data['page'] == 2) {
        $resta = 1;
        $disabled = '';
      }
      ///die(print($disabled).'---->'.print($data['page']));
      echo
      '<li class="page-item ' . $disabled . '">
      <a class="page-link" href="index.php?page=' .($data['page'] - 1)  . '" >Previous</a>
    </li>';

      for ($i = $data['page'] - $resta; $i < $data['numpages']; $i++) {
        //die(print($resta)); 
        if ($i < $data['page'] + 3) {
          if ($i == $data['page']) {
            echo '<li class="page-item active"> <a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
          } else {
            echo '<li class="page-item"> <a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
          }
        }
      }
    } else {
      echo '<li class="page-item">
        <a class="page-link" href="index.php?page=' .  ($data['page'] - 1)  . '" >Previous</a>
      </li>';
    }

    ?>
    <?php if ($data['page'] > 2) {
      for ($i = $data['page'] - 2; $i <= $data['numpages']; $i++) { //primero los del medio 2 alante dos atras y despues los dos primero y los dos ultimos, pero con 2 bucles

        if ($i < $data['page'] + 3) {
          if ($i == $data['page']) {
            echo '<li class="page-item active"> <a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
          } else {
            echo '<li class="page-item"> <a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
          }
        } else if ($i == $data['page'] + 3) {
          echo '<li class="page-item"> <a class="page-link" href="#">...</a></li>';
        }
      }
    } ?>
    <?php if ($data['page'] == 1 || $data['page'] == 2) {
      echo '<li class="page-item"> <a class="page-link" href="#">...</a></li>';
    } ?>
    <?php if ($data['page'] == $data['numpages']) {
      echo
      '<li class="page-item disabled">
      <a class="page-link" href="index.php?page=' . $data['page'] . '" >Next</a>
    </li>';
    } else {
      echo '<li class="page-item">
        <a class="page-link" href="index.php?page=' . ($data['page'] + 1) . '" >Next</a>
      </li>';
    } ?>

  </ul>
</nav>



<?php $content = ob_get_clean() ?>
<?php include 'app/views/layout.html.php' ?>