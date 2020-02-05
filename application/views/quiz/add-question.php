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

          <h2>Add Question </h2>

          <a href="<?php echo base_url(); ?>admin/question-list" class="btn btn-success pull-right" title="View Question">Back</a>

          <div class="clearfix"></div>

        </div>

        <div class="x_content">

          <br />

          <form action="<?php echo base_url(); ?>admin/add-question" method="post" class="form-horizontal form-label-left" id="question_form">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">

                  <div class="from-group">

                    <label for="board_name">Board :</label>

                    <select class="form-control select2" name="board_name" id="board_name">

                      <option value="">Select Board</option>

                      <?php
                      if ($BoardList) {
                  // echo '<pre>';print_r($BoardList);exit;
                        foreach ($BoardList as $board) { ?>

                          <option value="<?php echo $board['id']?>"><?php echo $board['board']?></option>

                        <?php }
                      }
                      ?>

                    </select>

                    <span class="label label-danger" id="course_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                    <?php echo form_error('course_name'); ?>

                  </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">

                  <div class="from-group">

                    <label for="subject_name">Class :</label>

                    <select class="form-control select2" name="class_name" id="class_name">

                      <option value="">Select Class</option>
                      <?php
                      if ($classList) {
                  // echo '<pre>';print_r($BoardList);exit;
                        foreach ($classList as $class) { ?>

                          <option value="<?php echo $class['id']?>"><?php echo $class['class']?></option>

                        <?php }
                      }
                      ?>

                    </select>

                    <span class="label label-danger" id="subject_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                    <?php echo form_error('subject_name'); ?>

                  </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">

                  <div class="from-group">

                    <label for="subject_name">Subject :</label>

                    <select class="form-control select2" name="subject_name" id="subject_name">

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

                    <span class="label label-danger" id="subject_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                    <?php echo form_error('subject_name'); ?>

                  </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">

                  <div class="from-group">

                    <label for="topic_name">Unit :</label>

                    <select class="form-control select2" name="unit_name" id="unit_name">

                      <option value="">Select Unit</option>

                    </select>

                    <span class="label label-danger" id="topic_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                    <?php echo form_error('topic_name'); ?>

                  </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">

                  <div class="from-group">

                    <label for="chapter_name">Chapters :</label>

                    <select class="form-control select2" name="chapter_name" id="chapter_name">

                      <option value="">Select Chapter</option>

                    </select>

                    <span class="label label-danger" id="topic_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                    <?php echo form_error('topic_name'); ?>

                  </div>

                </div>

              </div>

              <hr>

              <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                  <div class="from-group">

                   <label for="question">Question :</label>

                   <textarea class="ckeditor" name="question" id="question" cols="200" rows="5" placeholder="Write Question Here...."><?php echo set_value('question'); ?></textarea>

                   <span class="label label-danger" id="question_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                   <?php echo form_error('question'); ?>

                 </div>

               </div>

             </div>

             <br clear="all">

             <div class="row">

              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <div class="from-group">

                  <label for="optionA">Option : A </label>

                  <textarea class="ckeditor" name="optionA" id="optionA" cols="30" rows="10"></textarea>

                  <span class="label label-danger" id="option_a_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                  <?php echo form_error('optionA'); ?>

                </div>

              </div>

              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <div class="from-group">

                  <label for="optionB">Option : B </label>

                  <textarea class="ckeditor" name="optionB" id="optionB" cols="30" rows="10"></textarea>

                  <span class="label label-danger" id="option_b_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                  <?php echo form_error('optionB'); ?>

                </div>

              </div>

            </div>

            <br clear="all">

            <div class="row">

              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <div class="from-group">

                  <label for="optionC">Option : C </label>

                  <textarea class="ckeditor" name="optionC" id="optionC" cols="30" rows="10"></textarea>

                  <span class="label label-danger" id="option_c_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                  <?php echo form_error('optionC'); ?>

                </div>

              </div>

              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <div class="from-group">

                  <label for="optionD">Option : D </label>

                  <textarea class="ckeditor" name="optionD" id="optionD" cols="30" rows="10"></textarea>

                  <span class="label label-danger" id="option_d_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                  <?php echo form_error('optionD'); ?>

                </div>

              </div>

            </div>

            <br clear="all">

            <div class="row">

              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                <div class="from-group">

                  <label for="answerKey">Answer Key : </label>

                  <select class="form-control select2" name="answerKey" id="answerKey">

                   <option value="">Select Answer Key</option>

                   <option value="1">option A</option>

                   <option value="2">option B</option>

                   <option value="3">option C</option>

                   <option value="4">option D</option>

                 </select>

                 <span class="label label-danger" id="answer_key_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

                 <?php echo form_error('answerKey'); ?>

               </div>

             </div>

             <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

              <label for="difficultyLevel">Difficulty Level : </label>

              <select class="form-control select2" name="difficultyLevel" id="difficultyLevel">

               <option value="">Select Difficulty Level</option>

               <option value="1">1</option>

               <option value="2">2</option>

               <option value="3">3</option>

               <option value="4">4</option>

               <option value="5">5</option>

             </select>

             <span class="label label-danger" id="difficulty_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>

             <?php echo form_error('difficultyLevel'); ?>

           </div>

           <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

            <div class="from-group">

              <label for="timeSlot">Time Slot : </label>

              <select class="form-control select2" name="timeSlot" id="timeSlot">

               <option value="">Select Time Slot</option>

               <?php $i = 1; for($i = 1; $i <= 60; $i++){ ?>

                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

              <?php } ?>

            </select>

          </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

          <div class="from-group">

            <label for="answerHint">Hint : </label>

            <textarea class="form-control" name="answerHint" id="answerHint" placeholder="Hint" cols="30" rows="4"></textarea>

          </div>

        </div>

      </div>

      <div class="ln_solid"></div>

      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <div class="form-group">

            <a href="/admin/add-question-view" class="btn btn-primary">Reset</a>

            <a href="javascript:void(0)" class="btn btn-success" id="submitQuestionForm">Submit</a>

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

    $("#answerKey").change(function(event) {

      event.preventDefault();

      $("#answer_key_error").css('display', 'none');

    });

    $("#difficultyLevel").change(function(event) {

      event.preventDefault();

      $("#difficulty_error").css('display', 'none');

    });

    CKEDITOR.on('instanceReady', function(ev) {

      ev.editor.on('focus', function(evt) {  

        $("#question_error").css('display', 'none');

        $("#option_a_error").css('display', 'none');

        $("#option_b_error").css('display', 'none');

        $("#option_c_error").css('display', 'none');

        $("#option_d_error").css('display', 'none');

      });  

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

    $("#submitQuestionForm").click(function(event) {

     event.preventDefault();

     var subject      = $("#subject_name").val();

     var course       = $("#course_name").val();

     var topic        = $("#topic_name").val();

     var question     = CKEDITOR.instances['question'].getData();

     var optionA      = CKEDITOR.instances['optionA'].getData();

     var optionB      = CKEDITOR.instances['optionB'].getData();

     var optionC      = CKEDITOR.instances['optionC'].getData();

     var optionD      = CKEDITOR.instances['optionD'].getData();

     var answer       = $("#answerKey").val();

     var difficulty   = $("#difficultyLevel").val();

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

