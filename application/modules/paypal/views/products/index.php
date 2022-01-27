<div class="col-lg-12">
<!-- List all products -->
<?php if(!empty($products)){ foreach($products as $row){ ?>
    <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
            <img src="<?php echo base_url('assets/images/'.$row['image']); ?>" />
            <div class="caption">
                <h4 class="pull-right">$<?php echo $row['price']; ?> USD</h4>
                <h4 class="pull-right"><input type="hidden" name="notify_url"></h4>
                <h4><a href="javascript:void(0);"><?php echo $row['name']; ?></a></h4>
                <p>See more snippets like this online store item at <a href="http://www.codexworld.com">CodexWorld</a>.</p>
            </div>
            <div class="ratings">
                <a href="<?php echo base_url('admin/products/buy/'.$row['id']); ?>">
                    <img src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" />
                </a>
                <input type="hidden" name="notify_url">
                <p class="pull-right">15 reviews</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </p>
            </div>
        </div>
    </div>
<?php } }else{ ?>
    <p>Product(s) not found...</p>
<?php } ?>
</div>



