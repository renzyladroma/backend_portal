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
                        Love Content
  <a class="btn btn-primary btn-md pull-right" href="javascript:void(0)" title="Add" onclick="add_love()"><i class="fa fa-plus icon-col"></i>Add Love Content</a>
                    </div>
					<div class="panel-body">
						<form id="form-search-content" role="form" method="post" action="love_content.php">
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
									  <strong>Warning!</strong> Transaction Unsuccessful!</a>
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
			$sql_search = "select t2.title, t1.content, t1.publish_date, t1.date_created, t1.created_by
							FROM tbl_content t1
							INNER JOIN tbl_sub_category t2
							ON t1.sub_category_id_fk = t2.id
							WHERE t2.category_id_fk = '4' AND t1.publish_date BETWEEN '$start_date' AND '$end_date'";
			$result = mysqli_query($con, $sql_search) or die(mysqli_error($con));
            $total_rows = mysqli_num_rows($result); 
		?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading color-heading">
                        Love Content
                    </header>
                    <div class="panel-body">
					<?php if ($total_rows > 0) { ?>
					
						
						<table id="ucontent_table" class="display" cellspacing="0" width="100%">
							<thead>
								<tr class="">
									<th><input type="checkbox" id="select_all" title="Check all" /></th> 
									<th>Sub Category</th>
									<th>Content</th>
									<th>Publish Date</th>
									<th>Date Created</th>
									<th>Created By</th>
									
								</tr>
							</thead> 
							<tbody id="">
							<?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
								<tr>
									<td><input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row['ucontent_id']; ?>"/></td>
									<td><?php echo $row['title']; ?></td>
									<td><?php echo $row['content']; ?></td>
									<td><?php echo $row['publish_date']; ?></td>
									<td><?php echo $row['date_created']; ?></td>
									<td><?php echo $row['created_by']; ?></td>
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

  function add_love(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#myModal').modal('show'); // show bootstrap modal
    $('#add_title').text('Add Love Content'); // Set Title to Bootstrap modal title
	
}

      function save() {
                var url;

                if (save_method == 'add') {
                    url = "love/add_love.php";
                } 

                var save_form = $('#form').serialize();
                // ajax adding data to database

                if ($.trim($('#image_url').val()) == '') {

                } else {
                    $('#btnSave').text('Saving...'); //change button text
                    $('#btnSave').attr('disabled', true); //set button disable 

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: save_form,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data);
                            if (data.status == true) //if success close modal and reload ajax table
                            {
                                $('#myModal').modal('hide');
                                //$('#success_modal').modal('show');
								if(save_method == "add"){
									window.location="love_content.php?status=1";
								}else{
									window.location="love_content.php?status=1&id="+data.id;
								}
								
                            }else{
								window.location="love_content.php?status_error=1";
							}
							
                            $('#btnSave').text('Save'); //change button text
                            $('#btnSave').attr('disabled', false); //set button enable 
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error saving');
                            console.log(errorThrown);
                            console.log(textStatus);
                            console.log(save_form);
                            $('#btnSave').text('save'); //change button text
                            $('#btnSave').attr('disabled', false); //set button enable 

                        }
                    });
                }
            }

</script>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title" id="add_title">Add Love Content</h4>
			</div>
			<div class="modal-body">
				    <form role="form" id="form" action="love/add_love.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" id="id">
					
					<div class="form-group">
					<label>Publish Date</label>
					<input type="date" id="publish_date" value="<?php echo date('Y-m-d'); ?>" name="publish_date" class="form-control">
					</div>
					
					
				    <div class="form-group">
				    <label>Add Image</label>
					<input type="file" class="form-control" name="image_url" id="image_url" accept=".jpg, .jpeg, .png" required>
					</div>	
				
					<button type="submit" id="btnSave" onclick="" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="success_modal" name="success_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Image Added Successfully!</h4>
			</div>
		</div>
	</div>
</div>
<?php include('template/footer.php'); ?>