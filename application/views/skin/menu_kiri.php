<ul class="nav menu">
	<li><a href="<?php echo site_url('admin/home');?>"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
	<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
	<li class="parent">
		<a href="#">
			<span data-toggle="collapse1" href="#menu1" class="glyphicon glyphicon-th-large"></span> REKAP NO PO
		</a>
		<ul class="children collapse1" id="menu1">
			<li>
				<a class="" href="<?php echo site_url('rekap/add');?>">
					<span class="glyphicon glyphicon-pencil"></span> Create NO PO
				</a>
			</li>
			<li>
				<a class="" href="<?php echo site_url('rekap/');?>">
					<span class="glyphicon glyphicon-list-alt"></span> List PO
				</a>
			</li>
		</ul>
	</li>
	<?php } ?>
	<li class="parent">
		<a href="#">
			<span data-toggle="collapse1" href="#menu1" class="glyphicon glyphicon-th-large"></span> ASSETS 
		</a>
		<ul class="children collapse1" id="menu2">
			<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
			<li>
				<a class="" href="<?php echo site_url('barang/add');?>">
					<span class="glyphicon glyphicon-pencil"></span> Tambah Barang
				</a>
			</li>
			<li>
				<a class="" href="<?php echo site_url('barang/import');?>">
					<span class="glyphicon glyphicon-upload"></span> Import Barang
				</a>
			</li>
			<?php } ?>
			<li>
				<a class="" href="<?php echo site_url('barang/daftar');?>">
					<span class="glyphicon glyphicon-list-alt"></span> List Barang
				</a>
			</li>
			<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
			<li>
				<a class="" href="<?php echo site_url('assigment/barang');?>">
					<span class="glyphicon glyphicon-save"></span> Serah Terima Asset
				</a>
			</li>
			<?php } ?>
		</ul>
	</li>
	<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
	<li class="parent">
		<a href="#">
			<span data-toggle="collapse1" href="#menu1" class="glyphicon glyphicon-th-large"></span> PENGIRIMAN BARANG 
		</a>
		<ul class="children collapse1" id="menu2">
			<li>
				<a class="" href="<?php echo site_url('lapor/pengiriman');?>">
					<span class="glyphicon glyphicon-pencil"></span> Kirim Barang
				</a>
			</li>
			<li>
				<a class="" href="<?php echo site_url('lapor/daftar_pengiriman');?>">
					<span class="glyphicon glyphicon-upload"></span> History Pengiriman
				</a>
			</li>
		</ul>
	</li>
	<?php } ?>
	<li class="parent">
		<a href="#">
			<span data-toggle="collapse1" href="#menu1" class="glyphicon glyphicon-th-large"></span> PEMINJAMAN BARANG 
		</a>
		<ul class="children collapse1" id="menu2">
			<li>
				<a class="" href="<?php echo site_url('lapor/peminjaman/add');?>">
					<span class="glyphicon glyphicon-pencil"></span> Pinjam Barang
				</a>
			</li>
			<li>
				<a class="" href="<?php echo site_url('lapor/peminjaman/daftar/0');?>">
					<span class="glyphicon glyphicon-upload"></span> History Peminjaman
				</a>
			</li>
		</ul>
	</li>
	<li class="parent">
		<a href="<?php echo site_url('lapor/lost_damage');?>">
			<span data-toggle="collapse1" href="#menu1" class="glyphicon glyphicon-th-large"></span> LOST N DAMAGE ASSETS
		</a>
	</li>
<!-- 
	menu serah terima di non aktifkan	
	<li class="parent">
		<a href="#">
			<span data-toggle="collapse1" href="#menu1" class="glyphicon glyphicon-th-large"></span> ASSIGN ASSET
		</a>
		<ul class="children collapse1" id="menu3">
			<li>
				<a class="" href="<?php echo site_url('assigment/barang');?>">
					<span class="glyphicon glyphicon-save"></span> Serah Terima Asset
				</a>
			</li>
			<li>
				<a class="" href="<?php echo site_url('assigment/daftar');?>">
					<span class="glyphicon glyphicon-list-alt"></span> Penarikan Asset
				</a>
			</li>
		</ul>
	</li> -->
	<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
	<li class="parent">
		<a href="#">
			<span data-toggle="collapse1" href="#menu1" class="glyphicon glyphicon-th-large"></span> Administrator
		</a>
		<ul class="children collapse1" id="menu3">
			<li>
				<a class="" href="<?php echo site_url('admin/management/barang');?>">
					<span class="glyphicon glyphicon-list-alt"></span> Manage Jenis Barang
				</a>
			</li>
			<li>
				<a class="" href="<?php echo site_url('admin/management/lokasi');?>">
					<span class="glyphicon glyphicon-list-alt"></span> Manage Lokasi
				</a>
			</li>
			<li>
				<a class="" href="<?php echo site_url('admin/management/department');?>">
					<span class="glyphicon glyphicon-list-alt"></span> Manage Department
				</a>
			</li>
			<?php if($_SESSION["user_role"] == 1){ ?>
			<li>
				<a class="" href="<?php echo site_url('admin/management/akun');?>">
					<span class="glyphicon glyphicon-list-alt"></span> Manage Akun
				</a>
			</li>
			<?php } ?>
			<li>
				<a class="" href="<?php echo site_url('admin/management/home-location');?>">
					<span class="glyphicon glyphicon-list-alt"></span> Manage Home
				</a>
			</li>
		</ul>
	</li>
	<?php } ?>
</ul>