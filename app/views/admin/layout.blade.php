@extends('main')

@section('styles')
  
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
	{{ HTML::style('/assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/uniform/css/uniform.default.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
	<!-- END GLOBAL MANDATORY STYLES -->
    
	<!-- BEGIN PAGE LEVEL STYLES -->
	{{ HTML::style('/assets/metronic/assets/global/plugins/select2/select2.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}
	<!-- END PAGE LEVEL STYLES -->
	
	<!-- BEGIN THEME STYLES -->
	{{ HTML::style('/assets/metronic/assets/global/css/components.css') }}
	{{ HTML::style('/assets/metronic/assets/global/css/plugins.css') }}
	{{ HTML::style('/assets/metronic/assets/admin/layout/css/layout.css') }}
	{{ HTML::style('/assets/metronic/assets/admin/layout/css/themes/blue.css') }}
	{{ HTML::style('/assets/metronic/assets/admin/layout/css/custom.css') }}
	<!-- END THEME STYLES -->
	
    {{ HTML::style('/assets/css/style_admin.css') }}
    
    @yield('custom_styles')
@stop

@section('header')
    <header class="header">        
		<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner">
				<!-- BEGIN LOGO -->
				<div class="page-logo" style="padding-top: 10px;">
					<a href="{{ URL::route('admin.dashboard') }}">
					    <span class="admin-logo-title">SoundsGood</span>
					</a>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
				</a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
				    <?php if (Session::has('admin_id')) {?>
		    			<ul class="nav navbar-nav pull-right">
		    				<li class="dropdown dropdown-quick-sidebar-toggler">
		    					<a href="{{ URL::route('admin.auth.signout') }}" class="dropdown-toggle">
		    					    <i class="icon-logout"></i> Logout
		    					</a>
		    				</li>
		    			</ul>
					<?php }?>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END HEADER INNER -->
		</div>
		
		<div class="clearfix"></div>

    </header>
@stop

@section('body')
    <div class="page-container">
    
        <?php if (!isset($pageNo)) { $pageNo = 0; } ?> 	
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
					<li class="sidebar-toggler-wrapper">
						<div class="sidebar-toggler"></div>
					</li>
	
					<li class="start <?php echo ($pageNo == 0) ? "active" : "";?>">
						<a href="{{ URL::route('admin.dashboard') }}">
						    <i class="icon-bar-chart"></i>
						    <span class="title">Dashboard</span>
						</a>
					</li>
					
					<!-- 
					<li class="<?php echo ($pageNo == 21) ? "active" : "";?>">
						<a href="">
						    <i class="icon-users"></i>
						    <span class="title">User Management</span>
						</a>
					</li>
					 -->
					<li class="<?php echo ($pageNo == 6) ? "active" : "";?>" style = "display:none;">
						<a href="{{ URL::route('admin.category') }}">
						    <i class="fa fa-tag"></i>
						    <span class="title">Category Management</span>
						</a>
					</li>
                    <li class="<?php echo ($pageNo == 12) ? "active" : "";?>">
                        <a href="{{ URL::route('admin.product') }}">
                            <i class="fa fa-tag"></i>
                            <span class="title">Product Management</span>
                        </a>
                    </li>
					<li class="<?php echo ($pageNo == 1) ? "active" : "";?>" style = "display:none;">
						<a href="{{ URL::route('admin.customer') }}">
						    <i class="fa fa-globe"></i>
						    <span class="title">Customer Management</span>
						</a>
					</li>
					
					<li class="<?php echo ($pageNo == 2) ? "active" : "";?>">
						<a href="{{ URL::route('admin.user') }}">
						    <i class="fa fa-map-marker"></i>
						    <span class="title">User Account</span>
						</a>
					</li>
					
					<li class="<?php echo ($pageNo == 3) ? "active" : "";?>" style = "display:none;">
						<a href="{{ URL::route('admin.post') }}">
						    <i class="fa fa-glass"></i>
						    <span class="title">Post Management</span>
						</a>
					</li>
                    
                    <li class="<?php echo ($pageNo == 4) ? "active" : "";?>">
                        <a href="{{ URL::route('admin.recipe') }}">
                            <i class="fa fa-glass"></i>
                            <span class="title">Recipe Management</span>
                        </a>
                    </li>
                     <li class="<?php echo ($pageNo == 7) ? "active" : "";?>">
                        <a href="{{ URL::route('admin.store') }}">
                            <i class="fa fa-glass"></i>
                            <span class="title">Store Management</span>
                        </a>
                    </li>
                    <li class="<?php echo ($pageNo == 8) ? "active" : "";?>">
                        <a href="{{ URL::route('admin.apply') }}">
                            <i class="fa fa-glass"></i>
                            <span class="title">Store Applicant Management</span>
                        </a>
                    </li>
                    <li class="<?php echo ($pageNo == 9) ? "active" : "";?>" style = "display:none;">
                        <a href="{{ URL::route('admin.recipeApply') }}">
                            <i class="fa fa-glass"></i>
                            <span class="title">Recipe View</span>
                        </a>
                    </li>
                    <li class="<?php echo ($pageNo == 10) ? "active" : "";?>">
                        <a href="{{ URL::route('admin.recipt') }}">
                            <i class="fa fa-glass"></i>
                            <span class="title">Receipt Management</span>
                        </a>
                    </li>
               </ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
        <div class="page-content-wrapper">
        	<div class="page-content" style="min-height: 554px;">
	            <div class="pull-right top-buttons">
	                @yield('top-buttons')
	            </div>
	            <div class="clearfix"></div>
	            
	            @yield('content')       	
        	</div>
        </div>
    </div>
@stop

@section('footer')
	<div class="page-footer">
		<div class="page-footer-inner">
			 &copy; Copyright 2015 | All Rights Reserved | Powered by Finternet-Group
		</div>
		<div class="page-footer-tools">
			<span class="go-top">
			<i class="fa fa-angle-up"></i>
			</span>
		</div>
	</div>
@stop

@section('scripts')
    {{ HTML::script('/assets/js/alert.js') }}
     
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	{{ HTML::script('/assets/metronic/assets/global/plugins/respond.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/excanvas.min.js') }} 
	<![endif]-->
	{{ HTML::script('/assets/metronic/assets/global/plugins/jquery-1.11.0.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/jquery-migrate-1.2.1.min.js') }}
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	{{ HTML::script('/assets/metronic/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/jquery.blockui.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/jquery.cokie.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/uniform/jquery.uniform.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
	<!-- END CORE PLUGINS -->
	
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script('/assets/metronic/assets/global/plugins/select2/select2.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}
	{{ HTML::script('/assets/metronic/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	{{ HTML::script('/assets/metronic/assets/global/scripts/metronic.js') }}
	{{ HTML::script('/assets/metronic/assets/admin/layout/scripts/layout.js') }}
	{{ HTML::script('/assets/metronic/assets/admin/layout/scripts/quick-sidebar.js') }}
	{{ HTML::script('/assets/metronic/assets/admin/pages/scripts/table-managed.js') }}
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
	jQuery(document).ready(function() {       
	    Metronic.init(); // init metronic core components
	    Layout.init(); // init current layout
	    QuickSidebar.init() // init quick sidebar
	});
	</script>    

	@yield('custom_scripts')
@stop

@stop