<?php echo $this->Form->create(); ?>
<div class="form-horizontal">
    <table id="lof" class="table caption-top table-striped table-bordered table-sm w100">
        <label>List of Firms Under this Office</label>
        <thead class="table-dark">
            <tr>
                <th>Sr.No</th>
                <th>Packer ID</th>
                <th>Sample Code</th>
                <th>Firm Name</th>
                <th>Firm Contact</th>   
                <th>Commodity</th>
                <th>Take Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sr_no=1; 
                foreach($underThisOffice as $eachdata){ ?>
                    <tr>
                        <td><?php echo $sr_no;?></td>
                        <td><?php echo $eachdata['customer_id']; ?></td>
                        <td><?php echo $eachdata['sample_code']; ?></td>
                        <td><?php echo $eachdata['firm_name']; ?></td>
                        <td>
                            <?php echo "<span class='badge'>Mobile:</span>".base64_decode($eachdata['mobile_no']); ?>
                            <br>
                            <?php echo "<span class='badge'>Email:</span>".base64_decode($eachdata['email']); ?>
                        </td>
                        <td><?php echo $eachdata['commodity_name']; ?></td>
                        <td><?= $this->Html->link(
                                '',
                                ['controller' => 'Othermodules', 'action' => 'fetchIdForAction', '?' => ['id' => $eachdata['id'], 'customer_id' => $eachdata['customer_id'],'sample_code' => $eachdata['sample_code']]],
                                ['class' => 'fas fad fa-exclamation-triangle','title' => 'Take Action']
                            ) ?>
                            |
                            <?= $this->Html->link(
                                '', 
                                ['controller' => 'othermodules', 'action'=>'fetchIdForShowcause','?' => ['id' => $eachdata['id'], 'customer_id' => $eachdata['customer_id'],'sample_code' => $eachdata['sample_code']]],
                                ['class'=>'fas fa-file-export','title' => 'Send Showcause Notice Directly']
                            ); ?>

                        </td>
                    </tr>
                <?php $sr_no++; } 
            ?>
        </tbody>
    </table>
</div>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->script('element/misgrade_elements/list_of_firms');?>
