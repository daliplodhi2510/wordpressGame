<?php $this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Manage FIlter List</h2>
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
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Manage FIlter List</h5>
            </div>
            <div class="ibox-content">
            <a href="#" data-toggle="modal" data-target="#add-filter" type="button" class="btn btn-info mb-2" id="addFilter"><i class="ti-plus"> </i> Add Filter</a>
               <div class="table-responsive">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    
                     <div class="dataTables_info" id="DataTables_Table_0_info" role="status" >
                     <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                        <thead>
                           <tr role="row">
                              <th>Game Name</th>
                              <th>Filter Name</th>
                              <th>status</th>
                              <th>Action</th>
                              
                        </thead>
                        <tbody>
                        	<?php if($result){ foreach($result as $value): ?>
                           <tr class="gradeA odd" role="row">
                              <td><?php echo $value["game_title"]; ?></td>
                              <td><?php echo $value["filter_title"]; ?></td>
                              <td><?php if($value["status"] == '1'){ echo '<button class="btn btn-success btn-xs btn-block">Active</button>';}elseif($value["status"] == '0'){echo '<button class="btn btn-danger btn-xs btn-block">Inactive</button>';} ?></td>
                              <td><a href="<?php echo base_url().'admin/master/edit-filter-details?filter-id='.$value["filter_id"].'&game-id='.$value["game_id"]; ?>" class="btn btn-info btn-xs btn-block">Edit</a></td>
                           </tr>
                       <?php endforeach; } ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>Game Name</th>
                              <th>Filter Name</th>
                              <th>status</th>
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

<!-- Add filter models -->
<div class="modal fade" id="add-filter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Filter</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form enctype="multipart/form-data" action="<?php echo base_url().'admin/master/manage-filter-list?game_id='.$game_id; ?>" method="post" id="formAddFilter">
			<div class="modal-body">
				<div class="form-group">
					<label>Filter Title</label>
					<input type="text" class="form-control" name="filter_title" id="filter_title" required />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input type="submit" name="submit" class="btn btn-primary" value="submit"/>
			</div>
			</form>	
		</div>
	</div>
</div>

<?php $this->load->view('admin/layouts/footer'); ?>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/dataTables/datatables.min.js"></script>
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

$(document).ready( function () {
  var table = $('#myTable').dataTable( { "aoColumnDefs": [ {"bSortable": false, "aTargets": [ 0, 1, 2, 5 ] } ],  "aaSorting": [] } );
  $.fn.dataTable.moment('MMMM D YYYY HH:mm');
  $('select#positions').change( function() { table.fnFilter( $(this).val() ); } );
  $('#from').keyup( function() { table.draw(); } );
  $('#to').keyup( function() { table.draw(); } );
} );
        });

    </script>