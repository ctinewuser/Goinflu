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
                  <th>Bitpack Name</th>
                  <th>Transaction Id</th>
                  <th>Gross Payment</th>
                  <th>Currency Code</th>
                  <th>Payer Name</th>
                  <th>Payer Email</th>
                  <th>Status</th>
                  <th style="min-width: 80px;">Created At</th>
              
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($payments)){ 

                foreach ($payments as $key => $value) { ?>
                  <tr>
                     <td><?= $key+1; ?></td>
                    <td>
                      <?= user_full_name($value['user_id']); ?>
                    </td>
                     <td>
                      <?= bitpack_name($value['bitpack_id']); ?>
                    </td>
                       <td>
                      <?= $value['txn_id']; ?>
                    </td>
                       <td>
                      <?= $value['payment_gross']; ?>
                    </td>
                       <td>
                      <?= $value['currency_code']; ?>
                    </td>
                      <td>
                      <?= $value['payer_name']; ?>
                    </td>
                      <td>
                      <?= $value['payer_email']; ?>
                    </td>
                      <td>
                    
                      <a href="#" class="btn btn-success" >Completed</a>
                    </td>
                     <td>
                      <?= date("d-M-Y", strtotime($value['created_at'])); ?>
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