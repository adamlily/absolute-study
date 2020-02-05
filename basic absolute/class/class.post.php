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
	
  function All_Post($pagename='')
  {
	  $newpage_name = $this->clean($pagename);
						$sql_post="select * from ".TBL_PAGE." where page_name='".$pagename."'";
						$sql_post.=" order by id";
		            	$result= $this->db->query($sql_post,__FILE__,__LINE__);
						$result_forcnt= $this->db->num_rows($result);
						?>
                        <section class="kids_bottom_content_container">
                        <div class="header_container">

						<?php if($newpage_name=='Blog')
						{?>
                        <h1>View Blogs</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Blogs</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Painting')
						{?>
                        <h1>View Paintings</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Paintings</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Photography')
						{?>
                        <h1>View Photography</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Photography</li>
						</ul>
                         <?php
						}
						?>
                         <?php if($newpage_name=='Gardening')
						{?>
                        <h1>View Gardening</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Gardening</li>
						</ul>
                         <?php
						}
						?>
                         <?php if($newpage_name=='Summer Vacation')
						{?>
                        <h1>View Summer Vacation</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Summer Vacation</li>
						</ul>
                        <?php
						}
						?>
                         <?php if($newpage_name=='Diwali Holidays')
						{?>
                        <h1>View Diwali Holidays</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Diwali Holidays</li>
						</ul>
                        <?php
						}
						?>
                         <?php if($newpage_name=='Holi Holidays')
						{?>
                        <h1>Holi Holidays</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Holi Holidays</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Sunday Competitions')
						{?>
                        <h1>Sunday Competitions</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Sunday Competitions</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Personality Development')
						{?>
                        <h1>Personality Development</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Personality Development</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Aptitude Development')
						{?>
                        <h1>Aptitude Development</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Aptitude Development</li>
						</ul>
                        <?php
						}
						?>
                         <?php if($newpage_name=='Interest Development')
						{?>
                        <h1>Interest Development</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Interest Development</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Elementry')
						{?>
                        <h1>Elementry</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Elementry</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Middle school')
						{?>
                        <h1>Middle school</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Middle school</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Hero Carousel')
						{?>
                        <h1>Hero Carousel</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Hero Carousel</li>
						</ul>
                        <?php
						}
						?>
                        </div>
						
						<div class="entry-container" id="sbr">

						<div id="post-content" class="blog">
						<?php
						if($result_forcnt>0)
						{
							$row_post = $this->db->fetch_array($result);
							?>
                             <article class="post-item">
                                <div class="post-meta">
                                    <div class="post-date">
                                        <span class="day"><?php echo date('d', strtotime($row_post['timestamp']));?></span>
                                        <span class="month"><?php echo date('M', strtotime($row_post['timestamp']));?>.<?php echo date('Y', strtotime($row_post['timestamp']));?></span>										
                                    </div><!--/ post-date-->
                                    
                                </div><!--/ post-meta-->
                        
                                <div class="post-entry clearfix">
                        
                                    <div class="post-title">
                                        <h1><?php echo $row_post['heading']?></h1>
                                    </div><!--/ post-title-->
                        <?php
						$sql_post_img="select * from ".TBL_PAGE_IMAGE." where page_id='".$row_post['id']."' order by timestamp desc";
		$result_post_img= $this->db->query($sql_post_img,__FILE__,__LINE__);
		$row_pos_img= $this->db->fetch_array($result_post_img);
						?>
                                    <div class="border-shadow alignleft">
                                        <figure>
                                        <?php
                                        if($row_pos_img['image']=='')
							{
								?>
                                 <a class="prettyPhoto kids_picture" href="images/dummy.jpg" title="<?php echo substr(strip_tags($row_post['heading'],''),0,25);?>...">
                        <img src="images/dummy.jpg" class="pic" style="max-width:200px; max-height:200px;" /></a>
                                <?php
							}
							else
							{
								?>
                                 <a class="prettyPhoto kids_picture" href="../gallery/<?php echo $row_pos_img['image']?>" title="<?php echo substr(strip_tags($row_post['heading'],''),0,25);?>...">
                        <img src="../gallery/<?php echo $row_pos_img['image']?>" class="pic" style="max-width:200px; max-height:200px;" /></a>
                                <?php
							}
                                        ?>
                                          
                                        </figure>
                                    </div><!--/ post-thumb-->
                        
                                    <div class="entry">
                                    <p><?php echo $row_post['content'];?></p>
                                       <br>
                                    </div><!--/ entry--> 
                        </div><!--/ post-entry -->
                      </article>
                       <?php 
						}
						
						$sql_childpost="select * from ".TBL_PAGE." where parent_id='".$row_post['id']."'";
						$sql_childpost.="order by timestamp desc";
		            	$result_childpost= $this->db->query($sql_childpost,__FILE__,__LINE__);
						$result_child_forcnt= $this->db->num_rows($result_childpost);
						if($result_child_forcnt>0)
						{
							?>  <h2>Related Post</h2>
							<?php
							while($row_childpost = $this->db->fetch_array($result_childpost))
							{
							?>
                
                  <article class="post-item">
                                <div class="post-meta">
                                    <div class="post-date">
                                        <span class="day"><?php echo date('d', strtotime($row_childpost['timestamp']));?></span>
                                        <span class="month"><?php echo date('M', strtotime($row_childpost['timestamp']));?>.<?php echo date('Y', strtotime($row_childpost['timestamp']));?></span>								 </div>
                                </div>
                         <div class="post-entry clearfix">
                        		<div class="post-title">
                                        <a href="<?php echo $row_childpost['page_type']?>?pagename=<?php echo $row_childpost['page_name']?>"> <h1 style="margin-bottom:1px! important;"><?php echo $row_childpost['heading']?></h1></a>
                                    </div>
                      
                                    <div class="border alignleft">
                                    <div class="entry">
                                    <p style="margin:0 0 0.5em! important;"><?php echo substr(strip_tags($row_childpost['content'],''),0,190);?> ...</p>
                                    <div style="width:120px;" align="left">
                                    <footer class="aligncenter">
                    <a href="<?php echo $row_childpost['page_type']?>?pagename=<?php echo $row_childpost['page_name']?>" class="button button-centering medium button-style1">More</a>
              					 	</footer>
                                    </div>
                                    </div>
                        </div>
                      </article>
                      <?php
							}
						}
						?>
                  
                  
                  
                  
            </div>
            <?php $this->asideContainer(); ?>
            <div class="kids_clear"></div> 
			</div>
				</section>
			<?php 		
			
  }
  
  function AllpageFullWidth($pagename='')
  {
						  $newpage_name = $this->clean($pagename);
						$sql_post="select * from ".TBL_PAGE." where page_name='".$pagename."'";
						$sql_post.=" order by id";
		            	$result= $this->db->query($sql_post,__FILE__,__LINE__);
						$result_forcnt= $this->db->num_rows($result);
						?>
                        <section class="kids_bottom_content_container">
                        <div class="header_container">

						<?php if($newpage_name=='Blog')
						{?>
                        <h1>View Blogs</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Blogs</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Painting')
						{?>
                        <h1>View Paintings</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Paintings</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Photography')
						{?>
                        <h1>View Photography</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Photography</li>
						</ul>
                         <?php
						}
						?>
                         <?php if($newpage_name=='Gardening')
						{?>
                        <h1>View Gardening</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Gardening</li>
						</ul>
                         <?php
						}
						?>
                         <?php if($newpage_name=='Summer Vacation')
						{?>
                        <h1>View Summer Vacation</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Summer Vacation</li>
						</ul>
                        <?php
						}
						?>
                         <?php if($newpage_name=='Diwali Holidays')
						{?>
                        <h1>View Diwali Holidays</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Diwali Holidays</li>
						</ul>
                        <?php
						}
						?>
                         <?php if($newpage_name=='Holi Holidays')
						{?>
                        <h1>Holi Holidays</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Holi Holidays</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Sunday Competitions')
						{?>
                        <h1>Sunday Competitions</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Sunday Competitions</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Personality Development')
						{?>
                        <h1>Personality Development</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Personality Development</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Aptitude Development')
						{?>
                        <h1>Aptitude Development</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Aptitude Development</li>
						</ul>
                        <?php
						}
						?>
                         <?php if($newpage_name=='Interest Development')
						{?>
                        <h1>Interest Development</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Interest Development</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Elementry')
						{?>
                        <h1>Elementry</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Elementry</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Middle school')
						{?>
                        <h1>Middle school</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Middle school</li>
						</ul>
                        <?php
						}
						?>
                        <?php if($newpage_name=='Hero Carousel')
						{?>
                        <h1>Hero Carousel</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View Hero Carousel</li>
						</ul>
                        <?php
						}
						?>
                        </div>
						
						<div class="entry-container" id="">

						<div id="post-content" class="blog">
						<?php
						if($result_forcnt>0)
						{
							$row_post = $this->db->fetch_array($result);
						 ?>
                            
                            <div class="">
                            <!-- ***************** - START Image floating - *************** -->
                            
                            <h1><a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo $row_post['heading']?></a></h1>
                            <?php
                            $sql_post_img="select * from ".TBL_PAGE_IMAGE." where page_id='".$row_post['id']."' order by timestamp desc";
                            $result_post_img= $this->db->query($sql_post_img,__FILE__,__LINE__);
                            $row_pos_img= $this->db->fetch_array($result_post_img);
                            ?>
                            <div class="border-shadow alignleft">
                            <figure>
                            <?php
                                        if($row_pos_img['image']=='')
							{
								?>
                                 <a class="prettyPhoto kids_picture" href="images/dummy.jpg" title="<?php echo substr(strip_tags($row_post['heading'],''),0,25);?>...">
                        <img src="images/dummy.jpg" class="pic" style="max-width:200px; max-height:200px;" /></a>
                                <?php
							}
							else
							{
								?>
                                 <a class="prettyPhoto kids_picture" href="../gallery/<?php echo $row_pos_img['image']?>" title="<?php echo substr(strip_tags($row_post['heading'],''),0,25);?>...">
                        <img src="../gallery/<?php echo $row_pos_img['image']?>" class="pic" style="max-width:200px; max-height:200px;" /></a>
                                <?php
							}
                                        ?>
                            </figure>
                            </div>
                            
                                                <p><?php echo $row_post['content'];?>
                                                
                                                </p>
                                               
                            <div class="kids_clear"></div>                                
                            </div>
                            
                            
                            <?php 
						}
						
						$sql_childpost="select * from ".TBL_PAGE." where parent_id='".$row_post['id']."'";
						$sql_childpost.="order by timestamp desc";
		            	$result_childpost= $this->db->query($sql_childpost,__FILE__,__LINE__);
						$result_child_forcnt= $this->db->num_rows($result_childpost);
						if($result_child_forcnt>0)
						{
							
							?>
                             <div class="entry-container" id="sbr">

						<div id="post-content" class="blog"> <h2>Related Post</h2>
							<?php
							while($row_childpost = $this->db->fetch_array($result_childpost))
							{
							?>
                
                  <article class="post-item" style="width:790px! important;">
                                <div class="post-meta">
                                    <div class="post-date">
                                        <span class="day"><?php echo date('d', strtotime($row_childpost['timestamp']));?></span>
                                        <span class="month"><?php echo date('M', strtotime($row_childpost['timestamp']));?>.<?php echo date('Y', strtotime($row_childpost['timestamp']));?></span>								 </div>
                                </div>
                         <div class="post-entry clearfix">
                        		<div class="post-title">
                                        <a href="<?php echo $row_childpost['page_type']?>?pagename=<?php echo $row_childpost['page_name']?>"> <h1 style="margin-bottom:1px! important;"><?php echo $row_childpost['heading']?></h1></a>
                                    </div>
                      
                                    <div class="border alignleft">
                                    <div class="entry">
                                    <p style="margin:0 0 0.5em! important;"><?php echo substr(strip_tags($row_childpost['content'],''),0,190);?> ...</p>
                                    <div style="width:120px;" align="left">
                                    <footer class="aligncenter">
                    <a href="<?php echo $row_childpost['page_type']?>?pagename=<?php echo $row_childpost['page_name']?>" class="button button-centering medium button-style1">More</a>
              					 	</footer>
                                    </div>
                                    </div>
                        </div>
                      </article>
                      <?php
							}
							?>
                            </div>
                    </div>
                            <?php
						}
						?>
					
                    
            
            </div><!--/ post-content-->
           </div><!-- .gallery_container -->

				</section><!-- .bottom_content_container -->
                
                <div class="kids_clear"></div> 
			<?php 		
			
  }
         
  function asideContainer()
  {
	?>  
	<aside id="sidebar">
    <?php $this->featurednews();?>
    </aside>
    <?php 
  }
  
 	function featurednews()
	{
		
		?>
        <div class="latest-posts-widget type-2 widget">

		<h3>Featured News</h3>

		<ul>
		<?php
	
			$sql_news="select * from ".TBL_POST." order by timestamp desc limit 1,3";
			$result_news= $this->db->query($sql_news,__FILE__,__LINE__);
			while($row_news= $this->db->fetch_array($result_news))
			{
				?>
                    <li>
                        <div class="entry">
                            <div class="kids_image_wrapper kids_mini_audio">
                             <?php
                                        if($row_news['image_path']=='')
							{
								?>
                                  <a class="prettyPhoto" href="images/dummy.jpg" 
                                title="<?php echo $row_news['heading']?>"><img 
                                alt="<?php echo $row_news['heading']?>" src="images/dummy.jpg" style="width:200px;" title="<?php echo $row_news['heading']?>" /></a>
                               
                                <?php
							}
							else
							{
								?>
                                 <a class="prettyPhoto" href="../gallery/<?php echo $row_news['image_path']?>" 
                                title="<?php echo $row_news['heading']?>"><img 
                                alt="<?php echo $row_news['heading']?>" src="gallery/<?php echo $row_news['image_path']?>" style="width:200px;" title="<?php echo $row_news['heading']?>" /></a>
                                <?php
							}
                                        ?>
                                        
                                        
                              
                            </div><!--/ kids_image_wrapper-->
                            <div class="excerpt">
                                <strong><a href="news.php?nwId=<?php echo $row_news['id']?>"><?php echo $row_news['heading']?></a></strong>
                                <span class="recent-posts-date">Posted: <?php echo date('F d, Y', strtotime($row_news['timestamp']));?></span>
                            </div><!--/ excerpt-->	
                        </div><!--/ entry-->
                    </li>
					<?php
			}
			?>
            </ul>

			</div>
            <?php 

	}
	
	 
  /*function Single_Post($post_Id)
  {
		$sql_post="select * from ".TBL_POST." where id='".$post_Id."'";
		$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
		$row_post= $this->db->fetch_array($result_post);
	  ?>
        <div id="post-content">
        
        <article class="item-post">
        
            <div class="post-title">
                <h1><?php echo $row_post['heading']?></h1>
            </div><!--/ post-title-->
        
            <div class="metadata">
                <div class="post-date"><?php echo date('F', strtotime($row_post['timestamp']));?> <?php echo date('d', strtotime($row_post['timestamp']));?>, <?php echo date('Y', strtotime($row_post['timestamp']));?></div><!--/ post-date-->
                <div class="metaholder">
                    <span>by admin </span>
                </div><!--/ metaholder-->
            </div><!--/ metadata-->
        
            <div class="post-entry">
        
                <div class="border-shadow alignleft">
                    <figure>
                        <a class="prettyPhoto" href="../gallery/<?php echo $row_post['image_path']?>">
                            <img src="../gallery/<?php echo $row_post['image_path']?>" alt="" />
                        </a>											
                    </figure>
                </div><!--/ gallery-image-->
        
                <div class="entry">
                    <p>
                       <?php echo $row_post['description']?>
                    </p>
                    
                    <div style="margin-bottom:5px;">
                            <?php
                          $sql_post1="select * from ".TBL_BLOGIMAGE." where blog_id='".$post_Id."'";
						$result_post1= $this->db->query($sql_post1,__FILE__,__LINE__);
						while($row_post1= $this->db->fetch_array($result_post1))
						{
							?>
                            <div class="border-shadow alignleft">
                                <figure>
                                    <a class="prettyPhoto" href="../gallery/<?php echo $row_post1['image_path']?>">
                                        <img src="../gallery/<?php echo $row_post1['image_path']?>" alt="" />
                                    </a>											
                                </figure>
                            </div>
                            <?php
						}
						?>
                   </div>
                </div><!--/ entry-->   
        
            </div><!--/ post-entry -->
        
        </article><!--/ item-post-->
        
        <!--/ respond -->
        
        </div>

      <?php
  }*/
  

 /* function aboutpage($categoryname,$subcategoryname)
  {
	  		$sql_post="select * from ".TBL_POST." where category='".$categoryname."' and subcategory='".$subcategoryname."'";
						$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
						$row_post= $this->db->fetch_array($result_post);
	  ?>
                            <section id="blog">
                            <div class="blog blog-page">
                            <div class="page-header">
                            <h1><?php echo $row_post['heading']?></h1>
                            </div>
                           
                            <div class="body">
                            <div class="row-fluid">
                            <div class="span12">
                            <figure>
                            <img alt="" src="gallery/<?php echo $row_post['image_path']?>" style="width:791px; height:300px;">
                            
                            </figure>
                            </div>
                            
                            <p align="justify"><?php echo $row_post['description']?></p>
                           
                            </div>
                            
                            
                            <hr class="dotted">
                            
                            </div>
                            </div>
                            </section>
      <?php
  }*/
  
	 function clean($string) {
		   $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
		   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
		} 
  
			
	
	
	
	
	
	
	function singleNews($news_id)
	{
		$sql_post="select * from ".TBL_POST." where id='".$news_id."'";
		$result= $this->db->query($sql_post,__FILE__,__LINE__);
		$row_post= $this->db->fetch_array($result)
		?>
        <div class="">
                            <!-- ***************** - START Image floating - *************** -->
                            <div style="width:120px;" align="right">
                                    <footer class="aligncenter">
                    <a href="news.php" class="button button-centering medium button-style1">All News</a>
              					 	</footer>
                                    </div>
                            <h1><?php echo $row_post['heading']?></h1>
                             
                            <div class="border-shadow alignleft">
                            <figure>
                            <?php
                                        if($row_post['image_path']=='')
							{
								?>
                                 <a class="prettyPhoto kids_picture" href="images/dummy.jpg" title="<?php echo substr(strip_tags($row_post['heading'],''),0,15);?>...">
                        <img src="images/dummy.jpg" class="pic" style="max-width:200px; max-height:200px;" /></a>
                                <?php
							}
							else
							{
								?>
                                 <a class="prettyPhoto kids_picture" href="../gallery/<?php echo $row_post['image_path']?>" title="<?php echo substr(strip_tags($row_post['heading'],''),0,15);?>...">
                        <img src="../gallery/<?php echo $row_post['image_path']?>" class="pic" style="max-width:200px; max-height:200px;" /></a>
                                <?php
							}
                                        ?>
                            </figure>
                            </div>
                            
                                                <p align="justify"><?php echo $row_post['description'];?>
                                                
                                                </p>
                                               
                            <div class="kids_clear"></div>                                
                            </div>
                            
                            
                            
     
         <?php
	}
	
	 function AllNews()
  {
	 ?>
                        <section class="kids_bottom_content_container">
                        <div class="header_container">
                        <h1>View All News</h1>
						<ul id="breadcrumbs">
							<li> <a href="index.php">Home</a> </li>
							<li>View News</li>
						</ul>
                        </div>
						
						<div class="entry-container" id="sbr">

						<div id="post-content" class="blog">
                
					<?php
						 $sql_news="select * from ".TBL_POST." order by timestamp desc";
						$sql_childpost.="order by timestamp desc";
		            	$result_news= $this->db->query($sql_news,__FILE__,__LINE__);
						$result_cnt= $this->db->num_rows($result_news);
						if($result_cnt>0)
						{
							?> 
							<?php
							while($row_news= $this->db->fetch_array($result_news))
							{
							?>
                
                  <article class="post-item">
                                <div class="post-meta">
                                    <div class="post-date">
                                        <span class="day"><?php echo date('d', strtotime($row_news['timestamp']));?></span>
                                        <span class="month"><?php echo date('M', strtotime($row_news['timestamp']));?>.<?php echo date('Y', strtotime($row_news['timestamp']));?></span>								 </div>
                                </div>
                         <div class="post-entry clearfix">
                        		<div class="post-title">
                                        <a href="news.php?nwId=<?php echo $row_news['id']?>"> <h1 style="margin-bottom:1px! important;"><?php echo $row_news['heading']?></h1></a>
                                    </div>
                      
                                    <div class="border alignleft">
                                    <div class="entry">
                                    <p style="margin:0 0 0.5em! important;"><?php echo substr(strip_tags($row_news['description'],''),0,250);?> ...</p>
                                    <div style="width:120px;" align="left">
                                    <footer class="aligncenter">
                    <a href="news.php?nwId=<?php echo $row_news['id']?>" class="button button-centering medium button-style1">More</a>
              					 	</footer>
                                    </div>
                                    </div>
                        </div>
                      </article>
                      <?php
							}
						}
						?>
                  </div>
            <?php $this->asideContainer(); ?>
            <div class="kids_clear"></div> 
			</div>
				</section>
			<?php 		
			
  }
	
}
?>