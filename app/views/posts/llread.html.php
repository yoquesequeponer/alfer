<?php ob_start();?>
	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">About</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">About us</h1>
				</header>
               
				<h3><?php echo $data['post']->titulo ?></h3>
				<p><img src="assets/images/mac.jpg" alt="" class="img-rounded pull-right" width="300" > </p>
                <p><?php echo $data['post']->contenido ?></p>
			
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<!-- <aside class="col-sm-4 sidebar sidebar-right">

				<div class="widget">
					<h4>Vacancies</h4>
					<ul class="list-unstyled list-spaces">
						<li><a href="">Lorem ipsum dolor</a><br><span class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, laborum.</span></li>
						<li><a href="">Totam, libero, quis</a><br><span class="small text-muted">Suscipit veniam debitis sed ipsam quia magnam eveniet perferendis nisi.</span></li>
						<li><a href="">Enim, sequi dignissimos</a><br><span class="small text-muted">Reprehenderit illum quod unde quo vero ab inventore alias veritatis.</span></li>
						<li><a href="">Suscipit, consequatur, aut</a><br><span class="small text-muted">Sed, mollitia earum debitis est itaque esse reiciendis amet cupiditate.</span></li>
						<li><a href="">Nam, illo, veritatis</a><br><span class="small text-muted">Delectus, sapiente illo provident quo aliquam nihil beatae dignissimos itaque.</span></li>
					</ul>
				</div>

			</aside> -->
			<!-- /Sidebar -->


		</div>
	</div>	<!-- /container -->
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


    <div class="column">
    <div class="row">
            <?php foreach ($data['coments'] as $table) : ?>
                <div class="row">
              <div class="col-md-3 col-sm-6 highlight">
		    			  <div class="h-body text-center">
                            <p>Nombre Usuario: <?php echo $table->user->userName ?></p>
		    			  	<p>Contenido comentario: <?php echo $table->contenido ?></p>
		    			  </div>
						<?php if($table->user_id == $_SESSION['user_data']['id']){
								echo "<a href=".ROOT_PATH."coments/delete/".$table->id." class="."btn btn-success".">Borrar comentario</a>";
						}
						?>

              </div>
              </div>
            <?php endforeach; ?>
      </div>
      </div>
      <script>$(document).ready(function(){

// if the user clicks on the like button ...
$('.like-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
  	action = 'like';
  } else if($clicked_btn.hasClass('fa-thumbs-up')){
  	action = 'unlike';
  }
  $.ajax({
  	url: 'index.php',
  	type: 'post',
  	data: {
  		'action': action,
  		'post_id': post_id
  	},
  	success: function(data){
  		res = JSON.parse(data);
  		if (action == "like") {
  			$clicked_btn.removeClass('fa-thumbs-o-up');
  			$clicked_btn.addClass('fa-thumbs-up');
  		} else if(action == "unlike") {
  			$clicked_btn.removeClass('fa-thumbs-up');
  			$clicked_btn.addClass('fa-thumbs-o-up');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);

  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
  	}
  });		

});

// if the user clicks on the dislike button ...
$('.dislike-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
  	action = 'dislike';
  } else if($clicked_btn.hasClass('fa-thumbs-down')){
  	action = 'undislike';
  }
  $.ajax({
  	url: 'index.php',
  	type: 'post',
  	data: {
  		'action': action,
  		'post_id': post_id
  	},
  	success: function(data){
  		res = JSON.parse(data);
  		if (action == "dislike") {
  			$clicked_btn.removeClass('fa-thumbs-o-down');
  			$clicked_btn.addClass('fa-thumbs-down');
  		} else if(action == "undislike") {
  			$clicked_btn.removeClass('fa-thumbs-down');
  			$clicked_btn.addClass('fa-thumbs-o-down');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);
  		
  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
  	}
  });	

});

});</script>

<?php $content = ob_get_clean()?>
<?php include 'app/views/layout.html.php'?>