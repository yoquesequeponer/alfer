<?php ob_start();?>
<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="<?= ROOT_PATH ?>">
            <h1>ALFER</h1>
          </a>
          <a class="navbar-brand brand-logo-mini" href="<?= ROOT_PATH ?>">
                        <h6>ALFER</h6>

          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
       <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?php echo $_SESSION['user_data']['name']; ?></span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
        <?php if($_SESSION['user_data']['rol']!=0) : ?>
          <li class="nav-item dropdown d-none d-lg-block">
            <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">Selecciona vista</a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
              <a class="dropdown-item py-3" href="#">
                <p class="mb-0 font-weight-medium float-left">Vistas disponibles</p>
              </a>
              <?php if($_SESSION['user_data']['rol']==2) : ?>
                            <a class="dropdown-item preview-item" href="<?= ROOT_PATH ?>admin/admin">
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Vista Administrador</p>
                </div>
              </a>
              <?php endif?>
               <?php if($_SESSION['user_data']['rol']>=1) : ?>


                            <a class="dropdown-item preview-item"  href="<?= ROOT_PATH ?>escritor/escritor">
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Vista Escritor</p>
                </div>
              </a>
              <?php endif?>


              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="<?= ROOT_PATH ?>users/user">
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Vista Usuario</p>
                </div>
              </a>
            </div>
          </li>
        <?php endif?>

          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="data:img/jpg;base64,<?php echo base64_encode($data['usuario']->files->filedata); ?>" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="data:img/jpg;base64,<?php echo base64_encode($data['usuario']->files->filedata); ?>" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['user_data']['name']; ?></p>
                <p class="fw-light text-muted mb-0"><?php echo $_SESSION['user_data']['correo']; ?></p>
              </div>
              <a class="dropdown-item" href="<?= ROOT_PATH ?>users/logout"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="<?php echo ROOT_PATH?>public/template/images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?php echo ROOT_PATH?>public/template/images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?php echo ROOT_PATH?>public/template/images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?php echo ROOT_PATH?>public/template/images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?php echo ROOT_PATH?>public/template/images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?php echo ROOT_PATH?>public/template/images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">


      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    
                      <div class="row">

                      <div class="col-lg-8 d-flex flex-column">

<!-- inicio usuarios -->
                        <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Usuarios</h4>
                                  </div>
                                  <!-- <div>
                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
                                  </div> -->
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>ID</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data['users'] as $user) : ?>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="<?php echo ROOT_PATH?>public/template/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6><?php echo $user->userName?></h6>
                                              <p><?php echo $user->rol?></p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6><?php echo $user->correo?></h6>
                                        </td>
                                        <td>
                                          <p><?php echo $user->id?></p>
                                        </td>
                                        <td>
                                          <a type="button" class="btn btn-sm btn-info btn-icon-text" href="<?=ROOT_PATH?>admin/rol/<?php echo $user->id?>">
                                          Edit rol
                                          <i class="ti-file btn-icon-append"></i>                          
                                          </a>
                                        </td>
                                      </tr>
                                      <?php endforeach ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<!-- fin usuarios -->

<!-- inicio categorias -->
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Categorias</h4>
                                   <p class="card-subtitle card-subtitle-dash">Hay X Categorias</p>
                                  </div>
                                  <div>
                                    <a class="btn btn-primary btn-lg text-white mb-0 me-0" type="button" href="<?=ROOT_PATH?>admin/addCategory/"><i class="mdi mdi-account-plus"></i>Añadir nueva categoria</a>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Descripcion</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($data['categorias'] as $category) : ?>
                                        <tr>
                                          <td>
                                            <div class="form-check form-check-flat mt-0">
                                              <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                            </div>
                                          </td>
                                          <td>
                                            <div class="d-flex ">
                                              <div>
                                                <p><?php echo $category->id?></p>
                                              </div>
                                            </div>
                                          </td>
                                          <td>
                                            <h6><?php echo $category->descripcion?></h6>
                                          </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<!-- fin categorias -->



<!-- inicio Post -->
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Posts</h4>
                                   <p class="card-subtitle card-subtitle-dash">Hay X Categorias</p>
                                  </div>
                                  <div>
                                    <a class="btn btn-primary btn-lg text-white mb-0 me-0" type="button" href="<?=ROOT_PATH?>posts/add/"><i class="mdi mdi-account-plus"></i>Crear Post</a>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Titulo</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($data['posts'] as $post) : ?>
                                        <tr>
                                          <td>
                                            <div class="form-check form-check-flat mt-0">
                                              <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                            </div>
                                          </td>
                                          <td>
                                            <div class="d-flex ">
                                              <div>
                                                <p><?php echo $post->id?></p>
                                              </div>
                                            </div>
                                          </td>
                                          <td>
                                            <h6><?php echo $post->titulo?></h6>
                                          </td>
                                          <td>
                                            <a type="button" class="btn btn-danger btn-icon-text" href="<?=ROOT_PATH?>posts/delete/<?php echo $post->id?>">
                                              Delete Post
                                              <i class="ti-alert btn-icon-prepend"></i>                           
                                            </a>
                                          </td>
                                          <td>
                                          <a type="button" class="btn btn-sm btn-info btn-icon-text" href="<?=ROOT_PATH?>posts/edit/<?php echo $post->id?>">
                                          Edit Post
                                          <i class="ti-file btn-icon-append"></i>                          
                                          </a>
                                        </td>

                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<!-- fin Posts -->


<!-- inicio coment -->
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Comentarios</h4>
                                   <p class="card-subtitle card-subtitle-dash">Hay X Categorias</p>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th>ID Comentario</th>
                                        <th>ID Post</th>
                                        <th>ID Usuario</th>
                                        <th>Contenido</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($data['coments'] as $coment) : ?>
                                        <tr>
                                          <td>
                                            <div class="form-check form-check-flat mt-0">
                                              <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                            </div>
                                          </td>
                                          <td>
                                            <div class="d-flex ">
                                              <div>
                                                <p><?php echo $coment->id?></p>
                                              </div>
                                            </div>
                                          </td>
                                          <td>
                                            <h6><?php echo $coment->post_id?></h6>
                                          </td>
                                          <td>
                                            <h6><?php echo $coment->user_id?></h6>
                                          </td>
                                          <td>
                                            <h6><?php echo $coment->contenido?></h6>
                                          </td>
                                          <td>
                                            <a type="button" class="btn btn-danger btn-icon-text" href="<?=ROOT_PATH?>coments/delete/<?php echo $coment->id?>">
                                              Delete Coment
                                              <i class="ti-alert btn-icon-prepend"></i>                           
                                            </a>
                                          </td>
                                          <td>
                                          <a type="button" class="btn btn-sm btn-info btn-icon-text" href="<?=ROOT_PATH?>coments/edit/<?php echo $coment->id?>">
                                          Edit Post
                                          <i class="ti-file btn-icon-append"></i>                          
                                          </a>
                                        </td>

                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<!-- fin coment -->




                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

<?php $content = ob_get_clean()?>
<?php include 'app/views/adminlayout.html.php'?>

