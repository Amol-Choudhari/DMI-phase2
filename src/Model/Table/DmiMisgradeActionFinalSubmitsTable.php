<?php
namespace app\Model\Table;
use Cake\ORM\Table;
use App\Model\Model;
use Cake\ORM\TableRegistry;

class DmiMisgradeActionFinalSubmitsTable extends Table{
	
	var $name = "DmiMisgradeActionFinalSubmits";
	
	public function getTimePeriodList() {
		return $this->find('list', array('keyField'=>'time_period','valueField' => 'month', 'order' => array('time_period')))->toArray();
	}

	public function getTimePeriod($id){

		return $this->find('all')->where(['time_period' => $id])->first();
	}
	
}

?>