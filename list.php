<?php
include "header.php";
include "db.php";
    $sql = mysqli_query($link, "SELECT * FROM game WHERE is_deleted = 0 AND is_hide = 0 ORDER BY created_date DESC") or die (mysqli_error($link));
?>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1>Album example</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
      <?php
        if(mysqli_num_rows($sql) > 0) {
        while($row = mysqli_fetch_array($sql)){
      ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="<?=$row['photo']?>"/>
            <div class="card-body">
              <p class="card-text"><?=$row['title']?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="detail.php?id=<?=$row['id']?>" class="btn btn-sm btn-outline-secondary">View</a>
                </div>
                
              </div>
            </div>
          </div>
        </div>

    <?php
        }
        }
    ?>       
        
      </div>
    </div>
  </div>

<?php
    include "footer.php";
?>