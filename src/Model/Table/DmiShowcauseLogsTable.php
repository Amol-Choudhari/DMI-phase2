<?php

namespace app\Model\Table;
use Cake\ORM\Table;
use App\Model\Model;
use App\Controller\AppController;
use App\Controller\CustomersController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

class DmiShowcauseLogsTable extends Table{

	var $name = "DmiShowcauseLogs";

    // For : Action on Misgrading / Suspension / Cancellation / Management of Misgrading Reports

	public function getInformation($id){
		return $this->find('all')->where(['customer_id IS' => $id])->order('id DESC')->first();
	}



	public function saveLog($postData){

		$DmiUsers = TableRegistry::getTableLocator()->get('DmiUsers');

		$customer_id = $_SESSION['firm_id'];
		$username = $_SESSION['username'];
		$postedOffice = $DmiUsers->getPostedOffId($username);

		$log_entity = $this->newEntity(array(
			
			'customer_id'=>$customer_id,
			'reason'=>htmlentities($postData['reason']),
			'status'=>'saved',
			'date'=>date('Y-m-d H:i:s'),
			'created'=>date('Y-m-d H:i:s'),
			'modified'=>date('Y-m-d H:i:s'),
			'by_user'=>$username,
			'posted_ro_office'=> (int) $postedOffice
		));

		if($this->save($log_entity)){
			return true;
		}
	}

	public function updateLog($postData){

		$record_id = $this->getInformation($_SESSION['firm_id']);
		$customer_id = $_SESSION['firm_id'];
		$username = $_SESSION['username'];

		$log_entity = $this->newEntity(array(

			'id'=>$record_id['id'],
			'customer_id'=>$customer_id,
			'reason'=>htmlentities($postData['reason']),
			'status'=>'saved',
			'date'=>date('Y-m-d H:i:s'),
			'created'=>$record_id['created'],
			'modified'=>date('Y-m-d H:i:s'),
			'by_user'=>$username,
			'posted_ro_office'=>$record_id['posted_ro_office']
		));

		if($this->save($log_entity)){
			return true;
		}
	}

	public function sendFinalNotice($postData){

		$DmiUsers = TableRegistry::getTableLocator()->get('DmiUsers');
		$DmiShowcauseComments = TableRegistry::getTableLocator()->get('DmiShowcauseComments');
		$customer_id = $_SESSION['firm_id'];
		$username = $_SESSION['username'];
		$date = date('Y-m-d H:i:s');
		$postedOffice = $DmiUsers->getPostedOffId($username);

		$log_entity = $this->newEntity(array(

			'customer_id'=>$customer_id,
			'reason'=>htmlentities($postData['reason']),
			'status'=>'sent',
			'date'=>$date,
			'created'=>$date,
			'modified'=>$date,
			'by_user'=>$username,
			'start_date'=>$date,
			'end_date'=>date('Y-m-d H:i:s', strtotime($date. ' + 14 days')),
			'posted_ro_office'=>$postedOffice
		));

		if($this->save($log_entity)){

			
			if($_SESSION['whichUser'] == 'dmiuser'){

				$comment_by = $_SESSION['username'];
				$comment_to =  $_SESSION['firm_id'];
				$comments = htmlentities($postData['reason']);
				$reply_by ='';
				$reply_to ='';
				$reply_comment ='';
				$reply_date = '';
				$is_latest = '';
				 
			}elseif ($_SESSION['whichUser'] == 'applicant') {

				$comment_by = $_SESSION['username'];
				$comment_to = '';
				$comments = '';
				$reply_by ='';
				$reply_to ='';
				$reply_comment ='';
				$reply_date = '';
				$is_latest = '';
			}

			$DmiShowcauseComments->saveComment($customer_id,$comment_by,$comment_to,$comments,$reply_by,$reply_to,$reply_comment);
			return true;
		}
	}



}
?>