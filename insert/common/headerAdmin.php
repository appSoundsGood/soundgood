<header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Patient</b>LOGS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Patient</b>LOGS</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
				
      			  <li style="cursor:pointer;">
      				<a class="btn btn-block btn-success" data-toggle="modal" data-target="#myModalHorizontal">
      					Support
      				</a>
      			  </li>
              <li class="dropdown user user-menu">
			          
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                  <img style = "visibility:hidden;" src="<?php if($data[0]['profileImage'] != '' && file_exists($data[0]['profileImage'])){echo $data[0]['profileImage'];}else{echo '/images/profile/no_photo.png';}?>" class="user-image" alt="">
                  <span class="hidden-xs"><?php echo $data[0]['firstResidentName'] . " " . $data[0]['lastResidentName'] ; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img style = "visibility:hidden;" src="<?php echo $data[0]['profileImage'];?>"  style = "visibility:hidden;" class="img-circle" alt="">
                    <p>
                      <?php echo $data[0]['firstResidentName'] . " " . $data[0]['lastResidentName'] ; ?>
                      <small></small>
                    </p>
                  </li>
                 </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>