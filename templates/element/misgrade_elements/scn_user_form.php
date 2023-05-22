<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-olive"><h3 class="card-title">Firm Details</h3></div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Firm ID: </dt>
                        <dd class="col-sm-8"><?php echo $customer_id; ?></dd>
                        <dt class="col-sm-4">Firm Name: </dt>
                        <dd class="col-sm-8"><?php echo $firmDetails['firm_name']; ?></dd>
                        <dt class="col-sm-4">Category: </dt>
                        <dd class="col-sm-8"><?php echo $category; ?></dd>
                        <dt class="col-sm-4">Commodity</dt>
                        <dd class="col-sm-8"><?php echo implode(',', $sub_commodity_value); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="col-form-label">Reason <span class="cRed">*</span></label>
                <?php echo $this->Form->control('reason', array('type'=>'textarea','id'=>'reason', 'value'=>$reason,'label'=>false, 'class'=>'form-control')); ?>
                <span id="error_reason" class="error invalid-feedback"></span>
            </div>
        </div>
    </div>
</div>
