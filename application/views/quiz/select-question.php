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
					<h2>Select Question To Student </h2>
					<div class="clearfix"></div>
				</div>


				<div class="x_content">
					<form action="<?php echo base_url(); ?>admin/select-question-list" method="post" class="form-horizontal form-label-left" id="question_form">
						
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action dataTable" id="selectQuestion">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="from-group">
										<label for="quiz_name"> Quiz List :</label>
										<select class="form-control select2" name="select_quiz" id="select_quiz" required>
											<option value="">Select Quiz</option>
											<?php foreach ($quizList as $quiz): ?>
												<option value="<?php echo $quiz['id']."-".$quiz['quiz_name']; ?>" <?php echo set_value('quiz_name') == $quiz['id']."-".$quiz['quiz_name'] ? "selected":""; ?>><?php echo $quiz['id']."_". $quiz['quiz_name']; ?></option>
											<?php endforeach ?>
										</select>
										<span class="label label-danger" id="quiz_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
										<?php echo form_error('quiz_name'); ?>
									</div>

									<br clear="all">

									<div class="row">

										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a data-toggle="collapse" href="#collapse1">Collapsible list group</a>
													</h4>
												</div>
												<div class="panel-body">

													<div id="collapse1" class="panel-collapse collapse">
														hello
													</div>
												</div>
											</div>
										</div>
									</div>


									<thead>

										<tr class="headings">

											<th> <input type="checkbox" id = "checkAll"></th>

											<th>#</th>

											<th class="column-title">Question </th>

											<th class="column-title">Course Name </th>

											<th class="column-title">Subject Name </th>

											<th class="column-title">Topic Name </th>

											<th class="column-title">Status </th>

											<th class="column-title">Action</th>

										</tr>

									</thead>
									<tbody>

										<?php $i = 1;

										if ($questionList) {

											foreach ($questionList as $question) { ?>

												<tr class="even pointer">
													<td><input type="checkbox" name="question_number[]" value ="<?php echo $question['id'].'-'.$question['question']; ?>"></td>

													<td class="a-center "><?php echo $i; ?></td>

													<td class=" "><a href="javascript:void(0)" title="View Options" onclick="showQuestionOptions(<?php echo $question['id']; ?>)" style="color: blue;"><?php echo $question['question']; ?></a></td>

													<td class=" "><?php echo $question['course_name']; ?></td>

													<td class=" "><?php echo $question['subject_name']; ?></td>

													<td class=" "><?php echo $question['topic_name']; ?></td>

													<td class=" "><?php echo ($question['is_active']?"Active":"Inactive"); ?></td>

													<td class=" "></td>

												</tr>

												<?php $i++; } } ?>

											</tbody>


										</div>


									</table>

								</div>
								<a href="javascript:void(0)" class="btn btn-success" id="submitQuestion">Submit</a>
							</form>
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
				$("#submitQuestion").click(function(event) {
					event.preventDefault();
					$("#question_form").submit();

				});
			});
		</script>


