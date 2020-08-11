<?php
  include "header.php";
  include "db.php";
?>

<main role="main">
<div style="background-image: url('./uploads/contact_background.jpg'); width:100%; padding:5%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
  <div class="album">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="<?=$bannerRow['id']?>" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      
    </ol>
    <div class="carousel-inner">
    <?php
      $sql = mysqli_query($link, "SELECT * FROM banner WHERE is_deleted = 0 ORDER BY created_date DESC");
      if(mysqli_num_rows($sql) > 0) {
        $i = 0;
        while($bannerRow = mysqli_fetch_array($sql)) {
          $has_link = !empty($bannerRow['url'])?true:false;

    ?>
      <div class="carousel-item <?=$i==0?'active':''?>">
        <img src="<?=$bannerRow['photo']?>">
        <div class="container">
          <div class="carousel-caption text-center">
            <h1></h1>
            <p></p>
            <?php
              if($has_link){
            ?>
            <p><a class="btn btn-lg btn-danger" href="<?=$bannerRow['url']?>" role="button"><?=$bannerRow['title']?></a></p>
            <?php
              }
            ?>

          </div>
        </div>
      </div>
    <?php
        $i++;
        }
      }
    ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">REALITY ESCAPE ROOMS <span class="text-muted"></span></h2>
        <p class="lead">
        Escape games are an excellent group activity that can be enjoyed either with friends, family or as a company activity. Players are trapped inside our carefully crafted game rooms , complete with realistic environments and backstory. In order to escape, players need to use the clues available to solve a series of puzzles and ultimately escape from the room. These games are a great test of problem solving, resourcefulness and teamwork.</p>
      </div>
      <div class="col-md-5">
        <img src="./uploads/index_pic1.jpg">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">WHO WE ARE <span class="text-muted"></span></h2>
        <p class="lead">LOST in JB was founded by a group of fun-loving individuals who are passionate about escape rooms, gaming and adventure. We believe that escape rooms can be so much more than solving generic puzzles and unlocking chests.</p>

        <p class="lead">Here at LOST, we aim to deliver a truly immersive experience from the moment you step in. With engaging storytelling, real authentic surroundings, and jaw-dropping special effects, you’ll forget you are in a game. We’ve also incorporated many innovative gameplay ideas that will leave both newcomers and experienced escape room enthusiasts pleasantly surprised. These are the things that sets us apart.</p>

        <p class="lead">Our escape rooms are perfect for friend gatherings, work functions and team building events. No matter the occasion, you’ll be in for a good time full of adventure, mystery and fun.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img src="./uploads/index_pic2.jpg">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">THE HAUNTED HOUSE AND THE FEAR FACTOR <span class="text-muted"></span></h2>
        <p class="lead">THE HAUNTED HOUSE is one of the brainchilds of LOST in JB. What is unique about this branch in particular? In one word – HORROR!</p>

        <p class="lead">The path to escape has never been so terrifying! We’ve included all sorts of horror and shocking elements into our escape rooms to make for a more exciting and exhilarating experience. What kind of horror elements? That’s for you to find out.</p>

        <p class="lead">Each game comes with a different “FEAR FACTOR” so that players can choose a game that suits their tolerance level the most. Experience it for yourself, go on a thrilling escape adventure like no other.</p>
      </div>
      <div class="col-md-5">
        <img src="./uploads/index_pic3.jpg">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">TO START AN ESCAPE GAME <span class="text-muted"></span></h2>
        <p class="lead">Step 1. Form a Team – Our games are designed for 2-8 Players. You will need to work together to overcome the challenges ahead of you.</p>

        <p class="lead">Step 2. Choose a Game - Choose a game based on the difficulty level or fear factor, or simply pick whatever attracts you the most!</p>

        <p class="lead">Step 3. Begin Your Journey - As the game starts, our game masters will share the backstory and give you your mission. Listen up as the story is crucial to your journey.</p>

        <p class="lead">Step 4. Your Time Starts Now - Exciting and fun challenges await you. You have 60 minutes to escape!</p>

        <p class="lead">Step 5. Be Ready for Anything - At LOST, you can be certain there will be plenty of shocks and surprises awaiting you.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img src="./uploads/index_pic4.jpg">
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->
    
  </div><!-- /.container -->
  </div>
<?php
  include "footer.php";
?>
