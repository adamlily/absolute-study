<!-- page content -->
<div class="right_col" role="main">
	<div class="row">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Class</h2>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<select name="board_name" class="form-control pull-right" id="board_name" onchange="getDataBoardWise(this.value)"> 
							<option value="">All</option>
							<?php
							if ($BoardList) {
								foreach ($BoardList as $board) { ?>
									<option value="<?php echo $board['id']?>" <?php echo isset($board_id) && $board_id == $board['id'] ? "selected":"";?>><?php echo $board['board']?></option>
								<?php }
							}
							?>
						</select>

					</div>
					<a href="javascript:void(0)" class="btn btn-success pull-right" data-toggle="modal" data-target="#addboardModal" title="Add board">Add Class</a>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row">
						
					</div>
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action" id="boardTable">
							<thead>
								<tr class="headings">
									<th>#</th>
									<th class="column-title">Class</th>
									<th class="column-title">Status </th>
									<th class="column-title">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								if ($classList) {
									// echo '<pre>';print_r($BoardList);exit;
									foreach ($classList as $class) { ?>
										<tr class="even pointer"class>
											<td class="a-center "><?php echo $i; ?></td>
											<td class=" "><?php echo $class['class']; ?></td>
											<td class=" "><?php echo $class['status']==1?"Active":"Expired"; ?></td>
											<td class=" ">
												<a href="javascript:void(0)"><i class="fa fa-pencil" data-toggle="modal" data-target="#editboardModal" title="Edit Class" onclick="editClass('<?php echo  $class['id']?>','<?php echo $class['class']?>','<?php echo $class['board_id']?>')"></i></a>
												<a href="javascript:void(0)" onclick="deleteClass('<?php echo  $class['id']."-".$class['class']?>')"><i class="fa fa-trash-o"></i></a>
											</td>
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
		<!-- Add board Modal : START -->
		<div class="modal fade" id="addboardModal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Add Class</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url(); ?>admin/add-classlist" method="POST" role="form" id="addboardForm">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Board Name :</label>
									<select name="board_name" class="form-control" id="board_name"> 
										<option>Select Board</option>
										<?php
										if ($BoardList) {
									// echo '<pre>';print_r($BoardList);exit;
											foreach ($BoardList as $board) { ?>

												<option value="<?php echo $board['id']?>"><?php echo $board['board']?></option>

											<?php }
										}
										?>
									</select>
									<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Class Name :</label>
									<input type="text" class="form-control" name="class_name" id="class_name" placeholder="Class Name">
									<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="submit" class="btn btn-primary pull-right" name="submitCourseForm" id="addBoard" value="Submit">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="editboardModal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Edit Class</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url(); ?>admin/add-classlist"  role="form" id="addboardForm">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="hidden" name="board_name" id="edit_board_id">
									<input type="hidden" name="class_id" id="edit_class_id">
									<label for="">Class Name :</label>
									<input type="text" class="form-control" name="class_name" id="edit_class_name" placeholder="Class Name">
									<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<a href="#" class="btn btn-primary pull-right" name="submitCourseForm" id="addBoard" onclick="addClass()">Submit</a>
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
				$("#boardeTable").DataTable();
				$("#class_name").click(function(event) {
					event.preventDefault();
					$("#class_name_error").css('display', 'none');
				});



			});
			function addClass(){
				var class_name,board_id,class_id;
				if($("#edit_class_name").val() != "" || $("#edit_board_id").val() !=""){
					class_name = $("#edit_class_name").val();
					board_id = $("#edit_board_id").val();
					class_id = $("#edit_class_id").val();
				}else{
					class_name = $("#class_name").val();
					board_id = $("#board_id").val();
				}
				if (class_name == "") {
					swal('Error', "Enter Class Name",'error');
				} else {
					$(".loading-bg").show();
					$.ajax({
						url: $("#addboardForm").attr('action'),
						type: 'POST',
						data: {class_name:class_name,board_name:board_id,class_id:class_id},
						success:function(data){
							var data = JSON.parse(data);
							console.log(data);
							$(".loading-bg").hide();
							if (data.flag) {
								swal('Success', data.message,'success').then(function(){
									location.reload();
								});
							} else {
								swal( 'Error', data.message,'error').then(function(){
									location.reload();
								});
							}
						}
					});

				}
			}

			function getDataBoardWise(board){
				if(board){
					window.location.href = '/admin/class-list?board_name='+board;
				}else{
					window.location.href = '/admin/class-list';
				}
			}

			function deleteClass(id){
				var board = id.split("-");
				$.ajax({
					url: '/admin/del-class-list',
					type: 'POST',
					data:{class_id:board[0]},
					success:function(data){
						var data = JSON.parse(data);
						console.log(data);
						$(".loading-bg").hide();
						if (data.flag) {
							swal('Success', data.message,'success').then(function(){
								location.reload();
							});
						} else {
							swal( 'Error', data.message,'error').then(function(){
								location.reload();
							});
									// return false;
								}
							}
						});
			}

			function editClass(class_id,class_name,board_id){
				$('#edit_class_name').val(class_name);
				$('#edit_board_id').val(board_id).attr('selected');
				$('#edit_class_id').val(class_id);
			}
		</script>