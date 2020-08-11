<?php
  include "header.php";
  include "db.php";
?>

<main role="main">
<div style="background-image: url('./uploads/contact_background.jpg'); width:100%; padding:5%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
  <div class="text-center">
    <h1 style="font-family:papyrus;">Lost In JB</h1><br>
    <h1 style="font-family:papyrus;">Contact us:</h1><br>
    <h3 style="font-family:papyrus;"><a href="#sutera" style="color:white;">Sutera</a> | <a href="#austin" style="color:white;">Mount Austin</a></h3>
    
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div id="sutera" class="col-md-7">
        <h2 class="featurette-heading" style="font-family:papyrus;">Lost in JB - Sutera <span class="text-muted"></span></h2>
        <p class="lead">Address: 30, Jalan Sutera Tanjung 8/4, Taman Sutera Utama, 81300 Skudai, Johor.</p>
        <p class="lead">Tel: 017-5800833</p>
        <p class="lead">From Mon to Sun 12:30pm to 11:30pm 7days per week.</p>
      </div>
      <div id="googleMap1" class="col-md-5">
        
      </div>
      
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
      <h2 id="austin" class="featurette-heading" style="font-family:papyrus;">Lost in JB - Mount Austin <span class="text-muted"></span></h2>
        <p class="lead">HEADQUARTERS Address: G10 & 11;, Block A, Akademik Suite, No.2 Jalan Austin Heights Utama, Taman Mount Austin, 81100. JB.</p>
        <p class="lead">Tel: 07-3645043</p>
        <p class="lead">From Mon to Sun 12:30pm to 11:30pm 7days per week.</p>
      </div>
      <div id="googleMap2" class="col-md-5">
        
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->
  </div>
<?php
  include "footer.php";
?>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(1.517253, 103.668024),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap1"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(1.561335, 103.779370),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap2"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>