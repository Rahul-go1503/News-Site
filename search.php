<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include 'config.php';
                    $limit = 5;
                    if(isset($_GET['search'])){
                        $search=mysqli_real_escape_string($conn, $_GET['search']);
                        
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }?>
                    <h2 class="page-heading"><?php echo "Search: $search" ?></h2>
                    <?php
                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT * FROM post 
                        LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id
                        WHERE title LIKE '%$search%' OR description LIKE '%$search%' 
                        ORDER BY post_id DESC
                         LIMIT {$offset} ,{$limit} 
                         ";
                    $result = mysqli_query($conn, $sql) or die("Query Unsucessfull...");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="<?php echo"admin/upload/". $row['post_img'] ?>" alt="<?php echo "a image" ?>" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href="category.php?id=<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href="author.php?id=<?php echo $row['user_id'] ?>"><?php echo $row['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                            <?php echo substr($row['description'],0,200) . "..." ?>
                                            </p>
                                            <a class='read-more pull-right' href="single.php?id=<?php echo $row['post_id'] ?>">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        echo "<h2>No Record Found</h2>";
                    }
                    $sql1 = "SELECT * FROM post WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Unsucessfull");
                if (mysqli_num_rows($result1) > 0) {
                    $total_records = mysqli_num_rows($result1);
                    
                    $total_page = ceil($total_records / $limit);
                    
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo '<li><a href="search.php?search='.$search.'&page=' . ($page - 1) . ' ">Prev</a></li>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($page == $i) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo "<li class=\" $active\" ><a href='{$hostname}/search.php?search=$search&page={$i}'> $i </a></li>";
                    }
                    if ($page < $total_page) {
                        $add = $page + 1;
                        echo "<li><a href='{$hostname}/search.php?search=$search&page=$add'>Next</a></li>";
                    }
                    echo "</ul>";
                }
                mysqli_close($conn);
            }else{
                echo "No data found";
            }
            ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
