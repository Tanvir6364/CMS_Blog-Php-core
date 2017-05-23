<?php include 'inc/header.php'?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php
                if (isset($_GET['catid'])){
                    $id=$_GET['catid'];
                    $query="delete from tbl_category where id='$id'";
                    $delete=$db->delete($query);
                    if($delete){
                        echo "<span style='color: green;font-size: 18px;'>Data Successfully Deleted</span>";
                    }else{
                        echo "<span style='color: red;font-size: 18px;'>Data Not Deleted</span>";
                    }
                }


                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $query = "select * from tbl_category order by id desc";
                    $found = $db->select($query);
                    if ($found) {
                        $i=0;
                    while ($result = $found->fetch_assoc()) {
                        $i++;
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name'];?></td>
							<td><a href="editcat.php?catid=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to DELETE');" href="?catid=<?php echo $result['id'];?>">Delete</a></td>
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