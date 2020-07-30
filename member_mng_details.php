<?php
  include "backend_header.php";
  include "db.php";

    $item_per_page = 10;
    $page   = isset($_GET['page'])?$_GET['page']:1;
    $start = ($page - 1) * $item_per_page; //equation for calculating $start
  
    $q      = isset($_GET['q'])?$_GET['q']:'';
    $sortby = isset($_GET['sortby'])?$_GET['sortby']:'';
  
    switch($sortby) {
      case "":
        $orderBy = "ORDER BY created_date DESC";
        break;
      case "idASC":
        $orderBy = "ORDER BY created_date ASC";
        break;
      case "titleASC":
        $orderBy = "ORDER BY product_title ASC";
        break;
      case "titleDESC":
        $orderBy = "ORDER BY product_title DESC";
        break;
    }

    
    $id = $_GET['id'];

    //total rows
    $sql = mysqli_query($link, "SELECT * FROM sales_order_details WHERE member_id = '$id' ");
    $total_data_rows = mysqli_num_rows($sql);
    $total_pages = ceil( $total_data_rows / $item_per_page );

    //search bar
    if(!empty($q)) {
        $sql = mysqli_query($link, "SELECT * FROM sales_order_details WHERE member_id = '$id'  ".$orderBy." LIMIT ".$start.",".$item_per_page);
    } else {
        $sql = mysqli_query($link, "SELECT * FROM sales_order_details WHERE member_id = '$id' ".$orderBy." LIMIT ".$start.",".$item_per_page);
    }

?>

<div class="container-fluid">
  <div class="row">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order_mng.php">
              <span data-feather="shopping-cart"></span>
              Order Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product_category_list.php">
              <span data-feather="file"></span>
              Product Category List 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product_mng.php">
              <span data-feather="bar-chart-2"></span>
              Product Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="member_mng.php">             
              <span data-feather="users"></span>
              Member Management<span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="import.php">
              <span data-feather="layers"></span>
              Import
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Member Order Details</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
        <select name="sortby" onchange="changeSort(this.value)">
              <option value="">-Sort By Latest to Oldest-</option>
              <option value="idASC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='idASC'?'selected="selected"':''?>>-Sort By Oldest to Latest-</option>
              <option value="titleASC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='titleASC'?'selected="selected"':''?>>-Sort By Item alphabet ASC-</option>
              <option value="titleDESC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='titleDESC'?'selected="selected"':''?>>-Sort By Item alphabet DESC-</option>
            </select>
            <a href="product_export.php" class="btn btn-sm btn-outline-secondary">Export</a>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
            <th>#</th>
              <th width="30%">Item</th>    
              <th width="20%">Variations</th>                  
              <th>Qty</th>
              <th>Date</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $i1 = 0;  

            if(mysqli_num_rows($sql) > 0) {
            while($row = mysqli_fetch_array($sql)){  
              $i1+=1;
              
            ?>

            <tr>
              <td><?=$i1?></td>
              <td><?=$row['product_title']?></td>      
              <td></td>                    
              <td><?=$row['qty']?></td>
              <td><?=$row['created_date']?></td>
            </tr>

            <?php
                }
              }
              
            ?>
          </tbody>
        </table>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
            if($page > 1) {
            ?>
            <li class="page-item"><a class="page-link" href="member_mng_details.php?id=<?=$id?>&&page=<?=$page-1?>">Previous</a></li>
            <?php
            }

            for($i=1; $i <= $total_pages; $i++) {
            ?>
            <li class="page-item <?=$i == $page?'active':''?>"><a class="page-link" href="member_mng_details.php?id=<?=$id?>&&page=<?=$i?>"><?=$i?></a></li>
            <?php
            }
            ?>            
            <?php
            if($page < $total_pages) {
            ?>
            <li class="page-item"><a class="page-link" href="member_mng_details.php?id=<?=$id?>&&page=<?=$page+1?>">Next</a></li>
            <?php
            }
            ?>
          </ul>
        </nav>
            
            <a class="btn btn-primary" href="member_mng.php">Back to Member Management</a>
            
      </div>
    </main>
  </div>
</div>

<script>
  function changeSort(val){

    switch(val){
      case "":
        location.href='member_mng_details.php';
        break;
      case "idASC":
        location.href='member_mng_details.php?id=<?=$id?>&&sortby=idASC';
        break;
      case "titleASC":
        location.href='member_mng_details.php?id=<?=$id?>&&sortby=titleASC';
        break;
      case "titleDESC":
        location.href='member_mng_details.php?id=<?=$id?>&&sortby=titleDESC';
        break;
    }

  }
</script>

<?php
  include "backend_footer.php";
?>