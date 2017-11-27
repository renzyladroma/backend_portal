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

       

            function edit_dealer(id) {
                save_method = 'update';
                console.log(id + ' '+ save_method);
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string

                var value = {
                    id: id
                };

                //Ajax Load data from ajax
                $.ajax({
                    url: "news_content/edit_news.php",
                    type: "POST",
                    data: value,
                    success: function(data) {
						console.log(data);
                        // var dataparsed = jQuery.parseJSON(data);
                        console.log(data.category_name);
						$('#id').val(data.id);
						$('#category_name').val(data.category_name);
                        $('#headline').val(data.headline);
                        $('#image').val(data.image);
                        //$('#fetch_date').val(data.fetch_date);
                        $('#imageContent-modal').modal('show'); // show bootstrap modal when complete loaded
                        // $('.modal-title').text('Updated Successfully'); // Set title to Bootstrap modal title

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            }


			
            function save() {
                var url;

                if (save_method == 'update') {
                    url = "news_content/update_news_image.php";
                } 

                var save_form = $('#form').serialize();
                // ajax adding data to database

                if ($.trim($('#category_name').val()) == '') {

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
                            if (data.status) //if success close modal and reload ajax table
                            {
                                $('#imageContent-modal').modal('hide');
                                $('#success_modal').modal('show');
								if(save_method == "add"){
									window.location="news.php?status=1";
								}else{
									window.location="news.php?status=1&id="+data.id;
								}
								
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

            function reload_table() {
                table.ajax.reload(null, false); //reload datatable ajax 
            }
</script>
<section id="main-content">
	<section class="wrapper">
		<!-- page start-->
		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<div class="panel-heading color-heading">
                        Manage News Content
                    </div>
					<div class="panel-body">
						<form id="form-search-content" role="form" method="post" action="news.php">
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
											<option value="1">Tabloid</option>
											<option value="2">Government</option>
											<option value="3">Entertainment</option>
											<option value="4">Sports</option>
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
									  <strong>Well done!</strong> Updated Successfully!</a>.
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
									  <strong>Oops!</strong> There's something wrong.</a>
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
			$sql_search = "SELECT t1.id AS ucontent_id, t2.category AS category_name, t1.headline AS headline, t1.image AS image, 
							t1.fetch_date AS fetch_date FROM rss_content t1
							INNER JOIN rss_category t2
							ON t1.category_id = t2.category_id
							WHERE t1.image LIKE 'http://115.85.17.57:8001%' AND LEFT(t1.fetch_date,10) BETWEEN '$start_date' AND '$end_date' AND t1.category_id = $status";
			$result = mysqli_query($con, $sql_search) or die(mysqli_error($con));
            $total_rows = mysqli_num_rows($result); 
		?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading color-heading">
                        News Content
                    </header>
                    <div class="panel-body">
					<?php if ($total_rows > 0) { ?>
						<form  method="POST" action="functions/usercontent/update.php">
						
						
						<table id="ucontent_table" class="display" cellspacing="0" width="100%">
							<thead>
								<tr class="">
									<th><input type="checkbox" id="select_all" title="Check all" /></th> 
									<th>Category</th>
									<th>Headline</th>
									<th>Image</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead> 
							<tbody id="">
							<?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
								<tr>
									<td><input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row['ucontent_id']; ?>"/></td>
									<td><?php echo $row['category_name']; ?></td>
									<td><?php echo $row['headline']; ?></td>
									<td><?php echo $row['image']; ?></td>
									<td><?php echo $row['fetch_date']; ?></td>
									<td><a href="#" onclick="edit_dealer('<?php echo $row['ucontent_id'];?>')"><i class="fa fa-edit"></i></a></td>
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


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="imageContent-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title" id="add_title">News Content</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="form" action="news_content/update_news_image.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" required name="category_name" id="category_name" placeholder="Category Name" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <label>Headline</label>
                        <input type="text" class="form-control" required name="headline" id="headline" placeholder="Headline" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <label>Default Image</label>
                        <input type="text" required class="form-control" name="image" id="image" placeholder="Image" disabled="disabled">
                    </div>
					
					<div class="form-group">
						<label>Edit Image</label>
						<input type="file" class="form-control" name="image_url" id="image_url" accept=".jpg, .jpeg, .png" required>
					</div>	
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="success_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Transaction Successful!</h4>
            </div>
        </div>
    </div>
</div>


<?php include('template/footer.php'); ?>