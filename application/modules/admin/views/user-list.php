<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
  <?php echo $this->session->userdata('msg'); ?>    
          
            <div class="col-md-2 pl-0 mb-4 mt-3">
             <a href="<?= base_url('admin/add_user'); ?>" class="btn btn-info pull-right "><i class="fa fa-plus mr-2"></i>Add User</a>
            </div> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Email</th>
                  <th>Full Name</th>
                <th>Language</th> 
                  <th>Image</th>
                    <th style="min-width: 80px;">Created Date</th>
               
                
                  <th style="min-width: 200px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($user)){ 

                foreach ($user as $key => $value) { ?>
                  <tr>
                     
                   
                     <td><?= $key+1; ?></td>
                     <td>
                      <?= $value['email']; ?>
                    </td>
                   
                    <td>
                      <?= $value['full_name']; ?>
                    </td>
                <td>
                      <?= language_name($value['language_id']); ?>
                    </td> 
                <td>
                          <?php if(!empty($value['profile_image'])){ ?>
                        
                          <img src="<?= base_url('/assets/userfile/profile/').$value['profile_image']; ?>" width="100" height="100">
                           <?php }?>
                        </td>
                     <td>
                      <?= date("d-M-Y", strtotime($value['created_at'])); ?>
                    </td>
             
                    <td>
                   <!--    <?php if($value['status']==1){?> 
                          <a href="<?= base_url('admin/disapprove_user/'.$value['id']); ?>" class="btn btn-success" title="Not Approve">Active</a>
                            <?php } else{ ?> 
                          <a href="<?= base_url('admin/approve_user/'.$value['id']); ?>" class="btn btn-danger" title="Approve">Deactive</a>
                            <?php }?> -->
                        <!--   
                          <?php if($value['user_type']==0){?>
                         <a href="<?= base_url('admin/makeArtist/'.$value['id']); ?>" class="btn btn-primary" title="Approve">Make Artist</a>
                           <?php } else { ?>
                             <?php } ?> -->
                       <a href="<?= base_url('admin/profile/'.$value['id']); ?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a> 
                        
                  <a href="<?php echo base_url('admin/edit_user/'.$value['id']); ?>"  class="btn btn-warning ml-0" title="" ><i class="fa fa-edit"></i></a>   
 
                          <a href="<?= base_url('admin/delete_user/'.$value['id'].'/'.'0'); ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php }

            } ?>
              </tbody>
            </table>
          </div>
        </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content