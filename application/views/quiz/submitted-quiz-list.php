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

					<h2>Submitted Quiz </h2>

					<!-- <a href="<?php echo base_url(); ?>admin/create-new-quiz" class="btn btn-success pull-right" title="Create Quiz">Create Quiz</a> -->

					<div class="clearfix"></div>

				</div>

				<div class="x_content">

					<div class="table-responsive">

						<table class="table table-striped jambo_table bulk_action dataTable">

							<thead>

								<tr class="headings">

									<th>#</th>

									<th class="column-title">Quiz Name </th>
									
									<th class="column-title">Submitted By </th>
									
									<th class="column-title">Action</th>

								</tr>

							</thead>

							<tbody>

								<?php $i = 1;

								if ($submitted_quiz_list) {

									foreach ($submitted_quiz_list as $submitted_quiz) { ?>

										<tr class="even pointer">

											<td class="a-center "><?php echo $i; ?></td>

											<td class=" "><a href="<?php echo base_url(); ?>admin/quiz-result/<?php echo md5( $submitted_quiz['submitted_by']); ?>" title="View Results" onclick="showQuizResult(<?php echo  $submitted_quiz['submitted_by']; ?>)" style="color: blue;"><?php echo  $submitted_quiz['quiz_name']; ?></a></td>

											
											<td class=" "><?php echo $submitted_quiz['name']; ?></td>


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