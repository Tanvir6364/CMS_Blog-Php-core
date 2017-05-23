<?php include 'inc/header.php';


if (!isset($_GET['id']) || $_GET['id'] == null) {
    header("Location: 404.php");
} else {
    $id = $_GET['id'];
}

?>

    <div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <?php
            $query = "select * from tbl_post where id=$id";
            $found = $db->select($query);
            if ($found) {
                while ($result = $found->fetch_assoc()) {
                    ?>

                    <h2><?php echo $result['title']; ?></h2>
                    <h4><?php echo $fm->formatDate($result['date']); ?>, By <a
                                href="#"><?php echo $result['author']; ?></a></h4>
                    <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
                    <?php echo $result['body']; ?>

                    <div class="relatedpost clear">
                        <h2>Related articles</h2>
                        <?php $catid = $result['cat'];
                        $query = "select * from tbl_post where cat=$catid limit 6";
                        $found = $db->select($query);
                        if ($found) {
                            while ($result = $found->fetch_assoc()) {
                                ?>
                                <a href="post.php?id=<?php echo $result['id']; ?>">
                                    <img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
                                </a>
                            <?php }
                        } else {
                            echo "No Related post available";
                        } ?>
                    </div>

                <?php }
            } else {
                header("Location: 404.php");
            } ?>
        </div>

    </div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>