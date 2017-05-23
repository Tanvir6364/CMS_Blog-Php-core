<?php include 'inc/header.php'?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                if(isset($_GET['seenid'])){
                    $id=$_GET['seenid'];

                    $query="update tbl_contact set status='1' where id='$id'";
                    $update=$db->insert($query);
                    if ($update){
                        echo "<span style='color: green;font-size: 18px;'>Message Sent In the Seen Box</span>";
                    }else{
                        echo "<span style='color: red;font-size: 18px;'>Something Wrong</span>";
                    }
                }
                ?>

                <?php
                if(isset($_GET['unseenid'])){
                    $id=$_GET['unseenid'];

                    $query="update tbl_contact set status='0' where id='$id'";
                    $update=$db->insert($query);
                    if ($update){
                        echo "<span style='color: green;font-size: 18px;'>Message Sent In Inbox</span>";
                    }else{
                        echo "<span style='color: red;font-size: 18px;'>Something Wrong</span>";
                    }
                }
                ?>



                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $query = "select * from tbl_contact where status='0' order by id desc";
                    $found=$db->select($query);
                    if($found){
                        $i=0;
                        while ($result=$found->fetch_assoc()){
                            $i++;

                            ?>
						<tr class="odd gradeX">
                            <td><?php echo $i;?></td>
                            <td><?php echo $result['firstname']." ".$result['lastname'];?></td>
                            <td><?php echo $result['email'];?></td>
                            <td><?php echo $fm->textShorten($result['body'],30);?></td>
                            <td><?php echo $fm->formatDate($result['date']);?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> || <a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> || <a href="?seenid=<?php echo $result['id'];?>">Seen</a></td>
						</tr>
                        <?php }}?>
					</tbody>
				</table>
               </div>
            </div>





            <div class="box round first grid">
                <h2>Seen</h2>
                <!--////////////////////for Seen///////////////-->
                <?php
                if(isset($_GET['delid'])) {
                    $id = $_GET['delid'];

                    $delquery = "delete from tbl_contact where id='$id'";
                    $deldata = $db->delete($delquery);
                    if ($deldata) {
                        echo "<script>alert('Data deleted Successfully')</script>";
                        echo "<script>window.location='inbox.php';</script>";
                    } else {
                        echo "<script>alert('Data not deleted')</script>";
                        echo "<script>window.location='inbox.php';</script>";
                    }
                }
                ?>
                <div class="block">

                    <table class="data display datatable" id="example">
                        <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "select * from tbl_contact where status='1' order by id desc";
                        $found=$db->select($query);
                        if($found){
                            $i=0;
                            while ($result=$found->fetch_assoc()){
                                $i++;

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $result['firstname']." ".$result['lastname'];?></td>
                                    <td><?php echo $result['email'];?></td>
                                    <td><?php echo $fm->textShorten($result['body'],30);?></td>
                                    <td><?php echo $fm->formatDate($result['date']);?></td>
                                    <td><a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> || <a href="?unseenid=<?php echo $result['id'];?>">Unseen</a> || <a onclick="return confirm('Are you sure to DELETE');" href="?delid=<?php echo $result['id'];?>">Delete</a></td>
                                </tr>
                            <?php }}?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>

<?php include 'inc/footer.php'?>