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
               
                
				<h3>Lorem ipsum</h3>
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


    <div class="column">
    <div class="row">
            <?php foreach ($data['coments'] as $table) : ?>
                <div class="row">
              <div class="col-md-3 col-sm-6 highlight">
		    			  <div class="h-body text-center">
                            <p>Nombre Usuario: <?php echo $table->user->userName ?></p>
		    			  	<p>Contenido comentario: <?php echo $table->contenido ?></p>
		    			  </div>
              </div>
              </div>
            <?php endforeach; ?>
      </div>
      </div>
<?php $content = ob_get_clean()?>
<?php include 'app/views/layout.html.php'?>