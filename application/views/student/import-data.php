<!-- page content -->

<div class="right_col" role="main">

  <div class="row"> 

    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">

        <div class="x_title">

          <h2>Import Student Data</h2>

          <a href="<?php echo base_url(); ?>admin/student-list" class="btn btn-success pull-right" title="View Student List">Student List</a>

          <div class="clearfix"></div>

        </div>

        <div class="x_content">

          <br />

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <span>Download sample sheet :</span>

            <a href="<?php echo base_url(); ?>student-sample-sheet/student_excel.xlsx" class="btn btn-success" title="Download Sample Sheet">Sample Sheet</a>

          </div>
          <form action="<?php echo base_url(); ?>admin/import-student-data" method="post" class="form-horizontal form-label-left" id="import_student_form" enctype="multipart/form-data">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

             <div class="row">


              <div class="clearfix"></div>

              <br clear="all">

              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                <div class="form-group">

                  <label for="student_excel_sheet">Select File to Import :</label>

                  <input type="file" class="form-control" name="student_excel_sheet" id="student_excel_sheet">
                 <?php echo form_error('student_excel_sheet'); ?>
                </div>

              </div>

              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                <input type="submit" class="btn btn-primary" name="importSubmit" value="Import Data" style="margin-top: 24px;">

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



</script>

