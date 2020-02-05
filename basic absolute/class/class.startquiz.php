<?php

class Take_Quiz{
	
	 var $user_id;
		var $Q_Id;
	 
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
		$this->objMail=new PHPMailer();
	}
	
	
	
	function start_test($student_id,$quizId)
	{
		?>
      
       <form class="contactForm" method="post" action="test.php">
					<h3>New Quiz Details: </h3>	
								<fieldset style="width:450px;">
									<div class="row"> 
										<label for="wname">Student Id:</label>
										<input type="text"name="student_id" placeholder="Student Id" value="<?php echo $_REQUEST['student_id']; ?>">
									</div>
									<div class="row">
										<label for="wmail">Quiz Id:</label>
										<input type="text" name="quizId" value="<?php echo $_REQUEST['quizId']; ?>" placeholder="Quiz Id">
									</div>
									<div class="row">
							     <button value="Start Now" class="button medium button-style1 align-btn-left" type="submit">Start Now</button>
									</div>
								</fieldset>
</form>
	
<?php
	}
	
   function takequiz($student_id,$quiz_ID)
   {
	    $this->student_id = $student_id;
	   	$this->quiz_PoolID = $quiz_ID;
	   
			$sql_fet_ques="select * from ".TBL_QUIZ_POOL." where id='".$this->quiz_PoolID."'";
			$result_fet_ques= $this->db->query($sql_fet_ques,__FILE__,__LINE__);
			$row_fet_ques= $this->db->fetch_array($result_fet_ques);
			
			$ques_array = explode('---',$row_fet_ques['questions']);
			$totalques = count($ques_array)-1;
			//echo $_REQUEST['qid'];
			//echo $totalques;
			//print_r($ques_array);
			$quesId=$_REQUEST['qid'];
			if($quesId=='')
			{
				$_SESSION['user_ans']='---';
							$insert_sql_array['quizpool_id'] = $_REQUEST['quizId'];
							$insert_sql_array['student_id'] = $this->student_id;
							$insert_sql_array['date'] = date('Y-m-d H:i:s');
							$insert_sql_array['class'] = '1';
							$insert_sql_array['answers'] = $_SESSION['user_ans'];
							$insert_sql_array['start_time'] = time();
							$insert_sql_array['end_time'] = time();
							$this->db->insert(TBL_STUDNT_QUIZ_ANS,$insert_sql_array);
							$this->last_Id=$this->db->last_insert_id();
				$quesId=1;
			}
			
			elseif($quesId == $totalques)
			{
			?>
			<script>
			  window.location='test_end.php?test_Id=<?php echo $_REQUEST['test_Id'];?>';
			</script>	
      <?php
			}
			else
			{
				$this->last_Id=$_REQUEST['test_Id'];
			}
			
	   ?>
       <a name="QuizStart"></a>
       <form name="answerform"  enctype="multipart/form-data">
							<div class="page-header">
								<h1>Question No. <?php echo $quesId; $this->set_questionId($quesId);?></h1>
							</div>
							<!-- Single Page -->
                           
								<div class="description shadow-large">
                                
                                <?php //echo $ques_array[$quesId];?>
                                <?php  echo $this->Get_Question_from_Id($ques_array[$quesId]);?>
										</div>

                                        <div>
										<?php echo $this->questions_opt($ques_array[$quesId]);?>
									</div>
                                    
                                   <?php /*?> <td><button style="margin-left:143px;" class="btn btn-success" type="button">Previous</button></td><?php */?>
                                    
            		 <div class="span7" id="NextButton" style="padding-bottom:25px;"><button style="float:right;" onclick="start_new_quiz.create_answer_session(this.form.correctans.value,'<?php echo $this->quiz_PoolID;?>','<?php echo $quesId+1;?>','<?php echo $this->last_Id;?>',{}); document.getElementById('NextButton').innerHTML='Sending...!' " type="button" class="button medium button-style1 align-btn-right">Next</button></div>
                           </form>             
                           
                        
       <?php
   }
   
   function create_answer_session($answer,$quizId,$quesId,$last_Id)
   {
	   ob_start();
	   
	   if($answer=='')
	   { $answer='x'; }
	   
	   $_SESSION['user_ans'].=$answer.'---';
	   
	   	$sql="select * from ".TBL_STUDNT_QUIZ_ANS." where id='".$last_Id."'";
	   	$result= $this->db->query($sql,__FILE__,__LINE__);
		$row= $this->db->fetch_array($result);
		
		$current_time=time();
		$new_time=$current_time-$row['end_time'];
		
	    $update_sql_array = array();
	    $update_sql_array['answers'] = $row['answers'].$answer.'---';
	    $update_sql_array['end_time'] = time();
	    $update_sql_array['all_time'] = $row['all_time'].'###'.$new_time;
		$this->db->update(TBL_STUDNT_QUIZ_ANS,$update_sql_array,'id',$last_Id); 
	 
	  ?>
      <script>
	  //alert('<?php echo '('.$row['answers'].')--'.$answer.'---'.$last_Id; ?>');
	 window.location='test.php?quizId=<?php echo $quizId;?>&qid=<?php echo $quesId;?>&test_Id=<?php echo $last_Id;?>#QuizStart';
	  </script> 
      <?php 
	   	$html = ob_get_contents();
		ob_end_clean();
		return $html;
   }
   
   function set_answer($answer)
   {
	   ob_start();
	   ?>
       
       <script>
	   
	 	document.getElementById('correctans').value='<?php echo $answer;?>';
	   </script>
       <?php
	   $html = ob_get_contents();
		ob_end_clean();
		return $html;
   }
   
   function questions_opt($questionId)
   {
	  
	   		$sql_fet_opt="select * from ".TBL_QUIZQUESTION." where id='".$questionId."'";
			
			$result_fet_opt= $this->db->query($sql_fet_opt,__FILE__,__LINE__);
			$row_fet_opt= $this->db->fetch_array($result_fet_opt);  
	   ?>
       <input type="hidden" name="correctans" id="correctans" value="" />
        <table width="491" height="76" class="table">
        <tbody>
        
        <tr class="success">
        	<td><label class="radio"><input type="radio" name="ansOptions" value="a" onclick="start_new_quiz.set_answer(this.value,{'preloader':'pr'});"><strong>A</strong><?php echo $row_fet_opt['optiona'];?></label></td>
        	<td><label class="radio"><input type="radio" name="ansOptions" value="b"  onclick="start_new_quiz.set_answer(this.value,{'preloader':'pr'});"><strong>B</strong>  <?php echo $row_fet_opt['optionb'];?></label></td>
        </tr>
        
        <tr class="success">
        	<td><label class="radio"><input type="radio" name="ansOptions" value="c" onclick="start_new_quiz.set_answer(this.value,{'preloader':'pr'});"><strong>C</strong>  <?php echo $row_fet_opt['optionc'];?></label></td>
        	<td><label class="radio"><input type="radio" name="ansOptions" value="d" onclick="start_new_quiz.set_answer(this.value,{'preloader':'pr'});"><strong>D</strong>  <?php echo $row_fet_opt['optiond'];?></label></td>
        </tr>
        
        </tbody>
        </table>
       <?php
   }
   
   
   function Get_Question_from_Id($quesId)
   {
	   
			$sql_fet_ques="select * from ".TBL_QUIZQUESTION." where id='".$quesId."'";
			
			$result_fet_ques= $this->db->query($sql_fet_ques,__FILE__,__LINE__);
			$row_fet_ques= $this->db->fetch_array($result_fet_ques);  
			return $row_fet_ques['question'];
       
   }
   
   
  
				function timeDiff($time1)
				{
				$date1 = time();
				$date2 = strtotime($time1);
				
				$time_difference = $date1 - $date2;
				
				$seconds = $time_difference ;
				$minutes = round($time_difference / 60 );
				$hours = round($time_difference / 3600 );
				$days = round($time_difference / 86400 );
				$weeks = round($time_difference / 604800 );
				$months = round($time_difference / 2419200 );
				$years = round($time_difference / 29030400 );
				
				
				// Seconds
				if($seconds <= 60)
				{
				echo "$seconds seconds ago";
				}
				//Minutes
				else if($minutes <=60)
				{
				
				if($minutes==1)
				{
				echo "one minute ago";
				}
				else
				{
				echo "$minutes minutes ago";
				}
				
				}
				//Hours
				else if($hours <=24)
				{
				
				if($hours==1)
				{
				echo "one hour ago";
				}
				else
				{
				echo "$hours hours ago";
				}
				
				}
				//Days
				else if($days <= 7)
				{
				
				if($days==1)
				{
				echo "one day ago";
				}
				else
				{
				echo "$days days ago";
				}
				
				}
				//Weeks
				else if($weeks <= 4)
				{
				
				if($weeks==1)
				{
				echo "one week ago";
				}
				else
				{
				echo "$weeks weeks ago";
				}
				
				}
				//Months
				else if($months <=12)
				{
				
				if($months==1)
				{
				echo "one month ago";
				}
				else
				{
				echo "$months months ago";
				}
				
				}
				//Years
				else
				{
				
				if($years==1)
				{
				echo "one year ago";
				}
				else
				{
				echo "$years years ago";
				}
				
				}
				} 

  				function set_questionId($quesId)
				{
					$this->Q_Id=$quesId;
				}
				
				function attempted_ques($quiz_Id)
				{
			
			$this->quiz_Id = $quiz_Id;
			
			$sql_fet_ques="select * from ".TBL_QUIZ_POOL." where id='".$this->quiz_PoolID."'";
			$result_fet_ques= $this->db->query($sql_fet_ques,__FILE__,__LINE__);
			$row_fet_ques= $this->db->fetch_array($result_fet_ques);
			
			$ques_array = explode('---',$row_fet_ques['questions']);
			$totalques = count($ques_array)-2;
					?>
                   
			
<div style="width:400px;" class="span2">
											
											<?php
											$i=1;
											for($i=1;$i<=$totalques;$i++)
											{
											?>
	<div style="float:left; width:100px; <?php if($this->Q_Id == $i){ echo ' background-color:#00F;'; } elseif($this->Q_Id>$i) { echo 'background-color:#14A852;';}else { echo 'background-color:#B4231E;'; } ?> border:1px solid #FFF; color:#FFF; font-weight:700; font-size:16px;">Q. <?php echo $i;?></div>
											<?php
											}
											?>
											
										</div>
                    <?php
				}
	
}
?>