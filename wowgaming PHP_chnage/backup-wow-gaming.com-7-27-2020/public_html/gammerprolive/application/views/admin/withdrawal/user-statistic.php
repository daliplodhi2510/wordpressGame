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
					
					<div class="ibox-content">
						<div class="card-box table-responsive">
							<div class="row">
								<div class="col-sm-10">
									<h4 class="m-t-0 header-title"><b> 's Statistic</b></h4>
									<p class="text-muted font-13 m-b-30">
										Particular user overall history.
									</p>
								</div>
							</div>
							<h3>Transaction History</h3>
							<table class="table table-striped table-bordered " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Date</th>
										<th>Amount</th>
										<th>PlayCoins</th>
										<th>Payment gateway</th>
										<th>Remark</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table><br>
							<h3>Tournament Participation</h3>
							<table class="table table-striped table-bordered " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Match Id</th>
										<th>Match Title</th>
										<th>Pubg ID</th>
										<th>Win PlayCoins</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table><br>
							<h3>Referral History</h3>
							<table class="table table-striped table-bordered " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Refer Code</th>
										<th>Refer PlayCoins</th>
										<th>Status</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table><br>
							<h3>Rewarded History</h3>
							<table class="table table-striped table-bordered " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>User Name</th>
										<th>Rewarded PlayCoins</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							/div>
					<div class="card-box table-responsive">
                        <div class="row">
                            <div class="col-sm-10">
                                <h4 class="m-t-0 header-title"><b> 's Statistic</b></h4>
                                <p class="text-muted font-13 m-b-30">
                                    Particular user overall history.
                                </p>
                            </div>
                        </div>
                        <h3>Transaction History</h3>
                        <table class="table table-striped table-bordered " cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                  <th>Date</th>
                                  <th>Amount</th>
                                  <th>PlayCoins</th>
                                  <th>Payment gateway</th>
                                  <th>Remark</th>
                                  <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                                          </tbody>
                        </table><br>
                        <h3>Tournament Participation</h3>
                        <table class="table table-striped table-bordered " cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                  <th>Match Id</th>
                                  <th>Match Title</th>
                                  <th>Pubg ID</th>
                                  <th>Win PlayCoins</th>
                                  <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                                          </tbody>
                        </table><br>
                        <h3>Referral History</h3>
                        <table class="table table-striped table-bordered " cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                  <th>Refer Code</th>
                                  <th>Refer PlayCoins</th>
                                  <th>Status</th>
                                  <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                                          </tbody>
                        </table><br>
                        <h3>Rewarded History</h3>
                        <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                  <th>User Name</th>
                                  <th>Rewarded PlayCoins</th>
                                  <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                                          </tbody>
                        </table>
                    </div>
				</div>
					<!-- /Page Content -->

				

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