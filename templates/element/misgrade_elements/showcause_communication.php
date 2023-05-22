<div class="comment_bx_container">
	<div class="form-horizontal">
		<div class="card-header bg-dark"><h3 class="comment_bx_title card-title-new">Communications With Agmark</h3></div>
		<table id="referredbackcommenttable" class="remark_tbl table table-sm m-0 table-striped table-hover table-bordered">
			<thead class="remark_tbl_thead tablehead">
				<tr>
					<th>Comment Date</th>
					<th>Comment By You</th>
					<th>Reply Date</th>
					<th>Reply By Agmark</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($chemist_referredback_history)) { ?>
					<?php foreach ($chemist_referredback_history as $value) {  ?>
						<tr>
							<td><?php echo $value['comment_dt']; ?></td>
							<td><?php echo $value['comments']; ?></td>
							<td><?php echo $value['reply_dt']; ?></td>
							<td><?php echo $value['reply_comment']; ?></td>
							<?php if ($value['is_latest'] == 1) { ?>
							<td class="remark_action">
								<button class="che-referred-back-comment-bx btn btn-sm btn-info remark_edit_btn" id="<?php echo $value['id']; ?>"><i class="fa fa-edit"></i></button>
								<?php echo $this->Html->link('<i class="fa fa-times"></i>', array('controller' => 'scrutiny', 'action'=>'delete_comment',$value['id'],$_SESSION['section_id']),array('id'=>'che_delete_referred_back','class'=>'comment_reply_delete_btn btn btn-danger remark_delete btn-sm', 'title'=>'Delete', 'escapeTitle'=>false)); ?>
							</td>
							<?php } ?>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="card-body row">
		<div class="col-sm-6">
			<?php echo $this->Form->control('reffered_back_id', array('type'=>'hidden', 'id'=>'reffered_back_id', 'escape'=>false, 'label'=>false));?>
			<div id="che_ro_referred_back_box" class="remark-current comment_bx_body">
				<?php echo $this->Form->control('reffered_back_comment', array('type'=>'textarea', 'id'=>'reffered_back_comment_bx', 'escape'=>false, 'class'=>'cvOn cvReq form-control comment_bx', 'label'=>false, 'placeholder'=>'Write Your Referred Back Comment For Applicant Here')); ?>
				<div class="err_cv"></div>
			</div>
		</div>
		<div class="custom-file col-sm-6">
			
		</div>
	</div>
</div>