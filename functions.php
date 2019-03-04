<?php
ini_set('display_errors', 'On');
  
$website_name = 'Tucker Tavarone, Resume';
$author = 'Tucker Tavarone';

$pages = array ('index.php' => 'Home',
                'resume.php' => 'Resume',
                'courses.php' => 'Courses',
                'projects.php' => 'Projects');

$proj_cards = array ('ttr.txt' => 'Ticket To Ride',
                     'lm.txt' => 'Lazer Maze',
                     'thisproj.txt' => 'This Project');

  function make_page($page_name, $page_content, $add_content = null, $style = null, $javascript = null) {

    global $pages;
    global $author;
    global $proj_cards;
    $cards = null;

    $navbar = make_navbar();
    $footer = make_footer();
    $page_content = file_get_contents($page_content);
    
    if($style && $javascript) {
      $style = file_get_contents($style);
      $javascript = file_get_contents($javascript);

      echo '
        <!DOCTYPE html>
        <html lang="en">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <head>
          <title>Tucker Tavarone | '.$page_name.'</title>
          <style type="text/css">
            '.$style.'
          </style>
        </head>
        <body>

          <!-- website header -->
          <header style="background-color: #05386b">
            '.$navbar.'
          </header>

          <!--  main content container   -->	
          <main class="container">
            '.$page_content.'
          </main><!-- /main container -->
    	
    	
        	<!-- website footer   -->
        	<footer>
            '.$footer.'
        	</footer>

  	
        	<!-- javascript -->
          <script>'.$javascript.'</script>
        	<script src="js/jquery.min.js"></script>
        	<script src="js/popper.min.js"></script>
        	<script src="js/bootstrap.min.js"></script>

        </body>
        </html>';
      }
      else if ($add_content || ($page_name == 'Projects')) {
        
        $courses = make_courses();

          if($page_name == 'Projects') {
            foreach ($proj_cards as $proj_file => $proj_name) {
              if($proj_name == 'This Project') {
                $cards .= make_card($proj_name, file_get_contents(__DIR__ . '/assets/'.$proj_file.''), 'https://github.com/ttavarone', False, 'Github' );
              }
              else {
                $cards .= make_card($proj_name, file_get_contents(__DIR__ . '/assets/'.$proj_file.''), '/assets/'.$proj_file.'.zip', True, 'Download' );
              }
            }
            $courses = null;
          }

        echo '
          <!DOCTYPE html>
          <html lang="en">
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="css/bootstrap.min.css">
          <link rel="stylesheet" href="css/custom.css">
          <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
          <head>
          <title>Tucker Tavarone | '.$page_name.'</title>
          </head>
          <body>

            <!-- website header -->
            <header style="background-color: #05386b">
              '.$navbar.'
            </header>

            <!--  main content container   -->  
            <main class="container">
              '.$page_content.'
              '.$cards.'
              '.$courses.'
            </main><!-- /main container -->
        
        
            <!-- website footer   -->
            <footer>
              '.$footer.'
            </footer>

      
            <!-- javascript -->
            <script src="js/jquery.min.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>

          </body>
          </html>';
      }
      else {
        echo '
          <!DOCTYPE html>
          <html lang="en">
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="css/bootstrap.min.css">
          <link rel="stylesheet" href="css/custom.css">
          <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
          <head>
          <title>Tucker Tavarone | '.$page_name.'</title>
          </head>
          <body>

            <!-- website header -->
            <header style="background-color: #05386b">
              '.$navbar.'
            </header>

            <!--  main content container   -->  
            <main class="container">
              '.$page_content.'
            </main><!-- /main container -->
        
        
            <!-- website footer   -->
            <footer>
              '.$footer.'
            </footer>

      
            <!-- javascript -->
            <script src="js/jquery.min.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>

          </body>
          </html>';
      }
}

function make_navbar() {
  global $pages;
  
  $menu_item = '';
  
  foreach ($pages as $link => $name) {
    $menu_item .= '<a class="nav-link active" href="'.$link.'" style="color: #edf5e1">'.$name.'</a>';
  }
  
  return '
          <!-- website navbar -->
          <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #05386b">
            <a class="navbar-brand" href="index.html" style="color: #edf5e1">Tucker Tavarone</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" 
                          aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon" style="background-color: #05386b"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainnav">
              <div class="navbar-nav" >
                '.$menu_item.'
              </div>
            </div>
          </nav>';
  }

  function make_footer() {
    global $pages;
    global $author;

    $menu_item = '';

    foreach ( $pages as $link => $name) {
      $menu_item .= '<a href="'.$link.'" style="color: #05386b">'.$name.'</a>';
    }

    return '
    &copy; 2019 '.$author.'
      <nav>
        '.$menu_item.'
      </nav>';
  }

  function make_courses() {

    $file = file('courses.csv');

    foreach ($file as $line) {
      
      $arr = explode(',', $line);      
      /* This creates an array called record
        Where the course title is the array index
        $arr[0] is the year
        $arr[1] is the semester
        $arr[2] is the course number, i.e., CSIS-110 */
        
      $record[$arr[2]] = array($arr[1], $arr[0]);
    }

    ksort($record);

    $course_table = '<table>';
      foreach ($record as $id => $details) {
      $course_table .= '<tr><th>'.$id.'</th>';
          foreach ($details as $value) {
            $course_table .= '<td>'.$value.'</td>';
          }
        $course_table .= '</tr>';
      }  
    $course_table .= '</table>';

    return $course_table;
  }

  function make_card($project_name, $content, $link = null, $downloadable = null, $link_name = null){
    if($downloadable){
      return '
        <div class="row"
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">'.$project_name.'</h5>
                <p class="card-text">
                  '.$content.'
                </p>
                <a class="btn btn-primary btn-lg active" role="button" aria-pressed="true" href="'.$link.'" style="margin-left: 2%; background-color: #05386b; font-size: 100%;" download>Download</a>
              </div>
            </div>
          </div>
        </div>
        ';
    }
    else {
      return '
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">'.$project_name.'</h5>
                <p class="card-text">
                  '.$content.'
                </p>
                <a class="btn btn-primary btn-lg active" role="button" aria-pressed="true" href="'.$link.'" style="margin-left: 2%; background-color: #05386b; font-size: 100%;">'.$link_name.'</a>
              </div>
            </div>
          </div>
        ';
    }
  }
?>