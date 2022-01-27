<style type="text/css">
   .height-fix{
      min-height: calc(100vh - 180px);
   }
   .user-details-box {
       max-width: 420px;
       width: 100%;
       margin: 0 auto;
       border: 2px dashed #4effbb;
       padding: 25px;
       border-radius: 15px;
   }
</style>
<section class="height-fix about pt-5 position-relative" style="background-color: #fefcf3;">
         <div class="container">
            <div class="row">

               <?php 
                  if(!empty($payer_email)){ ?>
               
               <div class="col-lg-12 col-md-12 col-sm-6 my-5">
                  <div class="about__text">
                     <div class="section-title text-center">
                        <span>Thank you! Your payment was successful.</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 col-sm-6">
                  <div class="about__text user-details-box">
                       <div class="section-title mb-0">
                        <span class="text-center">Payment Detail</span>
                        <div class="mt-2">Payer Name : <span><?php echo $address_name; ?></span></div>
                        <div class="mt-2">Payer Email : <span><?php echo $payer_email; ?></span></div>
                        <div class="mt-2">TXN ID : <span><?php echo $txn_id; ?></span></div>
                        <div class="mt-2">Amount Paid : <span>$<?php echo $currency_code.' '.$payment_gross; ?></span></div>
                        <div class="mt-2">Payment Status : <span><?php echo $payment_status; ?></span></div>
                       </div>
                  </div>
               </div>
               <?php  }else{ ?>
                  <div class="col-lg-12 col-md-12 col-sm-6 my-5">
                  <div class="about__text mt-5">
                     <div class="section-title text-center">

                        <h1 class="text-dark">Oops!</h1>
                        <h4 class="text-danger mt-3">Something went wrong</h4>
                     </div>
                  </div>
               </div>
                <?php  }
               ?>

            </div>
         </div>
 </section>

        