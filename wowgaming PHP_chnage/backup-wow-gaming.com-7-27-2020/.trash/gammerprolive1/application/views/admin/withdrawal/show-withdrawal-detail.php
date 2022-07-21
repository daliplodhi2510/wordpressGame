<?php 
$title = "Privacy & Policy | Gammer Pro";
$this->load->view('admin/layouts/header',$title); ?>
<link href="<?php echo base_url();?>assets/admin_assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Transtaion Details</h2>
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
						<h5>Transtaion Details</h5>
					</div>
					<?php foreach($details as $key => $value): ?>
					<div class="ibox-content">
						<div class="">

							<!-- Page Content -->
							<div class="">
								<section>
									<!-- Page-Title -->

									<!-- Page Content -->
									<div class="row">
										<div class="col-md-8">
											<div class="card-box">
												User Name:<h4 class="text-uppercase font-600"> <?php echo $value[
													"fname"]." ".$value["lname"];?>  </h4>
											</div>
										</div>
										<div class="col-md-4">
											<div class="card-box">
												Payment Status:<h4 class="text-uppercase font-600"> <span style="color:;"><?php if($value["status"] == "1"){
													echo "Approved";
												}else{
													echo "Reject"; }?></span></h4>
											</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="card-box">
												<h4 class="text-uppercase font-600">Personal Details </h4>
												<hr>
												<p class="text-muted font-13 m-b-30">
												</p><p class="text-muted"><strong>Register Name : <?php echo $value[
													"fname"]." ".$value["lname"];?> </strong> <span class="m-l-15"> </span></p>
												<p class="text-muted"><strong>Mobile Number :  <?php echo $value["mobile"]; ?></strong> <span class="m-l-15"></span></p>
												<p class="text-muted"><strong>Withdraw Coin : </strong> <span class="m-l-15"><?php echo $value["coins_used"]; ?></span></p>
												<p class="text-muted"><strong>Withdrawal Amount :</strong> <span class="m-l-15"><?php echo $value["req_amount"]; ?></span></p>
												<p class="text-muted"><strong>Requested On :</strong> <span class="m-l-15"><?php echo date('d-m-Y H:i:s',$value["date"]); ?></span></p>
												<p></p>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="card-box">
												<h4 class="text-uppercase font-600">Account Details</h4>
												<hr>
												<p class="text-muted font-13 m-b-30">
												</p><p class="text-muted"><strong>Wallet :</strong> <span class="m-l-15"><?php echo $value["getway_name"]; ?></span></p>
												<p class="text-muted"><strong>Account Holder Name :</strong> <span class="m-l-15"><?php echo $value[
													"fname"]." ".$value["lname"];?></span></p>
												<p class="text-muted"><strong>Account Id :</strong> <span class="m-l-15">100</span></p>
												<p></p>
											</div>
										</div>
                    <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <div class="card-box">
                          <h4 class="text-uppercase font-600">Order Details</h4>
                          <hr>
                          <p class="text-muted font-13 m-b-30">
                              <p class="text-muted"><strong>Order Id :</strong> <span class="m-l-15"></span></p>
                          </p>
                      </div>
                   </div> -->
                </div>
					<?php endforeach; ?>
                <!-- /Page Content -->
             </section>
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