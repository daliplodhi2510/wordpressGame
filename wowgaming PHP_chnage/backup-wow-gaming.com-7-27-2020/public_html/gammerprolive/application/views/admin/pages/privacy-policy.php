<?php 
	$title = "Privacy & Policy | Gammer Pro";
$this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Privacy & Policy Page</h2>
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
               <h5>Create Privacy &b Policy Page</h5>
            </div>
            <div class="ibox-content">
              <form action="<?php echo base_url().'admin/PageController/storePrivacyPolocy';?>" method="POST">
              	<textarea name="privacyText" id="" cols="30" rows="10" class="summernote">
                 <?php 
                  foreach ($result as $key => $value) {
                    echo $value->content;
                  }
                 ?>
                </textarea>
              	<input type="submit" name="submit" class="btn btn-info">
              </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<?php $this->load->view('admin/layouts/footer'); ?>
	<script src="<?php echo base_url();?>assets/admin_assets/js/summernote.min.js"></script>

 <script>
        $(document).ready(function(){

            $('.summernote').summernote();

       });
    </script>