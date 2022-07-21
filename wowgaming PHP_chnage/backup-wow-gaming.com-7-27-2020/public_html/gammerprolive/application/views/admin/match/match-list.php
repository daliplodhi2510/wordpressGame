<?php $this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Match List</h2>
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
               <h5>Match List</h5>
            </div>
            <div class="ibox-content">
               <div class="table-responsive">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    
                     <div class="dataTables_info" id="DataTables_Table_0_info" role="status" >
                     <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                        <thead>
                           <tr role="row">
                              <th>Game Name</th>
                              <th>Match Title</th>
                              <th>Cover Images</th>
                              <th>Entry fees</th>
                              <th>Winning Price</th>
                              <th>Platform</th>
                              <th>Filter</th>
                              <th>Entry Type</th>
                        </thead>
                        <tbody>
                        	<?php if($result){ foreach($result as $value): ?>
                           <tr class="gradeA odd" role="row">
                              <td><?php echo $value["game_title"]; ?></td>
                              <td><?php echo $value["match_title"]; ?></td>
                              <td><img src="https://shopom.in/gammerprolive/assets/images/gameimage/<?php if($value["cover_image"] != ''){echo $value["cover_image"];} ?>" width="50%" alt=""></td>
                              <td><?php echo $value["entry_fee"]; ?></td>
                              <td><?php echo $value['winning_price']; ?></td>
                              <td><?php if($value['platform'] == '1'){echo 'Mobile';}else{echo 'Other';}; ?></td>
                              <td><?php if($value['entry_type'] == '1'){echo 'Trial';}else{echo 'Paid';}; ?></td>
                              <td><?php echo $value['filter_title']; ?></td>
                           </tr>
                       <?php endforeach; } ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>Game Name</th>
                              <th>Match Title</th>
                              <th>Cover Images</th>
                              <th>Entry fees</th>
                              <th>Winning Price</th>
                              <th>Platform</th>
                              <th>Filter</th>
                              <th>Entry Type</th>
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
 /*           $(function() {
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
});*/
$(document).ready( function () {
  var table = $('#myTable').dataTable( { "aoColumnDefs": [ {"bSortable": false, "aTargets": [ 0, 1, 2, 5 ] } ],  "aaSorting": [] } );
  $.fn.dataTable.moment('MMMM D YYYY HH:mm');
  $('select#positions').change( function() { table.fnFilter( $(this).val() ); } );
  $('#from').keyup( function() { table.draw(); } );
  $('#to').keyup( function() { table.draw(); } );
} );
        });

    </script>