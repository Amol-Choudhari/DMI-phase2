<?php
namespace app\Model\Table;
use Cake\ORM\Table;
use App\Model\Model;
use Cake\ORM\TableRegistry;

class DmiMisgradingCategoriesTable extends Table{
	
	var $name = "DmiMisgradingCategories";

	public function getMisgradingCategoriesList(){
		return $this->find('list', array('keyField'=>'id','valueField' => 'misgrade_category_name', 'conditions' => array('OR' => array('delete_status IS NULL', 'delete_status =' => 'no')), 'order' => array('id')))->toArray();
	}
	
}

?>