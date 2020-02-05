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

					<h2>Quiz </h2>

					<div class="clearfix"></div>

				</div>

				<div class="x_content">

					<div class="table-responsive">

						<table class="table table-striped jambo_table bulk_action dataTable" id="quizTable">

							<thead>

								<tr class="headings">

									<th>#</th>

									<th class="column-title">Quiz Name </th>

									<th class="column-title">Course Name </th>

									<th class="column-title">Subject Name </th>

									<th class="column-title">Status </th>

									<th class="column-title">Action</th>

								</tr>

							</thead>

							<tbody>

								<?php $i = 1;

								if ($quizList) {

									foreach ($quizList as $quiz) { ?>

										<tr class="even pointer">

											<td class="a-center "><?php echo $i; ?></td>

											<td class=" "><a href="javascript:void(0)" title="View Options" onclick="showQuizDetails(<?php echo $quiz['id']; ?>)" style="color: blue;"><?php echo $quiz['quiz_name']; ?></a></td>

											<td class=" "><?php echo $quiz['course_name']; ?></td>

											<td class=" "><?php echo $quiz['subject_name']; ?></td>

											<td class=" "><?php echo ($quiz['is_active']?"Active":"Inactive"); ?></td>

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

		<!-- START : Question Details Modal -->

		<div class="modal fade" id="questionDetailsModal">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

						<h4 class="modal-title">Question Details</h4>

					</div>

					<div class="modal-body">

						

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					</div>

				</div>

			</div>

		</div>

		<!-- START : Question Details Modal -->

		<script>

			function showQuizDetails(quiz_id) {

				if (quiz_id === "") {

					alert("Something went wrong. Please try again.");

				} else {

					$(".loading-bg").show();

					$.ajax({

						url: '<?php echo base_url(); ?>get-question-details',

						type: 'POST',

						data: {quiz_id: quiz_id},

						success:function(data){

							$(".loading-bg").hide();

							console.log(data);

							$(".modal-body").empty();

							$(".modal-body").append(data);

							$("#questionDetailsModal").modal('toggle');

						}

					});

				}

			}

		</script>