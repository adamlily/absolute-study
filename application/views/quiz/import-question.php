 <!-- page content -->
 <div class="right_col" role="main">
  <div class="row"> 
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Import Question</h2>
          <a href="<?php echo base_url(); ?>admin/question-list" class="btn btn-success pull-right" title="View Question">Back</a>
          <div class="clearfix"></div>
        </div>
        <div class="row">

          <form action="<?php echo base_url();?>admin/import-question" method="post" enctype="multipart/form-data">
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
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <div class="from-group">
                <label for="topic_name">Topic :</label>
                <select class="form-control select2" name="topic_name" id="topic_name">
                  <option value="">Select Topic</option>
                </select>
                <span class="label label-danger" id="topic_name_error" style="display: none; font-size: 14px;"><i class="fa fa-exclamation-circle"></i>&nbsp;</span>
                <?php echo form_error('topic_name'); ?>
              </div>
            </div>
          </div>
        </br>
        <div class="x_content">
          <br />


          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
              <label for="question_excel_sheet">Select File to Import :</label>
              <input type="file" class="form-control" name="uploadFile"/><br><br>
              <?php echo form_error('uploadFile'); ?>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <input type="submit" class="btn btn-primary" name="submit" value="Upload"style="margin-top: 24px;">

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
});
</script>