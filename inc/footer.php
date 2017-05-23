<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
    </div>
    <?php
    $query = "select * from tbl_footer where id='1'";
    $found = $db->select($query);
    if ($found) {
    while ($result = $found->fetch_assoc()) {
    ?>
    <p>&copy; Copyright <?php echo $result['note']." "; echo date('Y');?></p>
    <?php }}?>
</div>
<?php
$query = "select * from tbl_social where id='1'";
$found = $db->select($query);
if ($found) {
while ($result = $found->fetch_assoc()) {
?>
<div class="fixedicon clear">
    <a href="<?php echo $result['facebook'];?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
    <a href="<?php echo $result['twitter'];?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
    <a href="<?php echo $result['linkedin'];?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
    <a href="<?php echo $result['google_plus'];?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
</div>
<?php }}?>
<script type="text/javascript" src="js/scrolltop.js"></script>