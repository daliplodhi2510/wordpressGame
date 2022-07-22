<?php $this->load->view('admin/layouts/header'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Create Game</h2>
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
      <div class="col-lg-6">
         <div class="">
            <div class="ibox-title">
               <h5>Create Game</small></h5>
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
               <div class="row">
                  <div class="col-sm-12">
                     <form action="<?php echo base_url();?>admin/MasterController/storeGame" method="POST" enctype="multipart/form-data">
                        <div class="form-group"><label>Title</label> 
                           <input type="text" placeholder="Enter title." class="form-control" name="gameTitle">
                        </div>
                        <div class="form-group">
                           <label>URL or Package</label>
                           <input type="text" placeholder="urlPackage" class="form-control" name="urlPackage">
                        </div>
                        <div class="form-group">
                           <label for="">Image</label>
                           <input type="file" class="form-control" class="fileName" name="gameFile">
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
  		<div class="col-lg-6">
  			<div class="">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>GAME OR BANNER LIST</h5>
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

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php $i=1;
                            	foreach($result as $key => $value): ?>
                            	<tr>
                            		<td><?php echo $i; ?></td>
                            		<td><?php echo $value["title"]; ?></td>
                            		<td><img src="<?php echo base_url().'assets/images/gameimage/'.$value['banner']; ?>" alt="<?php echo $value["title"]; ?>" width="50%" class="img-responsive"></td>
											<td><button class="btn btn-info btn-xs btn-block">Edit</button>
											<button class="btn btn-danger btn-xs btn-block">Delete</button>
											<button class="btn btn-warning btn-xs btn-block">Update</button></td>
									<td><a href="<?php echo base_url().'admin/master/manage-filter-list?game_id='.$value["id"]; ?>" class="btn btn-info btn-xs btn-block">Manage Filter List</a></td>		
                            	</tr>
                            <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  		</div>
   </div>
</div>
<?php $this->load->view('admin/layouts/footer'); ?>