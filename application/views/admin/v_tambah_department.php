<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<?php if($isEditing == true){ ?>
				<a href="<?php echo site_url('admin/management/department');?>">
					<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-pencil"></span> Tambah Department
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
						foreach($listDepartment->result() as $row){
							echo "<tr>";
							echo "<td>".$i++."</td>";
							echo "<td>".$row->department_nama."</td>";
							$link_edit = site_url('admin/management/department/edit/'.$row->department_id);
							$link_delete = site_url('admin/delete/department/'.$row->department_id);
						?>
								<td>
									<a href="<?php echo $link_edit;?>">
			    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
											<span class="glyphicon glyphicon-pencil"></span> Edit
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
					<h4>Tambah Department</h4><br />
					<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
						<div class="form-group">
							<label for="no_po" class="col-sm-3 control-label">Department</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="department_nama" name="department_nama" placeholder="Department" value="<?php if(isset($department_nama)){echo $department_nama;}?>" required>
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
