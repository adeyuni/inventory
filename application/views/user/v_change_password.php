<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<div class="col-lg-6">
					<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
						<div class="form-group">
							<label for="no_po" class="col-sm-3 control-label">Username</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php if(isset($username)){echo $username;}?>" readonly required>
							</div>
						</div>
						<div class="form-group">
							<label for="no_po" class="col-sm-3 control-label">Password</label>
							<div class="col-sm-7">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
							</div>
						</div>
						<div class="form-group">
							<label for="no_po" class="col-sm-3 control-label">Re-Password</label>
							<div class="col-sm-7">
								<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-Password" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-4">
						  		<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
