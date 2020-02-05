<style>
	a:hover {
		text-decoration: underline;
	}
</style>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

				<div class="x_title">
					<h2>Allocate Quiz To Student </h2>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">
					<form action="<?php echo base_url(); ?>admin/allocate-to-student" method="post" class="form-horizontal form-label-left" id="student_form">
						
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action dataTable" id="allocateQuiz">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="from-group">
										<label for="quiz_name">Allocate Quiz List :</label>
										<select class="form-control select2" name="allocated_quiz" id="allocated_quiz" required>
											<option value="">Select Quiz</option>
											<?php foreach ($quizList as $quiz): ?>
												<option value="<?php echo $quiz['id']."-".$quiz['quiz_name']; ?>" <?php echo set_value('quiz_name') == $quiz['id']."-".$quiz['quiz_name'] ? "selected":""; ?>><?php echo $quiz['quiz_name']; ?></option>
											<?php endforeach ?>
										</select>
										<span class="label label-danger" id="quiz_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
										<?php echo form_error('quiz_name'); ?>
									</div>
								</div>
								<thead>
									<tr class="headings">
										<th> <input type="checkbox" id = "checkAll"></th>
										<th>#</th>
										<th class="column-title">Student Name </th>
										<th class="column-title">User Name </th>
										<th class="column-title">Role </th>
										<th class="column-title">Status </th>
										<th class=" "></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									if ($studentList) {
										foreach ($studentList as $student) { ?>
											<tr class="even pointer">
												<td><input type="checkbox" name="student_id[]" value ="<?php echo $student['id'].'-'.$student['name']; ?>"></td>
												<td class="a-center "><?php echo $i; ?></td>
												<td class=" "><?php echo $student['name']; ?></td>
												<td class=" "><?php echo $student['username']; ?></td>
												<td class=" "><?php echo $student['role']; ?></td>
												<td class=" "><?php echo ($student['is_active']?"Active":"Inactive"); ?></td>

											</tr>
											<?php $i++; } } ?>
										</tbody>

									</table>

								</div>

							</form>

							<div class="form-group">
								<a href="javascript:void(0)" class="btn btn-success" id="submitStudent">Submit</a>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function () {
			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
			function handleStatus(status){
				console.log(status);
			}
			$("#submitStudent").click(function(event) {
				event.preventDefault();
				$("#student_form").submit();

			});
		});
	</script>
