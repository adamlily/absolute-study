<!-- page content -->
<div class="right_col" role="main">
	<div class="row">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Questions</h2>
					<a href="javascript:void(0)" class="btn btn-success pull-right" data-toggle="modal" data-target="#addboardModal" title="Add board">Add Questions</a>
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
									<th class="column-title">Chapters</th>
									<th class="column-title">Status </th>
									<th class="column-title">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								if ($chapterList) {
									// echo '<pre>';print_r($BoardList);exit;
									foreach ($chapterList as $chapter) { ?>
										<tr class="even pointer"class>
											<td class="a-center "><?php echo $i; ?></td>
											<td class=" "><?php echo $chapter['chapter']; ?></td>
											<td class=" "><?php echo $chapter['status']==1?"Actice":"Expired"; ?></td>
											<td class=" ">
												<a href=""><i class="fa fa-pencil"></i></a>
												<a href=""><i class="fa fa-trash-o"></i></a>
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
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Add Questions</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url(); ?>admin/add-chapter-list" method="POST" role="form" id="addboardForm">
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
									<select name="class_name" class="form-control" id="class_name"> 
										<option>Select Class</option>
										<?php
										if ($classList) {
									// echo '<pre>';print_r($BoardList);exit;
											foreach ($classList as $class) { ?>

												<option value="<?php echo $class['id']?>"><?php echo $class['class']?></option>

											<?php }
										}
										?>
									</select>
									<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Subject Name :</label>
									<select name="subject_name" class="form-control" id="subject_name"> 
										<option>Select Subject</option>
										<?php
										if ($subjectList) {
									// echo '<pre>';print_r($BoardList);exit;
											foreach ($subjectList as $subject) { ?>

												<option value="<?php echo $subject['id']?>"><?php echo $subject['subject']?></option>

											<?php }
										}
										?>
									</select>
									<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Chapter Name :</label>
									<select name="subject_name" class="form-control" id="subject_name"> 
										<option>Select Chapter</option>
										<?php
										if ($chapterList) {
									// echo '<pre>';print_r($BoardList);exit;
											foreach ($chapterList as $chapter) { ?>

												<option value="<?php echo $chapter['id']?>"><?php echo $chapter['chapter']?></option>

											<?php }
										}
										?>
									</select>
									<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Question:</label>
									<textarea class="form-control" name="question[]" id="question"></textarea>
									<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
								</div>
							</div>
							<div class="row" id="addMoreRow"></div>
							<br clear="all">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="submit" class="btn btn-primary pull-right" name="submitCourseForm" id="addBoard" value="Submit">
									<a href="javascript:void(0)" class="btn btn-primary pull-right" id="addMore"><i class="fa fa-plus" ></i></a>
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
				$("#addboard").click(function(event) {
					event.preventDefault();
					var course = $("#class_name").val();
					if (course === "") {
						$("#class_name_error").text('Enter Class name');
						$("#class_name_error").css('display', 'block');
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
									window.location.reload();
								} else {
									$("#class_name_error").text(data.message);
									$("#class_name_error").css('display', 'block');
									return false;
								}
							}
						});

					}
				});

				$("#addMore").on('click',function(){
					var html =`<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
					<label for="">Question :</label>
					<textarea class="form-control" name="question[]" id="question"></textarea>
					<span class="label label-danger" id="class_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
					</div>
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					<label for=""></label><br>
					<a href="javascript:void(0)" class="btn btn-primary pull-right" id="removeRow" onclick="deleteRow(this)"><i class="fa fa-minus" ></i></a>
					</div>`;

					$("#addMoreRow").append(html);
				});

				function deleteRow(count){
					$(count).remove();
				}
				
			});
		</script>