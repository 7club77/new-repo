<html>
<head>
<link rel="stylesheet" href="an/bootstrap/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="an/bootstrap/js/ui-bootstrap.min.js"></script>
<script src="an/bootstrap/js/ui-bootstrap-tpls.min.js"> </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css" />
<script src="an/scripts/qazy.min.js"> </script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

<script> var qazy_image = "an/image/download.gif";  </script>

<script type="text/javascript">
function openlink() {
    window.open("aparat.html","_self")

  }
</script>
</head>
<?php
if(!isset($_POST['Link'])){

  echo 'Somthing Error';
}


//echo '<pre>' . print_r($jsonv, true) . '</pre>';
$Link = $_POST['Link'];
$date= date("Y/m/d");   
$time= date("h:i:sa");
$des = $_SERVER['HTTP_USER_AGENT'];
$servername = "localhost";
$username = "root";
$password = "586947";
$dbname = "aparat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO video (link, date11, time, des)
VALUES ('$Link', '$date','$time', '$des')";


mysqli_query($conn, $sql);
    

if (isset($_GET['hash'])){


$Link = $_GET['hash'];

$p = parse_url ($Link) ;

  $d2 = substr ( $p['path'] , 2 ) ;

$path_with_query=$d2;
$path=explode("/",$path_with_query);
$filename=basename($path[0]);
$query=$path[1];


//videooffact............

$videooffact = file_get_contents("http://www.aparat.com/etc/api/videooffact/videohash/$query");
$json = json_decode($videooffact, true);


$item = $json['videooffact'];


function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

//video.......

$video = file_get_contents("http://www.aparat.com/etc/api/video/videohash/$query");
$jsonv = json_decode($video, true);

$item1 = $jsonv['video'];

//videorecom


$videorecom = file_get_contents("http://www.aparat.com/etc/api/videorecom/videohash/$query");
$jsonvo = json_decode($videorecom, true);

$item2 = $jsonvo['videorecom'];


}

else {

$Link = $_POST['Link'];


	$p = parse_url ($Link) ;

  $d2 = substr ( $p['path'] , 2 ) ;

$path_with_query=$d2;
$path=explode("/",$path_with_query);
$filename=basename($path[0]);
$query=$path[1];


//videooffact............

$videooffact = file_get_contents("http://www.aparat.com/etc/api/videooffact/videohash/$query");
$json = json_decode($videooffact, true);


$item = $json['videooffact'];


function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

//video.......

$video = file_get_contents("http://www.aparat.com/etc/api/video/videohash/$query");
$jsonv = json_decode($video, true);

$item1 = $jsonv['video'];

//videorecom


$videorecom = file_get_contents("http://www.aparat.com/etc/api/videorecom/videohash/$query/perpage/10");
$jsonvo = json_decode($videorecom, true);

$item2 = $jsonvo['videorecom'];



}



?>



<body>
<div class="container">

<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#" onclick="openlink()">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Download</h1>
      
<pre>

<label for="VideoUrl">Title:</label>
<strong><?php echo $item1['title']; ?></strong>

<label for="VideoUrl">Image:</label>
<img src="<?php echo $item1['small_poster']; ?>" alt="test" class="img-rounded">

</pre>

<label for="VideoUrl">144p:</label>
<pre>
<a class="btn btn-success" href="<?php echo $item['stream']['0']['src']['0']; ?>">Download Server1</a></br>
<a class="btn btn-success" href="<?php echo $item['stream']['0']['src']['1']; ?>">Download Server2</a></br>
<p>Size: <?php echo formatBytes($item['stream']['0']['size']); ?></p>
</pre>
</br>
<label for="VideoUrl">240p:</label>
<pre>
<a class="btn btn-success" href="<?php echo $item['stream']['1']['src']['0']; ?>">Download Server1</a></br>
<a class="btn btn-success" href="<?php echo $item['stream']['1']['src']['1']; ?>">Download Server2</a></br>
<p>Size: <?php echo formatBytes($item['stream']['1']['size']); ?></p>
</pre>
</br>
<label for="VideoUrl">360p:</label>
<pre>
<a class="btn btn-success" href="<?php echo $item['stream']['2']['src']['0']; ?>">Download Server1</a></br>
<a class="btn btn-success" href="<?php echo $item['stream']['2']['src']['1']; ?>">Download Server2</a></br>
<p>Size: <?php echo formatBytes($item['stream']['2']['size']); ?></p>
</pre>
</br>
<label for="VideoUrl">480p:</label>
<pre>
<a class="btn btn-success" href="<?php echo $item['stream']['3']['src']['0']; ?>">Download Server1</a></br>
<a class="btn btn-success" href="<?php echo $item['stream']['3']['src']['1']; ?>">Download Server2</a></br>
<p>Size: <?php echo formatBytes($item['stream']['3']['size']); ?></p>
</pre>
</br>
<label for="VideoUrl">720p:</label>
<pre>
<a class="btn btn-success" href="<?php echo $item['stream']['4']['src']['0']; ?>">Download Server1</a></br>
<a class="btn btn-success" href="<?php echo $item['stream']['4']['src']['1']; ?>">Download Server2</a></br>
<p>Size: <?php echo formatBytes($item['stream']['4']['size']); ?></p>
</pre>
</br>
<label for="VideoUrl">1080p:</label>
<pre>
<a class="btn btn-success" href="<?php echo $item['stream']['5']['src']['0']; ?>">Download Server1</a></br>
<a class="btn btn-success" href="<?php echo $item['stream']['5']['src']['1']; ?>">Download Server2</a></br>
<p>Size: <?php echo formatBytes($item['stream']['5']['size']); ?></p>
</pre>
</br>
      <hr>
      
    </div>
    <div class="col-sm-2 sidenav">
      
        <p><?php foreach($jsonvo['videorecom'] as $item3) {

        	$deurl = 'http://www.aparat.com/v/'.$item3['uid'].'';


        	echo '<div class="well">';
echo '<img data-toggle="tooltip" data-qazy-placeholder="an/image/download.gif" data-qazy="true" title="' . $item3['title']  . '" src="' . $item3['small_poster']  . '"/><br /><br />';
echo '<a class="btn btn-success btn-sm" onclick="openlink()" href="link.php?hash='.$deurl.'">Download This</a><br />
';
       	echo ' 


</div>';


}


        	; ?>
        		

        	</p>
      </div>
    </div>
  </div>
</div>
</div>

<footer class="container-fluid text-center">
  <p>APAPI</p>
</footer>

</body>
</html>
