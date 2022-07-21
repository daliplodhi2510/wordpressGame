<?php $this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Transaction Details</h2>
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
               <h5>Transaction Listing</h5>
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
                <form enctype="multipart/form-data" action="<?php echo base_url().'admin/transaction/view-wallet-transaction-listing'; ?>" method="post" id="formAddFilter">
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
                              <th>Transaction id</th>
                              <th>Amount</th>
                              <th>Transaction Status</th>
                              <th>Remark</th>
                              <th>Date</th>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach($transaction as $key => $value): ?>
                           <tr class="gradeA odd" role="row">
                              <td><?php echo $i; ?></td>
                              <td><?php echo $value["fname"]."".$value["lname"]; ?></td>
                              <td><?php echo $value["transaction_id"]; ?></td>
                              <td><?php if($value["transaction_type"] == 'credit'){
                                  echo '<span class="">+</span>'.$value["amount"];
                              }elseif($value["transaction_type"] == 'debit'){
                                  echo '<span class="">-</span>'.$value["amount"];
                              } ?></td>
                              <td><?php echo $value["transaction_status"]; ?></td>
                              <td><?php echo $value['remark']; ?></td>
	                          <td><?php echo date('d-m-Y H:i:s', strtotime($value['created_date'])); ?></td>
                           </tr>
                       <?php $i++; endforeach; ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>S.no</th>
                              <th>User Name</th>
                              <th>Transaction id</th>
                              <th>Amount</th>
                              <th>Transaction Status</th>
                              <th>Remark</th>
                              <th>Date</th>
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