<h4>Jumlah Barang </h4>
<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-blue panel-widget ">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked desktop computer and mobile"><use xlink:href="#stroked-desktop-computer-and-mobile"></use></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlPCAwal;?></div>
					<div class="text-muted">PC</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-orange panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlLaptopAwal;?></div>
					<div class="text-muted">Laptop</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-teal panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"/></svg><use xlink:href="#stroked-dashboard-dial"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlImacAwal;?></div>
					<div class="text-muted">IMAC</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-red panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlSmartphoneAwal;?></div>
					<div class="text-muted">Smartphone</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->

<h4>Jumlah Barang yang beredar</h4>
<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-blue panel-widget ">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked desktop computer and mobile"><use xlink:href="#stroked-desktop-computer-and-mobile"></use></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlPC;?></div>
					<div class="text-muted">PC</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-orange panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlLaptop;?></div>
					<div class="text-muted">Laptop</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-teal panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"/></svg><use xlink:href="#stroked-dashboard-dial"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlImac;?></div>
					<div class="text-muted">IMAC</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-red panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large"><?php echo $jmlSmartphone;?></div>
					<div class="text-muted">Smartphone</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>Detail Barang</h4>
				<table class="table">
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Stock Awal</th>
						<th>Jumlah Beredar</th>
						<th>Sisa</th>
					</tr>
					<?php
					$i=1;$j=0;
						foreach($nama_barang as $nama){
							
							
							echo "<tr>";
							echo "<td>".$i++."</td>";
							echo "<td>".$nama."</td>";
							$jA = $jmlAwal[$j];
							echo "<td>".$jA."</td>";
							$jB = $jmlBeredar[$j++];
							echo "<td>".$jB."</td>";
							echo "<td>".$sum = $jA - $jB."</td>";
							echo "</tr>";
						}                                                                                               
					?>
				</table>
			</div>
		</div>
	</div>