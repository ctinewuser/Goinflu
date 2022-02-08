<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
  <?php echo $this->session->userdata('msg'); ?>    
          
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>User Name</th>
                  <th>Influencer Name</th>
                  <th>Amount</th>
                  <th>Description</th>
                <th>Date</th> 
                  <th>Time</th>
             
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($postdata)){ 

                foreach ($postdata as $key => $value) { ?>
                  <tr>
                     
                   
                     <td><?= $key+1; ?></td>
                     <td>
                      <?= user_full_name($value['user_id']); ?>
                    </td>
                   
                    <td>
                      <?= user_full_name($value['influencer_id']); ?>
                    </td>
                <td>
                      <?= '€'.$value['price']; ?>
                    </td> 
                  <td>
                      <?= $value['description']; ?>
                    </td>
                     <td>
                      <?= date('d-M-Y ', strtotime($value['date'])); ?>
                    </td>
              <td>
                        <?= date(' h:i a', strtotime($value['time']));?>
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