<?php
namespace app\Model\Table;
use Cake\ORM\Table;
use App\Model\Model;
use Cake\ORM\TableRegistry;

class DmiMisgradingLevelsTable extends Table{
	
	var $name = "DmiMisgradingLevels";
	
	public function getMisgradingLevelsList(){
		return $this->find('list', array('keyField'=>'id','valueField' => 'misgrade_level_name', 'conditions' => array('OR' => array('delete_status IS NULL', 'delete_status =' => 'no')), 'order' => array('id')))->toArray();
	}
}

?>