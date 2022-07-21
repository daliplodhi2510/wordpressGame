<?php $this->load->view('admin/layouts/header'); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>ADD NEW IMAGE</h2>
   </div>
   <div class="col-lg-2">
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <?php 
      if(!empty($this->session->flashdata('message'))): ?>
   <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
         <div class="alert <?php echo $this->session->flashdata('alert-class'); ?> text-center">
            <?php echo $this->session->flashdata('message')['message']; ?>
         </div>
      </div>
   </div>
   <?php endif; ?>
   <div class="row">
   	<?php if(isset($_GET["id"])){ 
   		$this->db->select('*');
		$this->db->from('tbl_image');
		$this->db->where("img_id",$_GET["id"]);
		$query = $this->db->get();
		$data["updateData"] = $query->result_array();
   	?>
     	   <div class="col-lg-6">
         <div class="">
            <div class="ibox-title">
               <h5>ADD NEW IMAGE</h5>
            </div>
            <?php foreach($data["updateData"] as $key1 => $value1){ ?>
            <div class="ibox-content">
               <div class="row">
                  <div class="col-sm-12">
                     <p>You can manage Image here.</p>
                     <form action="<?php echo base_url();?>admin/MasterController/updateImage" method="POST"   enctype="multipart/form-data">
                  <div class="form-group">
                     <input type="hidden" value="<?php echo $value1["img_id"]; ?>" name="id">
                     <label for="">Image Type*</label>
                     <select name="imageType" id="" class="form-control">
                        <option value="">--Select--</option>
                        <option value="0" <?php if($value1["img_type"] == "0"){ echo "selected='selected'";}?>>Match</option>
                        <option value="1" <?php if($value1["img_type"] == "1"){ echo "selected='selected'";}?>>Lottery</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="">Image Title</label>
                     <input type="text" name="imageTitle" class="form-control" placeholder="Enter Rule Title." value="<?php echo $value1["image_name"]; ?>">
                  </div>
                  <div class="form-group">
                     <label>Image</label>
                     <input type="file" name="imageFile" class="form-control">
                  </div>
                  <div class="form-group">
                     <input type="submit" class="btn btn-info" value="Update">
                  </div>
                     </form>
                  </div>
               </div>
            </div>
         <?php } ?>
         </div> 
      </div>
      <?php }else{ ?> 
		<div class="col-lg-6">
        	<div class="">
            <div class="ibox-title">
               <h5>ADD NEW IMAGE</h5>
            </div>
            <div class="ibox-content">
               <div class="row">
                  <div class="col-sm-12">
                  	<p>You can manage Image here.</p>
                     <form action="<?php echo base_url();?>admin/MasterController/storeImages" method="POST" 	enctype="multipart/form-data">
						<div class="form-group">
							<label for="">Image Type*</label>
							<select name="imageType" id="" class="form-control">
								<option value="">--Select--</option>
								<option value="0">Match</option>
								<option value="1">Lottery</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Image Title</label>
							<input type="text" name="imageTitle" class="form-control" placeholder="Enter Rule Title.">
						</div>
						<div class="form-group">
                     <label>Image</label>
                     <input type="file" name="imageFile" class="form-control">
                  </div>
						<div class="form-group">
							<input type="submit" class="btn btn-info" value="Submit">
						</div>
                     </form>
                  </div>
               </div>
            </div>
         </div> 
      </div>
      <?php } ?>
  		<div class="col-lg-6">
  			<div class="">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>RULES LIST</h5>
                        
                    </div>
                    <div class="ibox-content">
  					<p>You can manage rules here.</p>
  					<div class="table-responsive">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    
                     <div class="dataTables_info" id="DataTables_Table_0_info" role="status" >
                     <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                        <thead>
                           <tr role="row">
                              <th>ID</th>
                              <th>Title</th>
                              <th>Image</th>
                              <th>Date</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($result as $key => $value): ?>
                         	<tr>
                         		<th><?php echo $value["img_id"]; ?></th>
                         		<th><?php echo $value["image_name"]; ?></th>
                         		<th>
                                 <img src="<?php echo base_url().'assets/images/gameimage/'.$value["image"]; ?>" width="50%" alt="">   
                              </th>
                              <th><?php echo $value["date_created"]; ?></th>
                         		<th>
                         			<a href="<?php echo base_url().'admin/master/upload-image?id='.$value['img_id'];?>" class="edit-row" style="color: #29b6f6;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Record"><i class="fa fa-edit"></i></a>
                         			&nbsp;
                         			<a href="<?php echo base_url().'admin/MasterController/deleteImages/'.$value['img_id'];?>" class="remove-row" style="color: #f05050;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Permanently" onclick="return checkDelete()"><i class="fa fa-trash-o"></i></a>
                         		</th>
                         	</tr>
                         <?php endforeach;?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Image</th>
                              <th>Date</th>
                              <th>Action</th>
                           </tr>
                        </tfoot>
                     </table>
                    
                  </div>
               </div>
                    </div>
                </div>
            </div>
  		</div>
   </div>
</div>
</div>
<?php $this->load->view('admin/layouts/footer'); ?>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/dataTables/datatables.min.js"></script>
<script>
	 $(document).ready(function(){

   $('#rules').summernote();

 });

</script>
<!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
            $(function() {
  $( "#from" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    onClose: function( selectedDate ) {
      $( "#to" ).datepicker( "option", "minDate", selectedDate );
    }
  });
  $( "#to" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    onClose: function( selectedDate ) {
      $( "#from" ).datepicker( "option", "maxDate", selectedDate );
    }
  });
});
$(document).ready( function () {
  var table = $('#myTable').dataTable( { "aoColumnDefs": [ {"bSortable": false, "aTargets": [ 0, 1, 2, 5 ] } ],  "aaSorting": [] } );
  $.fn.dataTable.moment('MMMM D YYYY HH:mm');
  $('select#positions').change( function() { table.fnFilter( $(this).val() ); } );
  $('#from').keyup( function() { table.draw(); } );
  $('#to').keyup( function() { table.draw(); } );
} );
        });

    </script>