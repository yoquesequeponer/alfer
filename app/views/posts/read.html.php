<?php

use Symfony\Component\Console\Helper\Table;

ob_start(); $form = new FormHelper;?>
<br><br><br><br>


        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php echo $data['post']->titulo ?></h1>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="data:img/jpg;base64,<?php echo base64_encode($data['post']->files->filedata); ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4"><?php echo $data['post']->contenido ?></p>
                        </section>
                    </article>
                    <!-- Comments section-->
                    <a href="<?= ROOT_PATH ?>coments/add/<?php echo $data['post']->id?>" class="btn btn-success">Añadir comentario</a>
	    <!-- if user likes post, style button differently -->
            
      	<i class="fa fa-thumbs-o-up like-btn"
          <?php if(isset($_SESSION['is_logged_in'])) :?>
		  <?php if (userLiked($data['post']->id)): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>

      	  data-id="<?php echo $data['post']->id ?>" <?php endif?>> </i>
            

      	<span class="likes"><?php echo getLikes($data['post']->id); ?></span>
      	
      	

	    <!-- if user dislikes post, style button differently -->


      	<i  class="fa fa-thumbs-o-down dislike-btn"
          <?php if(isset($_SESSION['is_logged_in'])) :?>

      	  <?php if (userDisliked($data['post']->id)): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>

      	  data-id="<?php echo $data['post']->id ?>" <?php endif?>></i>
            
 
      	<span class="dislikes"><?php echo getDislikes($data['post']->id); ?></span>
          <br>
          <h1>Coments</h1>
          <br>
  <script src="<?php echo ROOT_PATH?>public/assets/js/scripts.js"></script>
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <?php foreach ($data['coments'] as $table) : ?>
                                <div class="container">
                                    <div class="d-flex mt-4">
                                        <div class="col-sm-1"><img width="50px" class="rounded-circle" src="data:img/jpg;base64,<?php echo base64_encode($table->user->files->filedata); ?>" alt="..." /></div>
                                        <div class="col-sm">
                                            <div class="fw-bold">User: <?php echo $table->user->userName ?></div>
                                            <?php echo $table->contenido ?>
                                        </div>
                                        <?php if($table->user_id == $_SESSION['user_data']['id']){
                                            echo "<a href=".ROOT_PATH."coments/delete/".$table->id." class="."btn btn-success".">Borrar comentario</a>";
                                        }?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>
                </div>
                </div>
            </div>
        </div>
<?php $content = ob_get_clean() ?>
<?php include 'app/views/layout.html.php' ?>
