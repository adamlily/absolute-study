 <!-- CKEDITOR -->

 <script src="<?php echo base_url();?>vendors/ckeditor/ckeditor.js"></script>

 <!-- CKEDITOR JQuery Adapter-->

 <script src="<?php echo base_url();?>vendors/ckeditor/adapters/jquery.js"></script>

 <!-- page content -->

 <div class="right_col" role="main">

  <div class="row"> 

    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">

        <div class="x_title">

          <h2>Create Quiz </h2>

          <a href="<?php echo base_url(); ?>admin/quiz-list" class="btn btn-success pull-right" title="View Quiz">Back</a>

          <div class="clearfix"></div>

        </div>

        <div class="x_content">

          <br />

          <form action="<?php echo base_url(); ?>admin/save-new-quiz" method="post" class="form-horizontal form-label-left" id="question_form">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                  <div class="from-group">

                    <label for="course_name">Course :</label>

                    <select class="form-control select2" name="course_name" id="course_name">

                      <option value="">Select Course</option>

                      <?php foreach ($courseList as $course): ?>

                        <option value="<?php echo $course['id']."-".$course['course_name']; ?>" <?php echo set_value('course_name') == $course['id']."-".$course['course_name'] ? "selected":""; ?>><?php echo $course['course_name']; ?></option>

                      <?php endforeach ?>

                    </select>

                    <span class="label label-danger" id="course_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                    <?php echo form_error('course_name'); ?>

                  </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                  <div class="from-group">

                    <label for="subject_name">Subject :</label>

                    <select class="form-control select2" name="subject_name" id="subject_name">

                      <option value="">Select Subject</option>

                    </select>

                    <span class="label label-danger" id="subject_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                    <?php echo form_error('subject_name'); ?>

                  </div>

                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="quiz_name">Quiz Name</label>
                    <input type="text" class="form-control" name="quiz_name" id="quiz_name" placeholder="Quiz Name">
                    <?php echo form_error('quiz_name'); ?>
                  </div>
                </div> 
                

              </div>

              <br clear="all">

              <div class="row">

                
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="number_of_questions">No Of Question</label>
                    <input type="text" class="form-control" name="number_of_questions" id="number_of_questions" placeholder="Number Of Questions">
                    <?php echo form_error('number_of_questions'); ?>
                  </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                    <?php echo form_error('description'); ?>
                  </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="attempt_count">Attempt Count</label>
                    <input type="text" class="form-control" name="attempt_count" id="attempt_count" placeholder="Attempt Count">
                    <?php echo form_error('attempt_count'); ?>
                  </div>
                </div>


                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="quiz_duration">Quiz Duration</label>
                    <input type="text" class="form-control" name="quiz_duration" id="quiz_duration" placeholder="Quiz Duration">
                    <?php echo form_error('quiz_duration'); ?>
                  </div>
                </div>


              </div>

              <div class="ln_solid"></div>

              <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                  <div class="form-group">

                    <a href="/admin/create-new-quiz" class="btn btn-primary">Reset</a>

                    <a href="javascript:void(0)" class="btn btn-success" id="submitQuizForm">Submit</a>

                  </div>

                </div>

              </div>

            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>



<script>

  $(document).ready(function() {

    $("#course_name").change(function(event) {

      event.preventDefault();

      $("#course_name_error").css('display', 'none');

    });

    $("#subject_name").change(function(event) {

      event.preventDefault();

      $("#subject_name_error").css('display', 'none');

    });

    $("#topic_name").change(function(event) {

      event.preventDefault();

      $("#topic_name_error").css('display', 'none');

    });



    $("#course_name").change(function(event) {

      event.preventDefault();

      var course  = $("#course_name").val();

      if (course === "") {

        $("#subject_name").empty();

        $("#topic_name").empty();

        $("#subject_name").empty();

        $("#course_name_error").text('Select course name');

        $("#course_name_error").css('display', 'block');

      } else {

        $(".loading-bg").show();

        $.ajax({

          url: '<?php echo base_url(); ?>get-subject-list-by-course',

          type: 'POST',

          data: {course_id: course},

          success:function(data){

            var data = JSON.parse(data);

            console.log(data);

            $(".loading-bg").hide();

            if (data.flag) {

              $("#subject_name").empty();

              $("#subject_name").append(data.subjectOptions);

            } else {



            }

          }

        });

      }

    });

    $("#subject_name").change(function(event) {

      event.preventDefault();

      var subject  = $("#subject_name").val();

      var course  = $("#course_name").val();

      if (course === "") {

       $("#topic_name").empty();

       $("#subject_name").empty();

       $("#course_name_error").text('Select course name');

       $("#course_name_error").css('display', 'block');

     } else if (subject === "") {

      $("#topic_name").empty();

      $("#subject_name_error").text('Select subject name');

      $("#subject_name_error").css('display', 'block');

    } else {

      $(".loading-bg").show();

      $.ajax({

        url: '<?php echo base_url(); ?>get-subject-list-by-course-subject',

        type: 'POST',

        data: {subject_id: subject, course_id: course},

        success:function(data){

          var data = JSON.parse(data);

          console.log(data);

          $(".loading-bg").hide();

          if (data.flag) {

            $("#topic_name").empty();

            $("#topic_name").append(data.topicOptions);

          } else {



          }

        }

      });

    }

  });

    $("#submitQuizForm").click(function(event) {

     event.preventDefault();

     var subject      = $("#subject_name").val();

     var course       = $("#course_name").val();

     var topic        = $("#topic_name").val();

  //    if (course === "") {

  //      $("#course_name").focus();

  //      $("#topic_name").empty();

  //      $("#subject_name").empty();

  //      $("#course_name_error").text('Select course name');

  //      $("#course_name_error").css('display', 'block');

  //      return false;

  //    } else if (subject === "") {

  //     $("#subject_name").focus();

  //     $("#topic_name").empty();

  //     $("#subject_name_error").text('Select subject name');

  //     $("#subject_name_error").css('display', 'block');

  //     return false;

  //   } else if (topic === "") {

  //    $("#topic_name").focus();

  //    $("#topic_name_error").text('Select topic name');

  //    $("#topic_name_error").css('display', 'block');

  //    return false;

  //  } else if (question === "") {

  //   $("#question_error").text('Please write question');

  //   $("#question_error").css('display', 'block');

  //   $("html, body").animate({ scrollTop: 0 }, "slow");

  //   return false;

  // } else if (optionA === "") {

  //   $("#option_a_error").text('Please write option');

  //   $("#option_a_error").css('display', 'block');

  //   $("html, body").animate({ scrollTop: 0 }, "slow");

  //   return false;

  // } else if (optionB === "") {

  //   $("#option_b_error").text('Please write option');

  //   $("#option_b_error").css('display', 'block');

  //   $("html, body").animate({ scrollTop: 0 }, "slow");

  //   return false;

  // } else if (optionC === "") {

  //   $("#option_c_error").text('Please write option');

  //   $("#option_c_error").css('display', 'block');

  //   return false;

  // } else if (optionD === "") {

  //   $("#option_d_error").text('Please write option');

  //   $("#option_d_error").css('display', 'block');

  //   return false;

  // } else if (answer === "") {

  //   $("#answerKey").focus();

  //   $("#answer_key_error").text('Please select answer key');

  //   $("#answer_key_error").css('display', 'block');

  //   return false;

  // } else if (difficulty === "") {

  //   $("#difficultyLevel").focus();

  //   $("#difficulty_error").text('Please select difficulty');

  //   $("#difficulty_error").css('display', 'block');

  //   return false;

  // } else {

  // }

  $("#question_form").submit();

});

  });

</script>

