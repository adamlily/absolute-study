<!-- page content -->
<div class="right_col" role="main">
	<div class="row">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Sections </h2>
					<a href="javascript:void(0)" class="btn btn-success pull-right" data-toggle="modal" data-target="#addSectionModal" title="Add Section">Add Section</a>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action" id="sectionTable">
							<thead>
								<tr class="headings">
									<th>#</th>
									<th class="column-title">Course Name </th>
									<th class="column-title">Subject Name </th>
									<th class="column-title">Topic Name </th>
									<th class="column-title">Status </th>
									<th class="column-title">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								if ($sectionList) {
									foreach ($sectionList as $section) { ?>
										<tr class="even pointer">
											<td class="a-center "><?php echo $i; ?></td>
											<td class=" "><?php echo $section['sector_name']; ?></td>
											<td class=" "><?php echo $section['job_role_name']; ?></td>
											<td class=" "><?php echo $section['section_name']; ?></td>
											<td class=" "><?php echo $section['is_active']?"Active":"Inactive"; ?></td>
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
		<!-- Add Section Modal : START -->
		<div class="modal fade" id="addSectionModal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Add New Section</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url(); ?>admin/add-section" method="POST" role="form" id="addSectionForm">
							<span class="label label-danger" id="duplicate_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Sectore Name :</label>
									<select class="form-control select2" name="sector_name" id="sector_name" style="width: 100%;">
										<option value="">Select Sectore</option>
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
									<select class="form-control select2" name="job_role_name" id="job_role_name" style="width: 100%;">
										<option value="">Select Job Role</option>
										
									</select>
									<span class="label label-danger" id="job_role_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Section Name :</label>
									<input type="text" class="form-control" name="section_name" id="section_name" placeholder="Section Name">
									<span class="label label-danger" id="section_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="submit" class="btn btn-primary pull-right" name="submitTopicForm" id="addSection" value="Submit">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- Add Section Modal : END -->
		<script>
			$(document).ready(function() {
				$("#sectioncTable").DataTable();
				$(".select2").select2();
				$("#section_name").click(function(event) {
					event.preventDefault();
					$("#section_name_error").css('display', 'none');
				});
				$("#sector_name").change(function(event) {
					event.preventDefault();
					$("#sector_name_error").css('display', 'none');
				});
				$("#job_role_name").change(function(event) {
					event.preventDefault();
					$("#job_role_name_error").css('display', 'none');
				});
				$("#sector_name").change(function(event) {
					event.preventDefault();
					var sector 	= $("#sector_name").val();
					if (sector === "") {
						$("#job_role_name").empty();
						$("#sector_name_error").text('Select sector name');
						$("#sector_name_error").css('display', 'block');
					} else {
						$(".loading-bg").show();
						$.ajax({
							url: '<?php echo base_url(); ?>get-job-role-list-by-sector',
							type: 'POST',
							data: {sector_id: sector},
							success:function(data){
								var data = JSON.parse(data);
								console.log(data);
								$(".loading-bg").hide();
								if (data.flag) {
									$("#job_role_name").empty();
									$("#job_role_name").append(data.jobRoleOptions);
								} else {
								}
							}
						});
					}
				});
				$("#addSection").click(function(event) {
					event.preventDefault();
					var sector 	= $("#sector_name").val();
					var job_role = $("#job_role_name").val();
					var section 	= $("#section_name").val();
					if (sector === "") {
						$("#sector_name_error").text('Select Sector name');
						$("#sector_name_error").css('display', 'block');
					} else if (job_role === "") {
						$("#job_role_name_error").text('Select Job Role name');
						$("#job_role_name_error").css('display', 'block');
					} else if (section === "") {
						$("#section_name_error").text('Enter Section name');
						$("#section_name_error").css('display', 'block');
					} else {
						$(".loading-bg").show();
						$.ajax({
							url: $("#addSectionForm").attr('action'),
							type: 'POST',
							data: $("#addSectionForm").serialize(),
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