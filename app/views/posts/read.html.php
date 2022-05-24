<?php

use Symfony\Component\Console\Helper\Table;

ob_start(); $form = new FormHelper;?>


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
	<div class="posts-wrapper">
   	<div class="post">
      <div class="post-info">
	    <!-- if user likes post, style button differently -->
      	<i 
		  <?php if (userLiked($data['post']->id)): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $data['post']->id ?>"></i>
      	<span class="likes"><?php echo getLikes($data['post']->id); ?></span>
      	
      	

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php if (userDisliked($data['post']->id)): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $data['post']->id ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($data['post']->id); ?></span>
      </div>
   	</div>
  </div>
  <script src="<?php echo ROOT_PATH?>public/assets/js/scripts.js"></script>
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                <?php foreach ($data['coments'] as $table) : ?>

                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="data:img/jpg;base64,<?php echo base64_encode($data['user']->files->filedata); ?>" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold"><?php echo $table->user->userName ?></div>
                                        <?php echo $table->contenido ?>
                                    </div>
                                    <?php if($table->user_id == $_SESSION['user_data']['id']){
                                        echo "<a href=".ROOT_PATH."coments/delete/".$table->id." class="."btn btn-success".">Borrar comentario</a>";
                                    }?>
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
