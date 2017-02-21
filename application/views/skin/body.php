<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo site_url('admin/home');?>"><span>Assets</span> &nbsp Management</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $_SESSION["username"];?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo site_url('user/change_password');?>"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Ganti Password</a></li>
							<li><a href="<?php echo site_url('user/logout');?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<h4>WELCOME, <?php echo $_SESSION["username"];?></h4>
			</div>
		</form>
		<?php include "menu_kiri.php";?>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg> Home</a></li>
				<li class="active"><?php echo $title;?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<br />
			<?php if(isset($isHome)){

			}else{ ?>
			<div class="col-xs-12 col-md-6 col-lg-7"> <!-- untuk mengatur width -->
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-1 widget-left">
							<!-- <svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> -->
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?php echo $title;?></div>
							<!-- <div class="text-muted">New Orders</div> -->
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div><!--/.row-->
			
