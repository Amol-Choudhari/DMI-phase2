<?php ?>

<thead>
		<tr>
			<th>Sr.No.</th>
			<th>Application Type</th>
			<th>Charge(In Rs.)</th>
			<th>Action</th>
		</tr>
</thead>

<tbody>

	<?php
	if (!empty($all_records)) {
		$sr_no =1;
		foreach ($all_records as $each_record) { ?>

			<tr>
				<td><?php echo $sr_no; ?></td>
				<td><?php echo $each_record['application_type'];?></td>
				<td><?php echo $each_record['charge'];?></td>
				<td>
					<?php echo $this->Html->link('', array('controller' => 'masters', 'action'=>'editfetchAndRedirect', $each_record['id']),array('class'=>'far fa-edit','title'=>'Edit')); ?>
					<?php //echo $this->Html->link('', array('controller' => 'masters', 'action'=>'deleteMasterRecord', $each_record['id']),array('class'=>'glyphicon glyphicon-remove','title'=>'Delete','confirm'=>'Are You Sure to Delete this Record?')); ?>
				</td>

			</tr>

	<?php $sr_no++; } } ?>

</tbody>
