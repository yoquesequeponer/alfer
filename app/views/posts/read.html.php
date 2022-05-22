<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Post - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?php echo ROOT_PATH?>public/template/read/assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo ROOT_PATH?>public/template/read/css/styles.css" rel="stylesheet" />

    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?php echo ROOT_PATH?>public/template/read/#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH?>public/template/read/#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH?>public/template/read/#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH?>public/template/read/#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo ROOT_PATH?>public/template/read/#">Blog</a></li>
                    </ul>
                </div>
            </div>
        </nav>


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
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="<?php echo ROOT_PATH?>public/template/read/js/scripts.js"></script>

    </body>
</html>
