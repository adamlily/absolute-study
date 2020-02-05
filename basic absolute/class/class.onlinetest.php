<?php

class Manage_post{
	
	 var $user_id;

	 
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
		$this->objMail=new PHPMailer();
	}
	
  function onlineTest($quizpool='',$studentid='')
  {
						
  }
  
  function usdfds()
  {
	?>
	 <div style="width:400px;" class="span2">
											
												
												<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">1</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">2</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">3</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">4</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">5</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">6</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">7</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">8</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">9</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">10</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">11</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">12</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">13</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">14</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">15</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">16</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">17</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">18</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">19</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">20</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">21</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">22</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">23</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">24</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">25</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">26</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">27</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">28</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">29</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">30</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">31</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">32</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">33</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">34</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">35</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">36</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">37</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">38</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">39</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">40</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">41</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">42</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">43</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">44</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">45</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">46</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">47</label></div>
													<div style="float:left; width:100px;"><label class="radio"><input type="radio" name="optionsRadios" value="option1">48</label></div>
												
											
										</div>
   <?php   
  }
	
}
?>