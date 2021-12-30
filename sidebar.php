
<?php include("../connect.php"); ?>
<?php include_once("../auth/auth.php"); ?>
<?php
$uname=$_SESSION['USER_ID'];
$result1 = $db->prepare("SELECT * FROM user WHERE id=:userid ");
$result1->bindParam(':userid', $uname);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
$upic1=$row1['u_pic'];
}

?>
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-image: url('img/ez2.gif');background-repeat: no-repeat;   background-attachment: fixed; background-size: 800px; ">
      
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="CLOUD ARM" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CLOUD ARM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="user_pic/<?php  echo $upic1;?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <h5><?php echo $_SESSION["name"];?> - <?php   echo $_SESSION['POSITION'];?></h5> </a>
          <form action="../auth/logout.php" method="post" accept-charset="utf-8">
          <input type="hidden" name="action" value="logOut" />
          <button type="submit" class="btn btn-block btn-outline-primary">Log out</button>
        </form>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>





          <li class="nav-header">EXAMPLES</li>

          <li class="nav-item">
            <a href="product.php" class="nav-link">
            <i class="nav-icon fas fa-barcode"></i>
             
              <p>
                PRODUTS
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="order.php" class="nav-link">
            <i class="nav-icon fas fa-clipboard"></i>
              <p>
                PRODUT ORDER
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
