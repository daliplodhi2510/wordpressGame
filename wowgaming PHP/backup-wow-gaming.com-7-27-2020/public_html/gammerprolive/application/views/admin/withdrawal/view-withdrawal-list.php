<?php $this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Withdrawal Request Details</h2>
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
               <h5>Withdrawal Request Listing</h5>
               <div class="ibox-tools">
                  <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-wrench"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-user">
                     <li><a href="#">Config option 1</a>
                     </li>
                     <li><a href="#">Config option 2</a>
                     </li>
                  </ul>
                  <a class="close-link">
                  <i class="fa fa-times"></i>
                  </a>
               </div>
            </div>
            <div class="ibox-content">
                <form enctype="multipart/form-data" action="<?php echo base_url().'admin/transaction/get-withdrawal-details'; ?>" method="post" id="formAddFilter">
                <div class="row">
                    <div classs="col-sm-3">
                        <div class="form-group">
        					<label>Select User</label>
        					<select class="form-control" name="user_id" required>
        					    <option>--Select User--</option>
        					    <?php foreach($userList as $user){ ?>
        					    <option value="<?php echo $user['id']; ?>"><?php echo $user["fname"]."".$user["lname"]; ?></option>
        					    <?php } ?>
        					</select>
        				</div>
                    </div>
                    <div classs="col-sm-3">
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="submit"/>
                        </div>
                    </div>    
                    
                </div>    
                </form>    
               <div class="table-responsive">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    
                     <div class="dataTables_info" id="DataTables_Table_0_info" role="status" >
                     <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                        <thead>
                           <tr role="row">
                              <th>S.no</th>
                              <th>User Name</th>
                              <th>Upi id</th>
                              <th>Amount</th>
                              <th>Platform</th>
                              <th>mobile_no</th>
                              <th>Status</th>
                              <th>Request Date</th>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach($withdrawalRequest as $key => $value): ?>
                           <tr class="gradeA odd" role="row">
                              <td><?php echo $i; ?></td>
                              <td><?php echo $value["fname"]."".$value["lname"]; ?></td>
                              <td><?php echo $value["upi_id"]; ?></td>
                              <td><?php echo $value["amount"]; ?></td>
                                <td><?php echo $value["platform"]; ?></td>
                              <td><?php echo $value["mobile_no"]; ?></td>
                              <td><?php if($value['release_status'] == '0'){
                              echo '<a href="#" data-toggle="modal" data-target="#pending'.$value["id"].'" type="button" class="btn btn-warning mb-2">Pending</a>';}elseif($value['release_status'] == '1'){ echo '<button class="btn btn-success btn-xs btn-block">Success</button>';}else{echo '<button class="btn btn-success btn-xs btn-block">Rejected</button>';} ?>
                                <!-- Add Mother tongue models -->
                                <div class="modal fade" id="<?php if($value['release_status'] == '0'){echo 'pending'.$value["id"];} ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                	<div class="modal-dialog modal-dialog-centered">
                                		<div class="modal-content">
                                			<div class="modal-header">
                                				<h4 class="modal-title">Change Status</h4>
                                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                			</div>
                                			<form enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/transaction/update-withdrawal-details" method="post" id="change_status">
                                			<div class="modal-body">
                                				<div class="form-group">
                                					<label>Status</label>
                                					<select class="form-control" name="status" required>
                                					    <option value="">Pending</option>
                                					    <option value="Success">Success</option>
                                					    <option value="Rejected">Rejected</option>
                                					</select>
                                					<input type="hidden" class="form-control" name="withdrawal_id" id="withdrawal_id"  value="<?php echo $value["id"]; ?>"/>
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
                              </td>
	                          <td><?php echo date('d-m-Y H:i:s', strtotime($value['request_date'])); ?></td>
                           </tr>
                       <?php $i++; endforeach; ?>
                        </tbody>
                        <tfoot>
                           <tr>
                            <th>S.no</th>
                              <th>User Name</th>
                              <th>Upi id</th>
                              <th>Amount</th>
                              <th>Platform</th>
                              <th>mobile_no</th>
                              <th>Status</th>
                              <th>Request Date</th>
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