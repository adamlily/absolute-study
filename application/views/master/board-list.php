<!-- page content -->
<div class="right_col" role="main">
	<div class="row">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Board </h2>
					<a href="javascript:void(0)" class="btn btn-success pull-right" data-toggle="modal" data-target="#addboardModal" title="Add board">Add Board</a>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action" id="boardTable">
							<thead>
								<tr class="headings">
									<th>#</th>
									<th class="column-title">Board Name </th>
									<th class="column-title">Status </th>
									<th class="column-title">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								if ($BoardList) {
									// echo '<pre>';print_r($BoardList);exit;
									foreach ($BoardList as $board) { ?>
										<tr class="even pointer">
											<td class="a-center "><?php echo $i; ?></td>
											<td class=" "><?php echo $board['board']; ?></td>
											<td class=" "><?php echo $board['status']==1?"Actice":"Expired"; ?></td>
											<td class=" ">
												<a href="javascript:void(0)"><i class="fa fa-pencil" data-toggle="modal" data-target="#addboardModal" title="Edit board" onclick="getBoard('<?php echo  $board['id']."-".$board['board']?>')"></i></a>
												<a href="javascript:void(0)" onclick="deleteBoard('<?php echo  $board['id']."-".$board['board']?>')"><i class="fa fa-trash-o"></i></a>
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
						<h4 class="modal-title">Board</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url(); ?>admin/add-board"  role="form" id="addboardForm">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Board Name :</label>
									<input type="hidden" name="board_id" id="board_id" >
									<input type="text" class="form-control" name="board_name" id="board_name" placeholder="Board Name">
									<span class="label label-danger" id="board_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<a href="#" class="btn btn-primary pull-right" onclick="addBoard()" id="addBoard">Submit</a>
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
				$("#board_name").click(function(event) {
					event.preventDefault();
					$("#board_name_error").css('display', 'none');
				});

			});

			function addBoard(){
				event.preventDefault();
				var course = $("#board_name").val();
				if (course === "") {
					swal('Error', "Enter board Name",'error');
				} else {
					$(".loading-bg").show();

					$.ajax({
						url: $("#addboardForm").attr('action'),
						type: 'POST',
						data: $("#addboardForm").serialize(),
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
			}

			function getBoard(id){
				var board = id.split("-");
				$('#board_id').val(board[0]);
				$('#board_name').val(board[1]);
			}
			function deleteBoard(id){
				var board = id.split("-");
				$.ajax({
					url: 'http://logi-dolphin.com/admin/del-board-list',
					type: 'POST',
					data:{id:board[0]},
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
		</script>