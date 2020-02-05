 <div class="right_col" role="main">

  <div class="row"> 

    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">

       <!--  <div class="x_title">

          <h2>Create Quiz </h2>

          <a href="<?php echo base_url(); ?>admin/quiz-list" class="btn btn-success pull-right" title="View Quiz">Back</a>

          <div class="clearfix"></div>

        </div> -->

        <div class="x_content">

          <br />

          <form action="<?php echo base_url(); ?>admin/submit-quiz" method="post" class="form-horizontal form-label-left" id="attempted_quiz_form" onsubmit="return confirmSubmit()">

            <input type="hidden" name="quiz_id" value="<?php echo $quiz_details[0]['id']; ?>">
            <input type="hidden" name="quiz_name" value="<?php echo $quiz_details[0]['quiz_name']; ?>">
            <input type="hidden" name="course_id" value="<?php echo $quiz_details[0]['course_id']; ?>">
            <input type="hidden" name="course_name" value="<?php echo $quiz_details[0]['course_name']; ?>">
            <input type="hidden" name="subject_id" value="<?php echo $quiz_details[0]['subject_id']; ?>">
            <input type="hidden" name="subject_name" value="<?php echo $quiz_details[0]['subject_name']; ?>">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4">
                  <h3 align="center">Quiz : <strong><?php echo $quiz_details[0]['quiz_name']; ?></strong></h3>
                </div>
              </div>
              <br clear="all">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <h4>Course : <strong><?php echo $quiz_details[0]['course_name']; ?></strong></h4>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <h4>Subject : <strong><?php echo $quiz_details[0]['subject_name']; ?></strong></h4>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <h4>Time : <strong><?php echo $quiz_details[0]['quiz_duration']; ?></strong></h4>
                </div>
              </div>
              <br clear="all">
              <hr>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="border-right: 1px solid black;">

                 <?php $i = 1; 
                 $array_length = count($quiz_details);
                 foreach ($quiz_details as $quiz_question): ?>
                   <?php if ($i === 1){ ?>

                     <div id="question_<?php echo $i; ?>" class="question">

                      <input type="hidden" name="question_number[]" id="question_number_<?php echo $i; ?>" value="<?php echo $quiz_question['question_number']; ?>">
                      <span><strong>Question (<?php echo $quiz_question['question_number']; ?>) : </strong>&nbsp;<?php echo $quiz_question['question']; ?></span>
                      <br/>
                      <div style="margin: 20px;">
                        (A). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="A"> &nbsp;<?php echo $quiz_question['option_a']; ?><br>
                        (B). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="B"> &nbsp;<?php echo $quiz_question['option_b']; ?><br>
                        (C). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="C"> &nbsp;<?php echo $quiz_question['option_c']; ?><br>
                        (D). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="D"> &nbsp;<?php echo $quiz_question['option_d']; ?>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4">
                          <div class="form-group">
                            <a href="javascript:void(0)" class="btn btn-primary" id="" onclick="showQuestionDiv(<?php echo $i+1; ?>)">Save & Next</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div id="question_<?php echo $i; ?>" class="question" style="display: none;">
                      <input type="hidden" name="question_number[]" id="question_number_<?php echo $i; ?>" value="<?php echo $quiz_question['question_number']; ?>">
                      <span><strong>Question (<?php echo $quiz_question['question_number']; ?>) : &nbsp;</strong><?php echo $quiz_question['question']; ?></span>
                      <br/>
                      <div style="margin: 20px;">
                        (A). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="A"> &nbsp;<?php echo $quiz_question['option_a']; ?><br>
                        (B). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="B"> &nbsp;<?php echo $quiz_question['option_b']; ?><br>
                        (C). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="C"> &nbsp;<?php echo $quiz_question['option_c']; ?><br>
                        (D). &nbsp;<input type="radio" name="question_option_<?php echo $i; ?>" value="D"> &nbsp;<?php echo $quiz_question['option_d']; ?>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4">
                          <div class="form-group">
                            <a href="#" class="btn btn-warning" onclick="showQuestionDiv(<?php echo $i-1; ?>)">Previous</a>
                            <?php if ($array_length === $i){ ?>
                              <input type="submit" class="btn btn-success" name="submitQuiz" value="Submit">
                            <?php } else { ?>
                              <a href="javascript:void(0)" class="btn btn-primary" id="" onclick="showQuestionDiv(<?php echo $i+1; ?>)">Save & Next</a>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } $i++; endforeach ?>


                </div>
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
                  <div style="padding: 0px 10px 0px 10px;">
                    <?php
                    $k = 1;
                    for($i = 1; $i <= count($quiz_details); $i++){ ?>
                      <a href="#" class="btn btn-default" style="margin: 2px 2px 2px 2px; width: 40px;" onclick="showQuestionDiv(<?php echo $i; ?>)"><?php echo $i; ?></a>
                      <?php if ($i % 5 === 0) {
                        echo "<br>";
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
              <br clear="all">

              <div class="ln_solid"></div>



            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>



<script>

  $(document).ready(function(){
  //  $(document).bind("contextmenu",function(e){
  //   return false;
  // });
  //  $(document).keydown(function (event) {  
  //   event = (event || window.event);  
  //   if (event.keyCode == 123) {  
  //     return false;  
  //   }  
  // });  
});

  function confirmSubmit() {
   if (confirm("Do you want to submit quiz?")) {
    return true;
  } else {
    return false;
  }
}
function showQuestionDiv(question_number) {
 $(".question").each(function() {
  $(".question").hide();
  var que_number = $("#question_number_"+question_number).val();
  console.log(question_number);
  if (parseInt(que_number) == parseInt(question_number)) {
   $("#question_"+question_number).show();
 } 
});
}
</script>

