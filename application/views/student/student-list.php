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

					<h2>Student List </h2>

					

					<div class="clearfix"></div>

				</div>

				<div class="x_content">

					<div class="table-responsive">

						<table class="table table-striped jambo_table bulk_action dataTable" id="studentTable">

							<thead>

								<tr class="headings">

									<th>#</th>

									<th class="column-title">Student Name </th>

									<th class="column-title">User Name </th>

									<th class="column-title">Role </th>

									<th class="column-title">Status </th>

									<th class="column-title">Action</th>

								</tr>

							</thead>


							<tbody>

								<?php $i = 1;

								if ($studentList) {

									foreach ($studentList as $student) { ?>

										<tr class="even pointer">

											<td class="a-center "><?php echo $i; ?></td>

											<td class=" "><?php echo $student['name']; ?></td>

											<td class=" "><?php echo $student['username']; ?></td>

											<td class=" "><?php echo $student['role']; ?></td>

											<td class=" "><?php echo ($student['is_active']?"Active":"Inactive"); ?></td>

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
