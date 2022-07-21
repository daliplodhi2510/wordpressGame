<?php $this->load->view('admin/layouts/header'); ?>
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Add Match</h2>
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
      <div class="col-lg-12">
         <div class="">
            <div class="ibox-content">
               <div class="row">
                  <div class="col-sm-12">
                     <form action="<?php echo base_url();?>admin/match/add-match" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Select Game</label> 
                                    <select class="form-control" name="game_id" id="game_id" required>
                                        <option value="">--Select game--</option>
                                        <?php if($gameList){ foreach($gameList as $game){ ?>
                                        <option value="<?php echo $game['id'];?>"><?php echo $game['title'];?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Filter</label> 
                                    <select class="form-control" name="filter_id" id="filter_id" required>
                                        <option value="">--Select filter--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Match Title*</label> 
                                    <input type="text" placeholder="Enter match title" class="form-control" name="match_title" id="match_title" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="match_desc">Match Description*</label>
                                  <textarea name="match_desc" parsley-trigger="change" required placeholder="Enter match description" class="form-control" id="match_desc"></textarea>
                                  <script>
                                          CKEDITOR.replace('match_desc');
                                  </script>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Cover Image*</label> 
                                    <select class="form-control" name="cover_image" id="cover_image" required>
                                        <option value="">--Select cover image--</option>
                                        <?php if($coverList){ foreach($coverList as $cover){ ?>
                                        <option value="<?php echo $cover['img_id'];?>"><?php echo $cover['image_name'];?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="platform">Platform</label>
                                  <select class="form-control" name="platform" id="platform" required>
                                    <option value="">-- Select --</option>
                                    <option value="1">Mobile</option>
                                  </select>                          
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="entry_type">Entry type</label>
                                  <select class="form-control" name="entry_type" id="entry_type" required>
                                    <option value="">-- Select entry type--</option>
                                    <option value="1">Trial</option>
                                    <option value="2">Paid</option>
                                  </select>                          
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Entry Fee</label> 
                                    <input type="text" placeholder="Enter entry fee" class="form-control" name="entry_fee" id="entry_fee" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Winning prize</label> 
                                    <input type="text" placeholder="Enter winning prize" class="form-control" name="winning_prize" id="winning_prize" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Map</label> 
                                    <input type="text" class="form-control" name="map" id="map" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="txtCimg">Match Rules</label>
                                  <!-- <input type="file" name="txtCimg" parsley-trigger="change" class="form-control" id="txtCimg"> -->
                                  <select name="match_rule" class="form-control" required data-placeholder="Choose ..." id="match_rule" required>
                                  <option value="">--- Select ---</option>
                                   <?php if($matchRuleList){ foreach($matchRuleList as $rule){ ?>
                                        <option value="<?php echo $rule['rule_id'];?>"><?php echo $rule['rule_title'];?></option>
                                        <?php }} ?>
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label>How to join URL (youtube link)</label>
                                  <input type="text" placeholder="Enter join url" class="form-control" name="join_url" id="join_url" required>
                                </div>
                            </div>    
                            <div class="col-sm-12">
                                <div class="form-group">
                                   <input type="submit" name="submit" class="btn btn-info">
                                </div>
                            </div>
                        </div>    
                     </form>
                  </div>
               </div>
            </div>
         </div> 
      </div>
   </div>
</div>
<?php $this->load->view('admin/layouts/footer'); ?>
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>

<script>
$("#game_id").change(function(){
		var game_id = $('#game_id option:selected').val();
		alert(game_id);
		if(game_id != '')
		{
			$.ajax({
				 url:'<?php echo base_url();?>admin/master/get-filter-details',
				 type:"post",
				 data: {game_id:game_id},
				 dataType: "json",
				 cache:false,
				 success: function(data){
					if(data.success == 'true')
					{
						$('#filter_id').html(data.option);	
							
					}else
					{
						$('#filter_id').html(data.option);
					}
					 
			   }
			 });
		}
	});
</script>