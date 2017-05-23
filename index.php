<?php
include 'inc/header.php';
include 'inc/slider.php';

?>
<html>
<head>
    <style>
        .pagination{display: block; font-size: 20px;margin-top: 10px;padding: 10px;text-align: center}
        .pagination a{
            background: #a6af4b none repeat scroll 0 0;
            border: 1px solid #a7700c;
            border-radius: 3px;
            color: #333;
            margin-left: 2px;
            padding: 2px 10px;
            text-decoration: none;
        }
        .pagination a:hover{background: #be8723 none repeat scroll 0 0;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php

        //Pagination....////
        $per_page=3;
        if(isset($_GET["page"])){
            $page=$_GET["page"];
        }else{
            $page=1;
        }
        $start_from=($page-1) * $per_page;

        //End Pagination////

        $query = "select * from tbl_post limit $start_from, $per_page";
        $found = $db->select($query);
        if ($found) {
            while ($result = $found->fetch_assoc()) {
                ?>
                <div class="samepost clear">
                    <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                    <h4><?php echo $fm->formatDate($result['date']); ?>, By <a
                                href="#"><?php echo $result['author']; ?></a></h4>
                    <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
                    <p>
                        <?php echo $fm->textShorten($result['body']); ?>
                    </p>
                    <div class="readmore clear">
                        <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>


            <?php } ?> <!--while endPOint-->
            <!--Pagination-->
            <?php
                $query="select * from tbl_post";
                $found=$db->select($query);
                $total_rows=mysqli_num_rows($found);
                $total_page=ceil($total_rows/$per_page);
                ?>
            <div class="pagination">
        <?php
               echo "<a href='index.php?page=1'> ".'First page'."</a>";
                    for($i=1; $i<=$total_page; $i++){
                        echo "<a href='index.php?page=".$i."'>".$i ."</a>";
                    };
                echo "<a href='index.php?page=$total_page'>".'Last page'."</a>";

            ?>
            </div>

            <!--Pagination-->


        <?php } else {
            header("Location: 404.php");
        } ?>
    </div>

    <?php include 'inc/sidebar.php';
    include 'inc/footer.php'; ?>

</div>
</body>
</html>