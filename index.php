<?php include('template/header.php'); ?>
<!--main content start-->


<style>
	.positive{
		background-color: #4CAF50;
	}
	.negative{
		background-color: #B93411;
	}
	.color-heading{
		background-color: #B93411; color: #fff;
	}
</style>
<script>
function myFunction() {
    var txt;
    var r = confirm("Are you sure?");
    if (r == true) {
        //txt = "You pressed OK!";
    } else {
        event.preventDefault();
    }
}
</script>
<section id="main-content">
	<section class="wrapper">
		<!-- page start-->
		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<div class="panel-heading color-heading">
                        Manage User's Story
                    </div>
					<div class="panel-body">
						<form id="form-search-content" role="form" method="post" action="index.php">
							<div class="row">
								<div class="col-md-6 col-lg-6">
									<div class="form-group">
										<label>Start Date</label>
										<input type="date" id="start_date" value="<?php echo date('Y-m-d'); ?>" name="start_date" class="form-control">
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
									<div class="form-group">
										<label>End Date</label>
										<input type="date" id="end_date"  value="<?php echo date('Y-m-d'); ?>" name="end_date" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-lg-6">
									<div class="form-group">
										<label>Status</label>
										<select name="status" id="status" class="form-control">
											<option value="0">PENDING</option>
											<option value="1">APPROVED</option>
											<option value="2">DISAPPROVED</option>
										</select>
									</div>
								</div>
								<br><br>
								<div class="col-md-6 col-lg-6">
									<div class="form-group" style="text-align: right;">
										<button id="btn-search-content" name="btn-search-content" type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i> Search</button>
									</div>
									
								</div>
							</div>
						</form>
						
						<?php if (isset($_GET['status'])) { ?>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
									<div class="alert alert-dismissible alert-success">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  <strong>Well done!</strong> Transaction Successful!</a>.
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if (isset($_GET['status_error'])) { ?>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
									<div class="alert alert-dismissible alert-warning">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  <strong>Warning!</strong> No selected records!</a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</section>
			</div>
		</div>
		
		<?php if (isset($_REQUEST['btn-search-content'])) { ?>
		<?php
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$status = $_POST['status'];
			$sql_search = "SELECT t1.id AS ucontent_id, t2.title AS sub_category, t1.title AS title, description, content, url_photo, url_video, 
							   t3.first_name AS fname,
							   t3.last_name AS lname,
							   t4.status AS status,
							   t1.date_created AS date_created
						FROM tbl_ucontent t1
						LEFT JOIN tbl_sub_category t2 ON t1.sub_category_id_fk = t2.id
						LEFT JOIN tbl_fe_user t3 ON t1.created_by = t3.account_id
						LEFT JOIN tbl_status t4 ON t1.status = t4.id
						WHERE LEFT(t1.date_created,10) BETWEEN '$start_date' AND '$end_date'
						AND t1.status = $status";
			$result = mysqli_query($con, $sql_search) or die(mysqli_error($con));
            $total_rows = mysqli_num_rows($result); 
		?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading color-heading">
                        User's Content
                    </header>
                    <div class="panel-body">
					<?php if ($total_rows > 0) { ?>
						<form method="POST" action="functions/usercontent/update.php">
						<div class="form-group pull-right col-lg-6">
						  <div class="input-group">
							<select name="status" id="status" class="form-control">
								<option value="0">PENDING</option>
								<option value="1">APPROVED</option>
								<option value="2">DISAPPROVED</option>
							</select>
							<span class="input-group-btn">
							  <button class="btn btn-danger btn-md" onclick="myFunction()" type="submit">Submit</button>
							</span>
						  </div>
						</div>
						
						<table id="ucontent_table" class="display" cellspacing="0" width="100%">
							<thead>
								<tr class="">
									<th><input type="checkbox" id="select_all" title="Check all" /></th> 
									<th>Sub Category</th>
									<th>Title</th>
									<th>Description</th>
									<th>Content</th>
									<th>Photo</th>
									<th>Video</th>
									<th>Status</th>
									<th>Created By</th>
									<th>Created Date</th>
								</tr>
							</thead> 
							<tbody id="">
							<?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
								<tr>
									<td><input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row['ucontent_id']; ?>"/></td>
									<td><?php echo $row['sub_category']; ?></td>
									<td><?php echo $row['title']; ?></td>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $row['content']; ?></td>
									<td><?php echo $row['url_photo']; ?></td>
									<td><?php echo $row['url_video']; ?></td>
									<td><?php echo $row['status']; ?></td>
									<td><?php echo $row['fname'].' '.$row['lname']; ?></td>
									<td><?php echo $row['date_created']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
						</form>
					<?php }else{ ?>
						<p>No Record Found</p>
					<?php } ?>
                    </div>
                </section>
            </div>
        </div>
		<?php }?>
        <!-- page end-->
	</section>
</section>

<script>
//select all checkboxes
$("#select_all").change(function(){  //"select all" change 
	$(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});

//".checkbox" change 
$('.checkbox').change(function(){ 
	//uncheck "select all", if one of the listed checkbox item is unchecked
	if(false == $(this).prop("checked")){ //if this item is unchecked
		$("#select_all").prop('checked', false); //change "select all" checked status to false
	}
	//check "select all" if all checkbox items are checked
	if ($('.checkbox:checked').length == $('.checkbox').length ){
		$("#select_all").prop('checked', true);
	}
});
	
$("#ucontent_table").DataTable({
	"paging": true,
	"ordering": true,
	"info": true,
	"lengthMenu": [[25, 50, 75, 100, -1], [25, 50, 75, 100, "All"]],
	dom: "Blfrtip",
	buttons: [
		"csv",
		"excel"
	]
});
</script>
<?php include('template/footer.php'); ?>