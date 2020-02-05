

<?php if (array_key_exists('errorMessage', $questionDetails)) { ?>

	<h2 align="center"><?php echo $questionDetails['errorMessage']; ?></h2>

<?php } else { ?> 

	<style>

		.col-md-1, .col-lg-1 {

			padding-left: 0px; 

			padding-right: 0px; 

		}

		.row {

			margin: 5px;

		}

	</style>

	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

			<strong>Question : </strong>

		</div>

		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

			<span><?php echo $questionDetails['question']; ?></span>

		</div>

		<div class="clearfix"></div>

		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

			<strong>Option : </strong>

		</div>

		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

			<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">

				<strong>(A) : </strong>

			</div>

			<div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">

				<span><?php echo $questionDetails['option_a']; ?></span>

			</div>

			<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">

				<strong>(B) : </strong>

			</div>

			<div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">

				<span><?php echo $questionDetails['option_b']; ?></span>

			</div>
		</div>

			<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">

				<strong>(C) : </strong>

			</div>

			<div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">

				<span><?php echo $questionDetails['option_c']; ?></span>

			</div>
		</div>


			<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">

				<strong>(D) : </strong>

			</div>


			<div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">

				<span><?php echo $questionDetails['option_d']; ?></span>

			</div>

		</div>

		<div class="clearfix"></div>

		<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">

			<strong>Answer : </strong>

		</div>

		<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9">

			<span><strong><p><?php echo $questionDetails['answer_key']; ?></p></strong></span>

		</div>

		<div class="clearfix"></div>

		<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">

			<strong>Hint : </strong>

		</div>

		<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9">

			<span><p><?php echo $questionDetails['hint']; ?></p></span>

		</div>

		<div class="clearfix"></div>

		<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3" style="padding-right: 0px;">

			<strong>Difficulty Level : </strong>

		</div>

		<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9">

			<span><strong><p><?php echo $questionDetails['difficulty_level']; ?></p></strong></span>

		</div>

		<div class="clearfix"></div>

		<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">

			<strong>Time Slot : </strong>

		</div>

		<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9">

			<span><strong><p><?php echo $questionDetails['time_slot']; ?></p></strong></span>

		</div>

	</div>

	<?php } ?>