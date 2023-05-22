<?php
	
namespace app\Model\Table;
use Cake\ORM\Table;
use App\Model\Model;
use App\Controller\AppController;
use App\Controller\CustomersController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

class DmiShowcauseCommentsTable extends Table{

	var $name = "DmiShowcauseComments";

	//For 
	public function saveComment($customer_id,$comment_by,$comment_to,$comments,$reply_by,$reply_to,$reply_comment){

		$commeny_entity = $this->newEntity(array(

			'customer_id'=>$customer_id,
			'comment_by'=>$comment_by,
			'comment_to'=>$comment_to,
			'comments'=>$comments,
			'reply_by'=>$reply_by,
			'reply_to'=>$reply_to,
			'reply_comment'=>$reply_comment,
			'reply_date'=>date('Y:m:d H:i:s'),
			'is_latest'=>'1'
		));

		if($this->save($commeny_entity)){
			return true;
		}
	}
}


?>