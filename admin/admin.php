<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=y1zrpui7kjm6v9yilj0c750ubcc6wesfk6boldhd5tylao8r"></script>

 <script>
  tinymce.init({
    
    selector: '#body',
    toolbar: [
    'undo redo | styleselect | bold italic | link image',
    'alignleft aligncenter alignright'
  ],
  plugins: [
  'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
  'save table contextmenu directionality emoticons template paste textcolor'
]
  
  });
  </script>
  
<?php include('config/css.php'); ?>
	
<?php include('config/js.php'); ?>

<?php include ('../config/connection.php'); ?>

 <?php
        $url = $_SERVER['REQUEST_URI'];
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        $id = $query['pageid'];
       
        
        $editquery = "SELECT * FROM posts WHERE id = $id";
        $reditquery = mysqli_query($dbc, $editquery);
        
        $editarray = mysqli_fetch_array($reditquery);
        ?>

<?php 
 if (isset($_POST['submitted'])) {
     $p_title = mysqli_real_escape_string($dbc, $_POST['title']);
        $p_subtitle = mysqli_real_escape_string($dbc, $_POST['subtitle']);
        $p_cat = mysqli_real_escape_string($dbc, $_POST['category']);
        $p_header = mysqli_real_escape_string($dbc, $_POST['header']);
        $p_body = mysqli_real_escape_string($dbc, $_POST['body']);
        
        $q = "INSERT INTO posts (title, subtitle, category, header, body, time) VALUES ('$p_title', '$p_subtitle', '$p_cat', '$p_header', '$p_body', now() )"; 
        mysqli_query($dbc, $q);
        
        $show_alert = true;
        $alert_message = "Post has been successfully created!";
   
    
   }
    if(isset($_POST['deleted']))
    {
        $deletequery =  "DELETE FROM `posts` WHERE `posts`.`id` = $id";
        $delete_result = mysqli_query($dbc, $deletequery);
        $show_alert = true;
        $alert_message = "Post has been successfully deleted!";
         
    }
    
    if(isset($_POST['updated']))
        {
        $p_title = mysqli_real_escape_string($dbc, $_POST['title']);
        $p_subtitle = mysqli_real_escape_string($dbc, $_POST['subtitle']);
        $p_cat = mysqli_real_escape_string($dbc, $_POST['category']);
        $p_header = mysqli_real_escape_string($dbc, $_POST['header']);
        $p_body = mysqli_real_escape_string($dbc, $_POST['body']);
        
        $updatequery =  "UPDATE posts SET title = '$p_title', subtitle = '$p_subtitle', category = '$p_cat', header = '$p_header', body = '$p_body', time = now() WHERE `posts`.`id` = $id";
        $update_result = mysqli_query($dbc, $updatequery);
        
        $show_alert = true;
        $alert_message = "Post has been successfully updated!";
         
    }
     
?>
<?php 
$q = "SELECT * FROM posts";
$r = mysqli_query($dbc, $q);
$post = array();
    while(($row =  mysqli_fetch_assoc($r))) {
        $post[] = $row;
    }
 
?>




<nav class="navbar navbar-default" role="navigation">
	

	
	
		
		<ul class="nav navbar-nav">

			
                        <li><a href="../">Home</a></li>
			
					
		</ul>
		
		<div class="pull-right">
			<ul class="nav navbar-nav">
	
				
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Kristi Ceca<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</li>

			</ul>
		</div>

	
</nav>
<?php if(isset($show_alert) && $show_alert): ?>
<div class='alert alert-success fade in alert-dismissable' style="height: 50px; margin: 12px;">
    <i class="fa fa-check"></i>
    <?php echo $alert_message; ?>
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
<?php endif; ?>
<h1 align="center" style="font-weight: bold; display: block;">Page Manager</h1>



<div class="row" style='margin: 0'>
    
    

	
	<div class="col-md-3">

		<div class="list-group">
                    
			
                    <a class="list-group-item" href="admin.php?pageid=0"><i class="fa fa-plus"></i> New Page</a>
                    
                    <?php foreach($post as $title) : ?>

                    <a class="list-group-item" href="?pageid=<?php echo $title['id'];?>"> <strong><?php echo $title['title'];?> </strong></a>
                    
                    
                    <?php endforeach; ?>

                
                
                            
                        
                
				
				
		
		
		</div>
		
	</div>
	
	<div class="col-md-9">

       
        
		
		<form action="" method="post" role="form" style="padding-right: 45px;">
			
			
			<div class="form-group">
				
				<label for="title">Title:</label>
				<input class="form-control" type="text" name="title" id="title" value="<?php echo $editarray['title'];?>" placeholder="Page Title">
				
			</div>
                    
                         <div class="form-group">
				
				<label for="label">Subtitle:</label>
				<input class="form-control" type="text" name="subtitle" id="subtitle" value="<?php echo $editarray['subtitle'];?>" placeholder="Page Subtitle">
				
			</div>

			<div class="form-group">
				
				<label for="user">User:</label>
				<select class="form-control" name="user" id="user">
					
					<option value="0">No user</option>
                                        <option value="">Kristi Ceca</option>
					
						
					
				</select>
				
			</div>
                    
                        <div class="form-group">
				
				<label for="user">Category:</label>
				<select class="form-control" name="category" id="category">
					
                                        <option value="trending">Trending</option>
					<option value="sports">Sports</option>
                                        <option value="wellbeing">Wellbeing</option>
                                        <option value="politics">Politics</option>
                                        <option value="gossip">Gossip</option>
                                        <option value="finance and business">Finance and Business</option>
                                        <option value="arts and entertainment">Arts and Entertainment</option>
					
						
					
				</select>
				
			</div>

			
			
			
			<div class="form-group">
				
				<label for="header">Header:</label>
				<input class="form-control" type="text" name="header" id="header" value="<?php echo $editarray['header'];?>" placeholder="Page Header">
				
			</div>										

			<div class="form-group">
				
				<label for="body">Body:</label>
				<textarea class="form-control editor" name="body" id="body" rows="8" placeholder="Page Body"><?php echo $editarray['body'];?></textarea>
				
			</div>
			
                    
                    <input type="submit" class="btn btn-default" name="submitted" value="Save">
                    <input type="submit" class="btn btn-default" name="deleted" value="Delete">
                    <input type="submit" class="btn btn-default" name="updated" value="Update">
			
                               
			
			
		</form>
		
            
	</div>
		
</div>
                        


