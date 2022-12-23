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

    public function getInformation($id){
        return $this->find('all')->where(['customer_id IS' => $id])->order('id ASC')->first();
    }

    public function saveLog($postData){

        $customer_id = $_SESSION['firm_id'];
        $username = $_SESSION['username'];

        $log_entity = $this->newEntity(array(
			'customer_id'=>$customer_id,
			'reason'=>htmlentities($postData['reason']),
			'status'=>'saved',
			'date'=>date('Y-m-d H:i:s'),
			'created'=>date('Y-m-d H:i:s'),
			'modified'=>date('Y-m-d H:i:s'),
            'by_user'=>$username

		 ));

		 if($this->save($log_entity)){
            return true;
         }


    }
}


?>