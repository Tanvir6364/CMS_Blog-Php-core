
<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <?php
                $query = "select * from tbl_category";
        $found = $db->select($query);
        if ($found) {
        while ($result = $found->fetch_assoc()) {
        ?>
        <ul>
            <li><a href="post2.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>

           <?php }}else{ ?>
               <li>No Category Created</li>
          <?php } ?>
        </ul>

    </div>

    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        <?php
        $query = "select * from tbl_post limit 4";
        $found = $db->select($query);
        if ($found) {
        while ($result = $found->fetch_assoc()) {
        ?>
        <div class="popular clear">
            <h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
            <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
            <p>
                <?php echo $fm->textShorten($result['body'], 125); ?>
            </p>
        </div>
<?php }}else{
            header("Location: 404.php");
        }?>

    </div>

</div>