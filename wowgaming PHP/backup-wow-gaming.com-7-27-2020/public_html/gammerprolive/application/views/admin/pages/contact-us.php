<?php 
$title = "Privacy & Policy | Gammer Pro";
$this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
 <div class="col-lg-10">
  <h2>Contact Us</h2>
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
      <h5>Contact Us</h5>
    </div>
    <div class="ibox-content">
      <div class="">

        <!-- Page Content -->
        <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-box" style="display: none;" id="updateContent">

           <h4 class="m-t-0 header-title"><b>Contact Us</b></h4>
           <p class="text-muted font-13 m-b-30">
             Details regarding Website.
           </p>
           <form action="<?php echo base_url(); ?>admin/PageController/updateContactUs" method="post" enctype="multipart/form-data">
             <?php foreach($result as $key => $value): ?>
               <fieldset>
                <div class="row">
                 <div class="form-group">
                  <div class="col-md-3 col-sm-12">
                   <label>Date</label>
                   <input type="text" class="form-control"  readonly="" value="<?php echo date("d-m-Y")?>">
                 </div>
                 <div class="col-md-3 col-sm-12">
                   <label>Modify By</label>
                   <input type="text" class="form-control"  readonly="" value="Sachin Kumar">
                 </div>
                 <input type="hidden" value="<?php echo $value->contact_id; ?>" name="contact_id" >
                 <div class="col-md-12">
                   <label>Message</label>
                   <input type="text" class="form-control" required="" name="txtMsg" value="<?php echo $value->title; ?>">
                 </div>
                 <div class="col-md-4">
                   <label>Contact Number</label>
                   <input type="text" class="form-control"  required="" name="txtCnumber" value="<?php echo $value->phone; ?>">
                 </div>
                 <div class="col-md-4">
                   <label>Email Address</label>
                   <input type="text" class="form-control"  required="" name="txtEmail" value="<?php echo $value->email; ?>">
                 </div>
                 <div class="col-md-12">
                   <label>Address</label>
                   <textarea class="form-control" required="" name="txtAddress"><?php echo $value->address; ?></textarea>
                 </div>
                 <div class="col-md-12">
                   <label>YouTube Channel</label>
                   <input type="text" class="form-control" name="txtOther" id="txtOther" value="<?php echo $value->youtube_follow; ?>" >
                 </div>
                 <div class="col-md-12">
                   <label>Whatsapp No</label>
                   <input type="text" class="form-control" required="" name="txtWhatsapp" value=<?php echo $value->whatsapp_no; ?>>
                 </div>
                 <div class="col-md-12">
                   <label>Messenger Id</label>
                   <input type="text" class="form-control"  required="" name="txtMsngr" value=<?php echo $value->messenger_id; ?>>
                 </div>
                 <div class="col-md-12">
                   <label>Facebook Link</label>
                   <input type="text" class="form-control" required="" name="txtfb" value="<?php echo $value->fb_follow; ?>">
                 </div>
                 <div class="col-md-12">
                   <label>Instagram Link</label>
                   <input type="text" class="form-control" required="" name="txtInstagram" value="<?php echo $value->ig_follow; ?>">
                 </div>
                 <div class="col-md-12">
                   <label>Twitter Link</label>
                   <input type="text" class="form-control" required="" name="txtTwitter" value="<?php echo $value->twitter_follow; ?>">
                 </div>
                 <div class="col-md-12">
                   <label>Youtube Link</label>
                   <input type="text" class="form-control"  required="" name="txtYoutube" value="<?php echo $value->youtube_follow; ?>">
                 </div>
               </div>
             </div>

           </fieldset>
           <br>
           <div class="row">
            <div class="col-md-12">
             <button type="submit" name="btnUpdate" class="btn btn-success">Update</button>
             <button class="btn btn-danger" type="canel">Cancel</button>
           </div>
         </div>
       <?php endforeach; ?>
     </form>
   </div>
   <div class="card-box" id="contactDetails">
      <?php
         foreach ($result as $key => $getres5) { ?>
               
                    <b>Title Line : <?php echo $getres5->title; ?></b>
                    <br><br>
                    Phone Number : <?php echo $getres5->phone; ?>
                    <br><br>
                    Email : <?php echo $getres5->email; ?>
                    <br><br>
                    Address : <?php echo $getres5->address; ?>
                    <br><br>
                    WhatsApp No : <?php echo $getres5->whatsapp_no; ?>
                    <br><br>
                    Messenger Id : <?php echo $getres5->messenger_id; ?>
                    <br><br>
                    Facebook Link : <?php echo $getres5->fb_follow; ?>
                    <br><br>
                    Instagram Link : <?php echo $getres5->ig_follow; ?>
                    <br><br>
                    Twitter Link : <?php echo $getres5->twitter_follow; ?>
                    <br><br>
                    YouTube Link : <?php echo $getres5->youtube_follow; ?>
                    <br><br>
                    YouTube Channel : <?php echo $getres5->other; ?>
                    <br><br>
                    <!-- /Contact us content here -->
                    <button class="btn btn-info" onclick="showUpdateSection();">Edit Content</button>
     <?php    }

       ?>
   </div>
 </div>
</div>
<!-- /Page Content -->

</div>

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

 function showUpdateSection(){
   $("#contactDetails").css("display","none");
   $("#updateContent").css("display","block");
 }
</script>