<!DOCTYPE html>
<html lang="en">

    <?php include('config/connection.php'); ?>
    
    <?php 
    $initial_limit = 5;
    $url = $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    if(!isset($parts['query'])){
        $query5 = "SELECT * FROM posts LIMIT $initial_limit";
    }
    else {
        parse_str($parts['query'], $query);
        $cat = $query['category'];
        $query5 = "SELECT * FROM posts WHERE category='$cat'";
      
    }
    
    
        
    $result5 = mysqli_query($dbc, $query5);
    $types = array();
    while(($row =  mysqli_fetch_assoc($result5))) {
        $types[] = $row;
    }
    
    
    ?>
    
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UNYT Blog</title>
    

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/clean-blog.min.css" rel="stylesheet">

    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    
</head>

<body>

    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">Web Programming with PHP</a>
                
                <form class="navbar-form navbar-left" action ="search.php" method="GET">     
                <div class="form-group" style="padding-top: 5px">
                <input type="text" name="query" class="form-control" placeholder="Search">

                </div>
               
                </form>
                
            </div>
            
            

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
                        <ul class="dropdown-menu">
           

            <li><a href="index.php?category=trending">Trending</a></li>
            <li><a href="index.php?category=sports">Sports</a></li>
            <li><a href="index.php?category=politics">Politics</a></li>
            <li><a href="index.php?category=finance and business">Finance and Business</a></li>
            <li><a href="index.php?category=wellbeing">Well-being</a></li>
            <li><a href="index.php?category=gossip">Gossip</a></li>
            <li><a href="index.php?category=arts and entertainment">Arts and Entertainment</a></li>
            

          </ul>
        </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="admin/login.php">Log in</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>UNYT Blog</h1>
                        <hr class="small">
                        <span class="subheading">Web Programming in PHP Assignment - Creating a Dynamic Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php foreach($types as $post) : ?>
                <div class="post-preview">
                    <a href="post.php?postid=<?php echo $post['id']; ?>">
                        <input type="hidden" name="submitted" value="<?php echo $post['id']; ?>">
                        <h2 class="post-title">
                            <?php echo $post['title'];?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php echo $post['subtitle'] ; ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#">Kristi Ceca</a> on <?php $date = date_create ($post['time']); echo date_format($date, 'F d, Y'); echo ' at '; echo date_format($date, 'h:i'); ?> | Category: <?php echo $post['category'];?></p>
                </div>
                <hr>
                <?php endforeach; ?>

                <ul class="pager">
                    <li class="next">
                        
                        <?php $test = mysqli_num_rows($result5);?>
                        <a href="pagination.php?pageincrement=<?php echo $test+5;?>">Older Posts &rarr;</a>
  
                       
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/01100I10110101">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.upwork.com/freelancers/~01e44d131bb5b92484">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-desktop fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Kristi Ceca 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <script src="js/clean-blog.min.js"></script>

</body>

</html>
