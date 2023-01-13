<?php
namespace app\Model\Table;
use Cake\ORM\Table;
use App\Model\Model;
use Cake\ORM\TableRegistry;

class DmiMisgradeActionHomeLogsTable extends Table{
	
	var $name = "DmiMisgradeActionHomeLogsTable";
	
	public function getMisgradingActionList(){
		return $this->find('list', array('keyField'=>'id','valueField' => 'misgrade_action_name', 'conditions' => array('OR' => array('delete_status IS NULL', 'delete_status =' => 'no')), 'order' => array('id')))->toArray();
	}

	public function saveMisgradeAction($postData){

		$enity = $this->newEntity(array(

			'customer_id'=>$_SESSION['firm_id'],
			'misgrade_category'=>$postData['misgrade_category'],
			'misgrade_level'=>$postData['misgrade_level'],
			'misgrade_action'=>$postData['misgrade_action'],
			'reason'=>htmlentities($postData['reason'], ENT_QUOTES),
			'user_email'=>$_SESSION['username'],
			'created'=>date('Y-m-d H:i:s'),
			'modified'=>date('Y-m-d H:i:s'),
			'status'=>'saved',
			'time_period'=>$postData['time_period']
		));

		if ($this->save($enity)) {
			return true;
		}
	}

	public function updateMisgradeAction($postData){

		$enity = $this->newEntity(array(

			'customer_id'=>$postData['customer_id'],
			'misgrade_category'=>$postData['misgrade_category'],
			'misgrade_level'=>$postData['misgrade_level'],
			'misgrade_action'=>$postData['misgrade_action'],
			'reason'=>htmlentities($postData['reason'], ENT_QUOTES),
			'user_email'=>$_SESSION['username'],
			'created'=>date('Y-m-d H:i:s'),
			'modified'=>date('Y-m-d H:i:s'),
			'status'=>'saved'
		));

		if ($this->save($enity)) {
			return true;
		}
	}

	public function getInformation($customer_id){

		return $this->find()->where(['customer_id' => $customer_id])->order(['created' => 'DESC'])->first();
	}

	public function applicationFinalSubmit($postData) {
		
			
		$finalSubmitEntity = $this->newEntity(array('customer_id'=>$postData['customer_id'],
													'misgrade_category'=>$postData['misgrade_category'],
													'misgrade_level'=>$postData['misgrade_level'],
													'misgrade_action'=>$postData['misgrade_action'],
													'reason'=>htmlentities($postData['reason'], ENT_QUOTES),
													'user_email'=>$_SESSION['username'],
													'created'=>date('Y-m-d H:i:s'),
													'modified'=>date('Y-m-d H:i:s'),
													'status'=>'submitted',
													'time_period'=>$postData['time_period']));

		if ($this->save($finalSubmitEntity)) {

			$DmiMisgradeActionFinalSubmits = TableRegistry::getTableLocator()->get('DmiMisgradeActionFinalSubmits');

			$enitity = $DmiMisgradeActionFinalSubmits->newEntity(array(

				'customer_id'=>$postData['customer_id'],
				'misgrade_category'=>$postData['misgrade_category'],
				'misgrade_level'=>$postData['misgrade_level'],
				'misgrade_action'=>$postData['misgrade_action'],
				'status'=>'submitted',
				'time_period'=>$postData['time_period'],
				'showcause'=>null,
				'is_suspended'=>null,
				'created'=>date('Y-m-d H:i:s'),
				'modified'=>date('Y-m-d H:i:s'),
				'applicant_response'=>null,
				'reason'=>$postData['reason'],
				'by_user'=>$_SESSION['username']
			));
				
			if($DmiMisgradeActionFinalSubmits->save($enitity)){
				return true;
			}
		}
		
	}
	
}

?>