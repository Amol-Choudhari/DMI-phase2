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



	public function saveMisgradeAction($postdata){

		

		//another log table by user side to maintain the change
		$enity = $this->newEntity(array(

			'customer_id'=>$postdata['customer_id'],
			'misgrade_category'=>$postdata['misgrade_category'],
			'misgrade_level'=>$postdata['misgrade_level'],
			'misgrade_action'=>$postdata['misgrade_action'],
			'reason'=>htmlentities($postdata['reason'], ENT_QUOTES),
			'user_email'=>$_SESSION['username'],
			'created'=>date('Y-m-d H:i:s'),
			'modified'=>date('Y-m-d H:i:s'),
			'status'=>'saved'
		));

		if ($this->save($enity)) {
			return true;
		}
	}
}

?>