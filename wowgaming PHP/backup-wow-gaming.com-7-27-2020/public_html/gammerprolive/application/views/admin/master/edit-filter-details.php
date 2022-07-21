<?php $this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Edit Filter Details</h2>
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
               <h5>Edit Filter Details</h5>
            </div>
            <div class="ibox-content">
            <div class="row">    
            <div class="col-sm-3">
            <a href="<?php echo base_url().'admin/master/manage-filter-list?game_id='.$game_id; ?>" class="btn btn-info btn-xs btn-block">Manage Filter List</a>
            </div>
            <div class="col-sm-9">
            </div>
            </div>
            <div class="row">
               <div class="row">
                  <div class="col-sm-12">
                     <form action="<?php echo base_url();?>admin/master/update-filter-details" method="POST" enctype="multipart/form-data">
                        <div class="form-group"><label>Filter Title</label> 
                           <input type="text"  class="form-control" name="filter_title" value="<?php echo $filter_title; ?>">
                           <input type="hidden" class="form-control" name="filter_id" value="<?php echo $filter_id; ?>">
                           <input type="hidden" class="form-control" name="game_id" value="<?php echo $game_id; ?>">
                        </div>
                        <div class="form-group">
                           <input type="submit" name="submit" class="btn btn-info">
                        </div>
                     </form>
                  </div>
               </div>
             
         </div>
      </div>
   </div>
</div>

<!-- Add Mother tongue models -->
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