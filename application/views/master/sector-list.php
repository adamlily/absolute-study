<!-- page content -->
<div class="right_col" role="main">
	<div class="row">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Sectors </h2>
					<a href="javascript:void(0)" class="btn btn-success pull-right" data-toggle="modal" data-target="#addSectorModal" title="Add Sector">Add Sector</a>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action" id="sectorTable">
							<thead>
								<tr class="headings">
									<th>#</th>
									<th class="column-title">Sector Name </th>
									<th class="column-title">Status </th>
									<th class="column-title">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								if ($sectorList) {
									foreach ($sectorList as $sector) { ?>
										<tr class="even pointer">
											<td class="a-center "><?php echo $i; ?></td>
											<td class=" "><?php echo $sector['sector_name']; ?></td>
											<td class=" "><?php echo ($sector['is_expired']?"Expired":($sector['is_active']?"Active":"Inactive")); ?></td>
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
		<!-- Add Sector Modal : START -->
		<div class="modal fade" id="addSectorModal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Add New Sector</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url(); ?>admin/add-sector" method="POST" role="form" id="addSectorForm">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Sector Name :</label>
									<input type="text" class="form-control" name="sector_name" id="sector_name" placeholder="Sector Name">
									<span class="label label-danger" id="sector_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="submit" class="btn btn-primary pull-right" name="submitCourseForm" id="addSector" value="Submit">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- Add Course Modal : END -->
		<script>
			$(document).ready(function() {
				$("#sectoreTable").DataTable();
				$("#sector_name").click(function(event) {
					event.preventDefault();
					$("#sector_name_error").css('display', 'none');
				});
				$("#addSector").click(function(event) {
					event.preventDefault();
					var course = $("#sector_name").val();
					if (course === "") {
						$("#sector_name_error").text('Enter Sector name');
						$("#sector_name_error").css('display', 'block');
					} else {
						$(".loading-bg").show();
						$.ajax({
							url: $("#addSectorForm").attr('action'),
							type: 'POST',
							data: $("#addSectorForm").serialize(),
							success:function(data){
								var data = JSON.parse(data);
								console.log(data);
								$(".loading-bg").hide();
								if (data.flag) {
									window.location.reload();
								} else {
									$("#sector_name_error").text(data.message);
									$("#sector_name_error").css('display', 'block');
									return false;
								}
							}
						});
						
					}
				});
			});
		</script>