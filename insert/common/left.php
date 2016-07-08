<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image" style = "visibility:hidden;">
              <img src="<?php if($data[0]['profileImage'] != '' && file_exists($data[0]['profileImage'])){echo $data[0]['profileImage'];}else{echo '/images/profile/no_photo.png';}?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $data[0]['firstResidentName'] . " " . $data[0]['lastResidentName'] ; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <ul class="sidebar-menu">
            <li class="header">PATIENT LOGS</li>
            <li class="treeview">
              <a href="/patient">
                <i class="fa fa-dashboard"></i> <span>Add Encounter</span>
              </a>
            </li>
            <li class="treeview">
              <a href="/viewPatient">
                <i class="fa fa-files-o"></i> <span>Table View</span>
              </a>
            </li>
            <li class="treeview" style = "display:none;">
              <a href="/rotation">
                <i class="fa fa-th"></i> <span>View Rotation</span>
              </a>
            </li>
            <li class="treeview">
              <a href="/report">
                <i class="fa fa-pie-chart"></i> <span>Reports</span>
              </a>
            </li>
            <li class="treeview">
              <a href="/setResident">
                <i class="fa fa-laptop"></i> <span>Settings</span>
            </a>
            </li>
            <li class="treeview" style = "display:none;">
              <a href="/contactUs">
                <i class="fa fa-edit"></i> <span>Contact Us</span>
              </a>
            </li>
            <li class="treeview" style = "display:none;">
              <a href="/message">
                <i class="fa fa-table"></i> <span>Message</span>
              </a>
            </li>
            <li class="treeview">
              <a onclick="onLogOut()" style ="cursor:pointer;">
                <i class="fa fa-circle-o"></i> <span>Log Out</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>