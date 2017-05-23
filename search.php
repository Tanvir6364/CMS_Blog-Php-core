<?php
include 'inc/header.php';



if (!isset($_GET['search']) || $_GET['search'] == null) {
    header("Location: 404.php");
} else {
    $search= $_GET['search'];
}

?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php
        $query = "select * from tbl_post where title like '%$search%' or body like '%$search%' ";
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


            <?php }}else{ ?> <!--while endPOint-->
            <p>Your Search Query not found !!!....</p>
<?php }?>
    </div>

    <?php include 'inc/sidebar.php';
    include 'inc/footer.php'; ?>
</div>
