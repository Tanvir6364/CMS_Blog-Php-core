<?php include 'inc/header.php'?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
                            <th>No.</th>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
                            <th>Image</th>
							<th>Tags</th>
                            <th>Author</th>
							<th>Date</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $query="select tbl_post.*, tbl_category.name from tbl_post inner join tbl_category on tbl_post.cat=tbl_category.id order by tbl_post.title desc";
                        $post=$db->select($query);
                        if($post){
                            $i=0;
                           while ($result=$post->fetch_assoc()){
                               $i++;

                    ?>
						<tr class="odd gradeX">
							<td width="5%"><?php echo $i;?></td>
							<td width="15%"><?php echo $result['title'];?></td>
							<td width="15%"><?php echo $fm->textShorten($result['body'], 100);?></td>
							<td width="10%"><?php echo $result['name'];?></td>
                            <td width="10%"><img src="<?php echo $result['image'];?>" height="40px" width="60px"/></td>
                            <td width="10%"><?php echo $result['author'];?></td>
                            <td width="10%"> <?php echo $result['tags'];?></td>
                            <td width="15%"> <?php echo $fm->formatDate($result['date']);?></td>
							<td><a href="viewpost.php?postid=<?php echo $result['id'];?>">View</a><?php if(Session::get('userRole')==$result['userid'] || Session::get('userRole')=='0'){?>||<a href="editpost.php?postid=<?php echo $result['id'];?>">Edit</a>||<a onclick="return confirm('Are you sure to DELETE');" href="delpost.php?id=<?php echo $result['id'];?>">Delete</a></td><?php } ?></tr>
<?php }}?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
<?php include 'inc/footer.php'?>
