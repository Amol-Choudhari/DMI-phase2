<?php

namespace app\Model\Table;
use Cake\ORM\Table;
use App\Model\Model;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class DmiMmrFinalSubmitsTable extends Table{


	// Perform additional sanitization or modification if needed
	protected function _getSanitizedSampleCode($value){
		
		return trim($value);
	}

	// Define validation rules
	public function validationDefault(Validator $validator): Validator
	{
		$validator
			->requirePresence('sample_code')
			->notBlank('sample_code', 'Sample code is required');

		// Add more validation rules as needed

		return $validator;
	}	

	//Save the Entity
	public function saveData($data)
	{	
		$dataArray = [
			'customer_id' => htmlentities($data['packers_id'],ENT_QUOTES),
			'sample_code' => htmlentities($data['sample_code'],ENT_QUOTES),
			'status' => 'saved',
			'user_id' => $_SESSION['username'],
			'created'=>date('Y-m-d H:i:s'),
			'modified'=>date('Y-m-d H:i:s'),
			'is_attached_packer_sample'=>'Y'
		];

		$entity = $this->newEntity($dataArray);

		if ($this->save($entity)) {
			return 1; // Return the saved entity ID or any other desired response
		}

		return false; // Return false if the save operation failed
	}


	// Method to scrutinized forms section by RO/SO
	public function reportScrutinized($customer_id,$sample_code,$last_user_email_id,$current_level) {

		$Dmi_tablename_Entity = $this->newEntity(array('customer_id'=>$customer_id,
														'sample_code'=>$sample_code,
														'status'=>'approved',
														'scrutiny'=>'done',
														'user_id'=>$last_user_email_id,
														'created'=>date('Y-m-d H:i:s'),
														'modified'=>date('Y-m-d H:i:s'),
														'is_attached_packer_sample'=>'Y',
														'current_level' => 'level_3'));

		if ($this->save($Dmi_tablename_Entity)) { return true; }

	}


}

?>