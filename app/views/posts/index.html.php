<?php

use Symfony\Component\Console\Helper\Table;

ob_start(); ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">
  <a href="<?= ROOT_PATH ?>posts/add" class="btn btn-success">Añadir Libro</a>

  <div class="row content" data-aos="fade-up">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titulo</th>
            <th scope="col">Contenido</th>
            <th scope="col">foto</th>

            <th scope="col">fecha creacion</th>
            
          </tr>
        </thead>
        <?php foreach ($data['posts'] as $table) : ?>
          <tbody>
            <tr>
              <th scope="row"><img src="data:img/jpg;base64,<?php echo base64_encode($table->files->filedata); ?>" alt="" width="100px"></img></th>
              <td><?php echo $table->titulo ?></td>
              <td><?php echo $table->Contenido ?></td>
              <td><?php echo $table->foto ?></td><!--falta meter la categoria, solo puedo meter el id de la categoria
                                                    otra opcion es listar las categorias y los ids y que se guarden los ids-->
              <td><?php echo $table->fechacreacion ?></td>
            </tr>
            <tr>
              <td><a href="<?= ROOT_PATH ?>posts/delete/<?= $table['id'] ?>" class="btn btn-danger">Borrar</a></td>
              <td><a href="<?= ROOT_PATH ?>posts/read/<?= $table['id'] ?>" class="btn btn-info">ver mas</a></td>
            </tr>
          </tbody>
                
        <?php endforeach; ?>
      </table>
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
      <a class="page-link" href="index.php?page=' . $data['page'] - 1 . '" >Previous</a>
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
        <a class="page-link" href="index.php?page=' . $data['page'] - 1 . '" >Previous</a>
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
        <a class="page-link" href="index.php?page=' . $data['page'] + 1 . '" >Next</a>
      </li>';
    } ?>

  </ul>
</nav>


<?php $content = ob_get_clean() ?>
<?php include 'app/views/layout.html.php' ?>