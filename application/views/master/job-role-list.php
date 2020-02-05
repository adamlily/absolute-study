<!-- page content -->
<div class="right_col" role="main">
	<div class="row">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Job Roles </h2>
					<a href="javascript:void(0)" class="btn btn-success pull-right" data-toggle="modal" data-target="#addJobRoleModal" title="Add Job Role">Add Job Role</a>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action" id="jobRoleTable">
							<thead>
								<tr class="headings">
									<th>#</th>
									<th class="column-title">Sector Name </th>
									<th class="column-title">Job Role </th>
									<th class="column-title">Status </th>
									<th class="column-title">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								if ($jobRoleList) {
									foreach ($jobRoleList as $jobRole) { ?>
										<tr class="even pointer">
											<td class="a-center "><?php echo $i; ?></td>
											<td class=" "><?php echo $jobRole['sector_name']; ?></td>
											<td class=" "><?php echo $jobRole['job_role_name']; ?></td>
											<td class=" "><?php echo $jobRole['is_active']?"Active":"Inactive"; ?></td>
											<td class=" "></td>
										</tr>
										<?php $i++; } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Add Subject Modal : START -->
		<div class="modal fade" id="addJobRoleModal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Add New Job Role</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url(); ?>admin/add-job-role" method="POST" role="form" id="addJobRoleForm">
							<span class="label label-danger" id="duplicate_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Sector Name :</label>
									<select class="form-control select2" name="sector_name" id="sector_name" style="width: 100%;">
										<option value="">Select Sector</option>
										<?php foreach ($sectorList as $sector): ?>
											<option value="<?php echo $sector['id']."-".$sector['sector_name']; ?>"><?php echo $sector['sector_name']; ?></option>
										<?php endforeach ?>
									</select>
									<span class="label label-danger" id="sector_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Job Role Name :</label>
									<input type="text" class="form-control" name="job_role_name" id="job_role_name" placeholder="Job Role Name">
									<span class="label label-danger" id="job_role_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="submit" class="btn btn-primary pull-right" name="submitJobRoleForm" id="addJobRole" value="Submit">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- Add JobRole Modal : END -->
		<script>
			$(document).ready(function() {
				$("#jobRoleTable").DataTable();
				$(".select2").select2();
				$("#job_role_name").click(function(event) {
					event.preventDefault();
					$("#job_role_name_error").css('display', 'none');
				});
				$("#sector_name").change(function(event) {
					event.preventDefault();
					$("#sector_name_error").css('display', 'none');
				});
				$("#addJobRole").click(function(event) {
					event.preventDefault();
					var sector 	= $("#sector_name").val();
					var job_role = $("#job_role_name").val();
					if (sector === "") {
						$("#sector_name_error").text('Select sector name');
						$("#sector_name_error").css('display', 'block');
					} else if (job_role === "") {
						$("#job_role_name_error").text('Enter subject name');
						$("#job_role_name_error").css('display', 'block');
					} else {
						$(".loading-bg").show();
						$.ajax({
							url: $("#addJobRoleForm").attr('action'),
							type: 'POST',
							data: $("#addJobRoleForm").serialize(),
							success:function(data){
								var data = JSON.parse(data);
								console.log(data);
								$(".loading-bg").hide();
								if (data.flag) {
									window.location.reload();
								} else {
									$("#"+data.input+"_name_error").text(data.message);
									$("#"+data.input+"_name_error").css('display', 'block');
									return false;
								}
							}
						});
					}
				});
			});
		</script>