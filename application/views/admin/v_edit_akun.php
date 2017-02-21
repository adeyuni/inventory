<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<?php if($isEditing == true){ ?>
				<a href="<?php echo site_url('admin/management/akun');?>">
					<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-pencil"></span> Tambah Akun
					</button>
				</a>
			<?php } ?>
			<div class="panel-body">
				<div class="col-lg-6">
					<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
						<tr>
							<th>No</th>
							<th>Department</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>

					<?php
						$i = 1;
						foreach($listUser->result() as $row){
							echo "<tr>";
							echo "<td>".$i++."</td>";
							echo "<td>".$row->user_username."</td>";
							$link_edit = site_url('admin/management/akun/edit/'.$row->user_id);
							$link_delete = site_url('admin/delete/akun/'.$row->user_id);
							$link_reset = site_url('admin/reset/'.$row->user_id);
						?>
								<td>
									<a href="<?php echo $link_edit;?>">
			    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
											<span class="glyphicon glyphicon-pencil"></span> Edit
										</button>
									</a>
									<a href="<?php echo $link_reset;?>">
			    						<button type="button" class="btn btn-sm btn-info">
											<span class="glyphicon glyphicon-gear"></span> Reset Password
										</button>
									</a>
									<a href="<?php echo $link_delete;?>">
			    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
											<span class="glyphicon glyphicon-trash"></span> Delete
										</button>
									</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6">
					<h4>Edit Akun</h4><br />
					<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
						<div class="form-group">
							<label for="no_po" class="col-sm-3 control-label">Username</label>
							<?php if($isEditing == true) {?>
							<input type="hidden" value="<?php echo $user_username;?>" name="username">
							<?php } ?>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="user_username" name="user_username" placeholder="Username" value="<?php if(isset($user_username)){echo $user_username;}?>" required>
							</div>
						</div>
						<div class="form-group">
							<label for="user_role" class="col-sm-3 control-label">Pilih Role </label>
							<div class="col-sm-7">
								<select name="user_role" id="user_role" class="form-control">
									<option value="">-- Pilih --</option>
									<?php foreach($listRole->result() as $row){?>
									<option value="<?php echo $row->user_role_id; ?>" <?php if($role == $row->user_role_id){echo "selected";} ?> > <?php echo $row->user_role_nama; ?></option>
									<?php }?>
								</select>
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
