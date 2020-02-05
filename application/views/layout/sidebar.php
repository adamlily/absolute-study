

<br />

<!-- sidebar menu -->

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

  <div class="menu_section">

    <ul class="nav side-menu">

      <?php if ($role_id === '1' && $role === 'admin'): ?>

        <li><a><i class="fa fa-cog"></i>Master <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="<?php echo base_url(); ?>admin/sector-list">Sectors</a></li>

            <li><a href="<?php echo base_url(); ?>admin/job-role-list">Job Roles</a></li>

            <li><a href="<?php echo base_url(); ?>admin/section-list">Sections</a></li>
            <li><a href="<?php echo base_url(); ?>admin/board-list">Boards</a></li>
            <li><a href="<?php echo base_url(); ?>admin/class-list">Classes</a></li>
            <li><a href="<?php echo base_url(); ?>admin/subject-list">Subjects</a></li>
            <li><a href="<?php echo base_url(); ?>admin/unit-list">Unit</a></li>
            <li><a href="<?php echo base_url(); ?>admin/chapter-list">Chapters</a></li>
            <li><a href="<?php echo base_url(); ?>admin/question-list">Questions</a></li>

          </ul>

        </li>

      <?php endif ?>

      <?php if ($role_id === '1' && $role === 'admin'): ?>


        <li><a><i class="fa fa-question-circle"></i>Quiz <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="<?php echo base_url(); ?>admin/question-list">Question</a></li>

            <li><a href="<?php echo base_url(); ?>admin/quiz-list">Quiz</a></li>
            <li><a href="<?php echo base_url(); ?>admin/select-question">Select Question</a></li>


            <li><a href="<?php echo base_url(); ?>admin/attempt-quiz">Quiz Attempt</a></li>

            <li><a href="<?php echo base_url(); ?>admin/submitted-quiz">Quiz Submitted</a></li>

          </ul>

        </li>

      <?php endif ?>

      <?php if ($role_id === '2' && $role === 'student'): ?>

        <li><a><i class="fa fa-question-circle"></i>Quiz <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="<?php echo base_url(); ?>student/attempt-quiz">Attempt Quiz</a></li>

            <li><a href="<?php echo base_url(); ?>student/submitted-quiz">Attempted Quiz</a></li>

          </ul>

        </li>

      <?php endif ?>

      <?php if ($role_id === '1' && $role === 'admin'): ?>

        <li><a><i class="fa fa-question-circle"></i>Student <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="<?php echo base_url(); ?>admin/import-student-view">Import Student Data</a></li>

            <li><a href="<?php echo base_url(); ?>admin/student-list">Student List</a></li>

            <li><a href="<?php echo base_url(); ?>admin/allocate-quiz-to-student">Allocate Quiz</a></li>

            <!-- <li><a href="<?php echo base_url(); ?>admin/quiz-list">Quiz</a></li> -->

          </ul>

        </li>
      <?php endif ?>

    </ul>

  </div>

</div>