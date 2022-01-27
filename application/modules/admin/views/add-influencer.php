

<div class="container-fluid">

          <!-- Page Heading -->

          <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

          <!-- DataTales Example -->

          <div class="card shadow mb-4">

            <div class="card-body">

<div class="col-md-12"> 

        <div class="alertfailurfile"></div>

    <?php echo $this->session->userdata('msg'); ?> 

<form class="form-horizontal" method="post"  action="<?php if(!empty($user)){ echo site_url('admin/edit_influencer/'.$this->uri->segment(3));}else{

          echo  base_url('admin/add_influencer/');

        } ?>"  enctype="multipart/form-data" >

        <h3 class="text-center"><?= $title; ?></h3><br>
         <div class="form-group">


       <div class="form-group">
          <label class="col-sm-2 control-label">Real Name</label>
          <div class="col-sm-8">
            <input type="text" name="full_name"  class="form-control"  placeholder="Enter Influencer Name" 
            value="<?php if(!empty($user)){ echo $user['full_name']; } ?>"
            > 
         <p><?php echo form_error('full_name', '<span class="error_msg">', '</span>'); ?></p>  

          
          </div>

        </div>
       
         <!--Add Email Field-->
         <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-8">
            <input type="text" name="email"  class="form-control"  placeholder="Enter Your Email" 
           value="<?php if(!empty($user)){ echo $user['email']; } ?>"
            > 
         <p><?php echo form_error('email', '<span class="error_msg">', '</span>'); ?></p> 
          </div>
        </div>
         <!---->
         
        
      
       
              <div class="form-group">

          <label class="col-sm-2 control-label">Password</label>

          <div class="col-sm-8">

            <input type="password" name="password"  class="form-control"  placeholder="Enter password" value="" > 
            
         <p><?php echo form_error('password', '<span for="password" generated="true" class="error_msg">', '</span>'); ?></p> 

          </div>

        </div>

       <!--Language select -->
                       <div class="form-group">
                <label class="col-sm-2 control-label label-input-lg">Select Language</label>
                  <div class="col-sm-8">
                   <select class="selectpicker" multiple data-live-search="true" name="language[]" >
                           <?php 
                              $lan = explode(",", $user['language_id']);
                           if(!empty($language)){ foreach($language as $value){ ?>
                                 <option value="<?php echo $value['id']; ?>" 
                                 <?php  if(in_array($value['id'],$lan))
                              {echo 'selected';}
                            ?> >  
                               <?php echo ucfirst($value['name']); ?> </option>
                              <?php } } ?>
                       </select>
                        </div>
                        </div>
                     <!--End -->
       <!--  chat_charge
        post_charge
        video_call_charge
         -->
          <div class="form-group">

          <label class="col-sm-2 control-label">Chat Charge</label>

          <div class="col-sm-8">

            <input type="chatCharge" name="chat_charge"  class="form-control"  placeholder="Enter chat charge" 

            value="<?php if(!empty($user)){ echo $user['chat_charge']; } ?>"

            > 
         <p><?php echo form_error('chat_charge', '<span for="language" generated="true" class="error_msg">', '</span>'); ?></p> 

          </div>

        </div>
         <div class="form-group">

          <label class="col-sm-2 control-label">Post Charge</label>

          <div class="col-sm-8">

            <input type="postCharge" name="post_charge"  class="form-control"  placeholder="Enter post charge" 

            value="<?php if(!empty($user)){ echo $user['post_charge']; } ?>"

            > 
         <p><?php echo form_error('post_charge', '<span for="language" generated="true" class="error_msg">', '</span>'); ?></p> 

          </div>

        </div>
         <div class="form-group">

          <label class="col-sm-2 control-label">Video Call Charge</label>

          <div class="col-sm-8">

            <input type="language" name="video_call_charge"  class="form-control"  placeholder="Enter video call charge" 

            value="<?php if(!empty($user)){ echo $user['video_call_charge']; } ?>"

            > 
         <p><?php echo form_error('video_call_charge', '<span for="language" generated="true" class="error_msg">', '</span>'); ?></p> 

          </div>

        </div>
      <div class="form-group">
                  <label class="col-sm-2 control-label label-input-lg">Profile Image</label>
                  <div class="col-sm-8">
                    <input type="file" name="profile_image">
                    <?php if(!empty($user)){ ?>
                      <br/>
                      <br/> <img class="img-responsive" src="<?php echo base_url('/assets/userfile/profile/'.$user['profile_image']); ?>" height="250px" width="200">
                      <?php }                    ?>
                      <?php echo form_error('profile_image', '<span class="error_msg">', '</span>'); ?>
                  </div>
                </div>
        

       <!--  <select id="select_user"  name="user_type" class="form-control">
           <option <?php if(!empty($user['user_type'] =="0")){ echo 'selected="selected"'; } ?> value="0">Fan</option>
           <option <?php if(!empty($user['user_type'] =="1")){ echo 'selected="selected"'; } ?> value="1">Artist</option>
        </select> -->
         <!-- </div>
        </div> -->
<!-- 

    <?php 
        $style = "";
      if($user['user_type']=="1"){

          $style = "display: block;";
        }else{
          $style = "display: none;";
        }
      ?>
 -->
     <!--  <div class="artistclass"> 

            <div class="form-group">

            <label class="col-sm-2 control-label">Artist Name</label>

            <div class="col-sm-8">

            <input type="text" name="artist_name"  class="form-control"  placeholder="artist name" 

            value="<?php if(!empty($user)){ echo $user['artist_name']; } ?>"

            > 
            <p><?php echo form_error('artist_name', '<span class="error_msg">', '</span>'); ?></p> 

            </div>

            </div> -->

                            



        <div class="col-sm-offset-2">
          <?php if(!empty($user)){ ?>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <input type="submit" name="submit" value="Update" class="btn btn-success">
                <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success">
                <?php } ?>
            </div>
      </form>
     </div>
    </div>
        </div>

        </div>







