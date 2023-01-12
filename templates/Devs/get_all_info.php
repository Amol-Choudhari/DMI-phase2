<?php 
  if (empty($dde)) {
    $dde['cus'] = null;
    $dde['current_level'] = null;
    $dde['current_user_email_id'] = null;
    $dde['oldornew'] = null;
    $dde['office'] = null;
    $dde['bevo'] = null;
    $dde['export_unit'] = null;
    $dde['current_status'] = null;
    $dde['valid_for_renewal'] = null;
    $dde['formDes'] = null;
  } 
?>

<div class="card-dark">
    <div class="card-header"><h3 class="card-title">Information</h3></div>
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Task</th>
              <th>Progress</th>
              <th style="width: 40px">Label</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1.</td>
              <td>Update software</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
              </td>
              <td><span class="badge bg-danger">55%</span></td>
            </tr>
            <tr>
              <td>2.</td>
              <td>Clean database</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar bg-warning" style="width: 70%"></div>
                </div>
              </td>
              <td><span class="badge bg-warning">70%</span></td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Cron job running</td>
              <td>
                <div class="progress progress-xs progress-striped active">
                  <div class="progress-bar bg-primary" style="width: 30%"></div>
                </div>
              </td>
              <td><span class="badge bg-primary">30%</span></td>
            </tr>
            <tr>
              <td>4.</td>
              <td>Fix and squish bugs</td>
              <td>
                <div class="progress progress-xs progress-striped active">
                  <div class="progress-bar bg-success" style="width: 90%"></div>
                </div>
              </td>
              <td><span class="badge bg-success">90%</span></td>
            </tr>
          </tbody>
        </table>
      </div>
</div>
 <?php echo $this->Form->create(null, array('id'=>'search_customer','type'=>'file', 'enctype'=>'multipart/form-data')); ?>
    <?php echo $this->Form->control('customer_id', array('type'=>'text','label'=>false, 'escape'=>false, 'id'=>'customer_id', 'class'=>'input-field form-control')); ?>
        <?php echo $this->Form->control('See', array('type'=>'submit', 'name'=>'submit', 'label'=>false,'class'=>'btn btn-success submit_btn float-left')); ?>
        <table class="table">
          <tr><td >Customer ID</td><td ><?php echo $dde['cus']; ?></td></tr>
          <tr><td >Current Level</td><td ><?php echo $dde['current_level']; ?></td></tr>
          <tr><td >Current User Email</td><td ><?php echo $dde['current_user_email_id']; ?></td></tr>
          <tr><td >Office Type</td><td ><?php echo $dde['office']; ?></td></tr>
          <tr><td >RENEWAL</td><td ><?php echo $dde['valid_for_renewal']; ?></td></tr>
        </table>
    
        <?php echo $this->Form->end(); ?>