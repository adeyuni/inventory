		</div><!--/.row-->
		
		
	</div>	<!--/.main-->

	<script src="<?php echo site_url();?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo site_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo site_url();?>assets/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo site_url();?>assets/js/bootstrap-select.js"></script>
	<script src="<?php echo site_url();?>assets/js/select2.js"></script>
	<script src="<?php echo site_url();?>assets/js/bootstrap-table.js"></script>

	
	<?php 
	if(isset($additional)){
		include $additional;
	}?>
</body>

</html>
