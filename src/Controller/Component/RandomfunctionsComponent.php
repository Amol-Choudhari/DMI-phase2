<?php
namespace app\Controller\Component;
use Cake\Controller\Controller;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ConnectionManager;

class RandomfunctionsComponent extends Component {


	public $components= array('Session','Customfunctions','Randomfunctions');
	public $controller = null;
	public $session = null;

	public function initialize(array $config): void {

		parent::initialize($config);
		$this->Controller = $this->_registry->getController();
		$this->Session = $this->getController()->getRequest()->getSession();
	}


	public function dashboardApplicationSearch($customer_id,$check_user_role){

		$DmiRenewalFinalSubmits = TableRegistry::getTableLocator()->get('DmiRenewalFinalSubmits');
		$DmiRenewalAllocations = TableRegistry::getTableLocator()->get('DmiRenewalAllocations');
		$DmiRenewalHoAllocation = TableRegistry::getTableLocator()->get('DmiRenewalHoAllocations');
		$DmiAllocations = TableRegistry::getTableLocator()->get('DmiAllocations');
		$DmiHoAllocations = TableRegistry::getTableLocator()->get('DmiHoAllocations');
		$DmiFirms = TableRegistry::getTableLocator()->get('DmiFirms');
		$DmiCertificateTypes = TableRegistry::getTableLocator()->get('DmiCertificateTypes');
		$MCommodityCategory = TableRegistry::getTableLocator()->get('MCommodityCategory');
		$DmiStates = TableRegistry::getTableLocator()->get('DmiStates');
		$DmiDistricts = TableRegistry::getTableLocator()->get('DmiDistricts');
		$DmiUsers =  TableRegistry::getTableLocator()->get('DmiUsers');														 

		$username = $this->Session->read('username');
		$_SESSION['current_level']=null;//because used in element ctp file by from other flow.
		$get_firm_data = null;
		$current_position = null;
		$no_result = null;


		//check if applied for renewal, if yes then application will be searched in renewal flow.
		$check_if_renewal_applied = $DmiRenewalFinalSubmits->find('all',array('conditions'=>array('customer_id IS'=>$customer_id)))->first();

		//if admin, then search without condition
		//added on 03-09-2019 by Amol
		if ($check_user_role['super_admin']=='yes') {

			$condition_1 = array('customer_id IS'=>$customer_id);
			$condition_2 = array('customer_id IS'=>$customer_id);

		} else {

			$condition_1 = array('customer_id IS'=>$customer_id,'OR'=>array('level_1 IS'=>$username, 'level_2 IS'=>$username, 'level_3 IS'=>$username, 'level_4_ro IS'=>$username, 'level_4_mo IS'=>$username));
			$condition_2 = array('customer_id IS'=>$customer_id,'OR'=>array('dy_ama IS'=>$username, 'ho_mo_smo IS'=>$username, 'jt_ama IS'=>$username, 'ama IS'=>$username));
		}

		$find_first_allocation = array();
		$process = '';
		if (!empty($check_if_renewal_applied)) {

			$find_first_allocation = $DmiRenewalAllocations->find('all',array('conditions'=>$condition_1,'order'=>'id DESC'))->first();
	
			$find_ho_allocation = $DmiRenewalHoAllocation->find('all',array('conditions'=>$condition_2,'order'=>'id DESC'))->first();

			$current_position_table = 'DmiRenewalAllCurrentPositions';
			$process = 'Renewal';

		} 
		if(empty($find_first_allocation)) {

			$find_first_allocation = $DmiAllocations->find('all',array('conditions'=>$condition_1,'order'=>'id DESC'))->first();

			$find_ho_allocation = $DmiHoAllocations->find('all',array('conditions'=>$condition_2,'order'=>'id DESC'))->first();

			$current_position_table = 'DmiAllApplicationsCurrentPositions';
			$process = 'Certification';
		}

		$current_position_table = TableRegistry::getTableLocator()->get($current_position_table);

		if (!empty($find_first_allocation) || !empty($find_ho_allocation)) {

			$get_firm_data = $DmiFirms->firmDetails($customer_id);

			$certification_type = $DmiCertificateTypes->find('all',array('fields'=>'certificate_type', 'conditions'=>array('id IS'=>$get_firm_data['certification_type'])))->first();
			$get_firm_data['certification_type'] = $certification_type['certificate_type'];

			$commodity = $MCommodityCategory->find('all',array('fields'=>'category_name', 'conditions'=>array('category_code IS'=>$get_firm_data['commodity'])))->first();
			$get_firm_data['commodity'] = $commodity['category_name'];

			$state = $DmiStates->find('all',array('fields'=>'state_name', 'conditions'=>array('id IS'=>$get_firm_data['state'])))->first();
			$get_firm_data['state'] = $state['state_name'];

			$district = $DmiDistricts->find('all',array('fields'=>'district_name', 'conditions'=>array('id IS'=>$get_firm_data['district'])))->first();
			$get_firm_data['district'] = $district['district_name'];

			$get_application_position = $current_position_table->find('all',array('conditions'=>array('customer_id IS'=>$customer_id),'order'=>'id DESC'))->first();
			//This is added for getting the Name of user for searched application on 13-05-2022 by Akash
			$getName = $DmiUsers->find()->select(['f_name','l_name'])->where(['email' => $get_application_position['current_user_email_id'] ])->first();
			$currentPositionUser = $getName['f_name']." ".$getName['l_name']; 

			// This added for get Email of current User for Searched application. on 13-05-2022 by Akash.
			$getEmailCurrent = base64_decode($get_application_position['current_user_email_id']); 
			
			$current_level = $get_application_position['current_level'];

			if ($current_level == 'applicant') {

				$current_position = 'With Applicant';

			} elseif ($current_level == 'level_1') {

				$current_position = 'With MO/SMO';

			} elseif ($current_level == 'level_2') {

				$current_position = 'With IO';

			} elseif ($current_level == 'level_3') {

				$current_position = 'With Nodal Officer';
			}
			elseif($current_level == 'level_4'){

				$current_position = 'With HO(QC)';

			} elseif ($current_level == 'pao') {

				$current_position = 'With PAO/DDO';
			}
			elseif ($current_level == 'level_4_ro') {

				$current_position = 'With RO';
			}
			elseif ($current_level == 'level_4_mo') {

				$current_position = 'With MO/SMO';
			}

		} else {

			$no_result = 'Sorry... This Applicant Id does not belongs to you';
		}

		//Added on the 01-06-2022 for not empty result
		if($no_result != null){
			return array('firm_data'=>null,'current_position'=>null,'no_result'=>$no_result,'process'=>null,'currentPositionUser'=>null,'getEmailCurrent'=>null);
		}else{
			return array('firm_data'=>$get_firm_data,'current_position'=>$current_position,'no_result'=>$no_result,'process'=>$process,'currentPositionUser'=>$currentPositionUser,'getEmailCurrent'=>$getEmailCurrent);
		}

	}



	public function get_rejected_appl($each_flow){

		//get conditionaly array for Rejected Applications
		$finalSubmitTable = strtolower(implode('_',array_filter(preg_split('/(?=[A-Z])/',$each_flow['application_form']))));
		$DmiRejectedApplLogs = strtolower(implode('_',array_filter(preg_split('/(?=[A-Z])/','DmiRejectedApplLogs'))));

		$conn = ConnectionManager::get('default');
		$conditions = null;
		$stmt = $conn->execute("select rj.customer_id from $DmiRejectedApplLogs as rj
								inner join(select fss.customer_id, fss.created from $finalSubmitTable as fss
								inner join (select max(id) id, customer_id from $finalSubmitTable group by customer_id) as fs on fs.customer_id = fss.customer_id and fs.id = fss.id) as fsr on fsr.customer_id = rj.customer_id
								inner join (select max(id) id, customer_id from $DmiRejectedApplLogs group by customer_id) as maxall on maxall.customer_id = rj.customer_id and maxall.id = rj.id where rj.created > fsr.created");
		$results = array();

		if (!empty($stmt)) {

			$results = $stmt ->fetchAll();
			$results = array_column($results,'0');
		}

		return $results;
	}


	public function get_rej_cond($each_flow) {

		$results = $this->get_rejected_appl($each_flow);

		$rej_cond = array();

		if (!empty($results)) {

			$rej_cond = array('customer_id NOT IN'=>$results);
		}

		return $rej_cond;
	}


	//function to check if selected master table value for delete/edit is used by any application or not
	//created on 17-08-2017 by Amol and used in dashboard controller
	public function checkIfMasterValueUsed($record_id,$column_name){

		//to get current DB details
		$db = ConnectionManager::get('default');
		$all_tables = $db->getSchemaCollection()->listTables();//to get all tables from DB in array format
		foreach ($all_tables as $each_table) {
			$model = $each_table; //ucfirst(rtrim($each_table,'s'));//to create model name from table name
			//$model_temp = str_replace('_','',$model);//remove _ from model name to check in array before execute $model

			//check only for DMI tables
			if (substr($model,0,3)=='dmi') {

				//to check if given column exist in this table
				$stmt = $db->execute("select 1 from information_schema.columns where table_name='$each_table' and column_name='$column_name'");
				$results = $stmt ->fetchAll();

				if (!empty($results)) {

					//to check if the record exist in the column value
					$stmt1 = $db->execute("select 1 from $model where $column_name='$record_id'");
					$results1 = $stmt1 ->fetchAll();
					if (!empty($results1)) {

						return false;//if found then return false and halt the function.
					}
				}
			}
		}
		//if any of record not found in all tables then return true after loop
		return true;
	}


	//used in edit role, before roles removing check
	public function checkPaoPendingWorks($user_id){

		$DmiUsers = TableRegistry::getTableLocator()->get('DmiUsers');
		$DmiDistricts = TableRegistry::getTableLocator()->get('DmiDistricts');
		$DmiPaoDetails = TableRegistry::getTableLocator()->get('DmiPaoDetails');

		/* $pao_details = $DmiUsers->find('all',array('joins'=>array(array('table' => 'dmi_pao_details','alias' => 'pao','type' => 'INNER','conditions' => array( 'Dmi_user.id = pao.pao_user_id::integer')),
																				array('table' => 'dmi_user_roles','alias' => 'dmi_user_role','type' => 'INNER','conditions' => array( 'Dmi_user.email = dmi_user_role.user_email_id'))),'fields'=>array('pao.id'),
																					'conditions'=>array('Dmi_user.id'=>$user_id)))->first();	*/

		$pao_details = $DmiPaoDetails->find('all',array('joins'=>array(array('table' => 'dmi_users','alias' => 'user','type' => 'INNER','conditions' => array( 'user.id = DmiPaoDetails.pao_user_id::integer')),
																				array('table' => 'dmi_user_roles','alias' => 'dmi_user_role','type' => 'INNER','conditions' => array( 'user.email = dmi_user_role.user_email_id'))),'fields'=>array('DmiPaoDetails.id'),
																					'conditions'=>array('DmiPaoDetails.pao_user_id'=>$user_id)))->first();


		if (!empty($pao_details)) {

			$pao_district_list = $DmiDistricts->find('list',array('valueField'=>'id','conditions'=>array('pao_id IS'=>$pao_details['id'])))->toList();

			if (!empty($pao_district_list)) {
				return 'false';
			}
		}

		return 'true';
	}



	//used in edit role before to check pending work before removing roles
	public function checkPendingWorkForMoIo($flow_wise_tables,$check_for,$user_id){

		if ($check_for=='MO') {

			$allocation_level = 'level_1';
			$approved_level = 'level_1';
			$prefixName = 'mo_';

		} elseif ($check_for=='IO') {

			$allocation_level = 'level_2';
			$approved_level = 'level_3';
			$prefixName = 'io_';
		}

		$i = 0;
		foreach ($flow_wise_tables as $each_flow) {

			$allocationTable = TableRegistry::getTableLocator()->get($each_flow['allocation']);
			$finalSubmitTable = TableRegistry::getTableLocator()->get($each_flow['application_form']);
			$DmiRoOffices = TableRegistry::getTableLocator()->get('DmiRoOffices');
			$DmiApplicationTypes = TableRegistry::getTableLocator()->get('DmiApplicationTypes');

			$allocation_list = $allocationTable->find('list',array('conditions'=>array($allocation_level=>$user_id)))->toList();

			if (!empty($allocation_list)) {

				foreach ($allocation_list as $allocated_id) {

					$allocation_details = $allocationTable->find('all',array('conditions'=>array('id IS'=>$allocated_id)))->first();

					if (!empty($allocation_details)) {

						$allocated_customer_id = $allocation_details['customer_id'];
						$check_application_status = $finalSubmitTable->find('all',array('conditions'=>array('customer_id IS'=>$allocated_customer_id, 'status'=>'approved','current_level'=>$approved_level)))->first();

						if (empty($check_application_status)) {

							if(!empty($allocated_customer_id)){
								$allocated_to_under_ro_id[$i] = $allocation_details['level_3'];
								$allocation_ro_office = explode('/',$allocated_customer_id);
								$allocation_ro_office_code = $allocation_ro_office[2];

								//updated and added code to get Office table details from appl mapping Model
								$DmiApplWithRoMappings = TableRegistry::getTableLocator()->get('DmiApplWithRoMappings');
								$allocation_ro_office_name = $DmiApplWithRoMappings->getOfficeDetails($allocated_customer_id);

								$allocation_ro_office_name_list[$i] = $allocation_ro_office_name['ro_office'];
								$allocated_running_application_list[$i] = $allocated_customer_id;
								//get appl type
								$appl_type[$i] =  $this->Controller->Mastertablecontent->applicationTypeById($each_flow['application_type']);
							}
							
						}
					}

					$i = $i+1;
				}
			}
		}

		if (empty($allocated_running_application_list)) {

			$allocated_running_application_list = array();
			$allocated_to_under_ro_id = array();
			$allocation_ro_office_name_list = array();
			$appl_type = array();
		}

		$this->Controller->set($prefixName.'allocated_running_application_list',$allocated_running_application_list);
		$this->Controller->set($prefixName.'allocated_to_under_ro_id',$allocated_to_under_ro_id);
		$this->Controller->set($prefixName.'allocation_ro_office_name_list',$allocation_ro_office_name_list);
		$this->Controller->set($prefixName.'appl_type',$appl_type);
	}


	//used in edit role before to check pending work before removing roles
	public function checkPendingWorkForHoMo($flow_wise_tables,$user_list){

		$i = 0;

		foreach ($flow_wise_tables as $each_flow) {

			$hoAllocationTable = TableRegistry::getTableLocator()->get($each_flow['ho_level_allocation']);
			$amaApprovedTable = TableRegistry::getTableLocator()->get($each_flow['ama_approved_application']);
			$DmiUsers = TableRegistry::getTableLocator()->get('DmiUsers');

			$ho_mo_allocation_list = $hoAllocationTable->find('list',array('conditions'=>array('ho_mo_smo IS'=>$user_list['email'])))->toList();

			if (!empty($ho_mo_allocation_list)) {

				foreach ($ho_mo_allocation_list as $ho_mo_allocated_id) {

					$ho_mo_allocation_details = $hoAllocationTable->find('all',array('conditions'=>array('id IS'=>$ho_mo_allocated_id)))->first();

					if (!empty($ho_mo_allocation_details)) {

						$ho_mo_allocated_customer_id = $ho_mo_allocation_details['customer_id'];
						$check_application_status = $amaApprovedTable->find('all',array('conditions'=>array('customer_id IS'=>$ho_mo_allocated_customer_id, 'status'=>'approved')))->first();

						if (empty($check_application_status)) {

							$ho_mo_allocated_to_under_dy_ama[$i] = $ho_mo_allocation_details['dy_ama'];
							$dy_ama_details = $DmiUsers->find('all',array('conditions'=>array('email IS'=>$ho_mo_allocation_details['dy_ama'])))->first();
							$ho_mo_allocated_dy_ama_list[$i] = $dy_ama_details['f_name'].' '.$dy_ama_details['l_name'];
							$ho_mo_allocated_running_application_list[$i] = $ho_mo_allocated_customer_id;
							//get appl type
							$ho_mo_appl_type[$i] =  $this->Controller->Mastertablecontent->applicationTypeById($each_flow['application_type']);
						}
					}

					$i = $i+1;
				}
			}

			if (empty($ho_mo_allocated_running_application_list)) {

				$ho_mo_allocated_running_application_list = array();
				$ho_mo_allocated_to_under_dy_ama = array();
				$ho_mo_allocated_dy_ama_list = array();
				$ho_mo_appl_type = array();

			}

			$this->Controller->set('ho_mo_allocated_running_application_list',$ho_mo_allocated_running_application_list);
			$this->Controller->set('ho_mo_allocated_to_under_dy_ama',$ho_mo_allocated_to_under_dy_ama);
			$this->Controller->set('ho_mo_allocated_dy_ama_list',$ho_mo_allocated_dy_ama_list);
			$this->Controller->set('ho_mo_appl_type',$ho_mo_appl_type);
		}
	}


	//function to check the officer posted in SO officer
	//on 16-06-2021 by Amol
	public function isSingleOfficerPosted($office_id) {

		$DmiUsers = TableRegistry::getTableLocator()->get('DmiUsers');
		//	$user_details = $DmiUsers->find('all', array('conditions'=> array('email IS' => $username)))->first();

		//check no of officer posted in the same office
		$get_details = $DmiUsers->find('all', array('conditions'=> array('posted_ro_office' => $office_id,'status'=>'active')))->toArray();

		if (count($get_details) > 1) {

			return true;

		} else {

			return false;
		}

	}


	//function to check CA application scenario, to manage the flow
	//on 18-06-2021 by Amol
	public function checkScenarioOfCA($customer_id,$appl_type){


	}


	//function to check printing press application scenario, to manage the flow
	//on 18-06-2021 by Amol
	public function checkScenarioOfPP($customer_id) {

		//get application office details
		$DmiApplWithRoMappings = TableRegistry::getTableLocator()->get('DmiApplWithRoMappings');
		$office_details = $DmiApplWithRoMappings->getOfficeDetails($customer_id);

		$office_id = $office_details['id'];
		$office_type = $office_details['office_type'];
		$office_incharge = $office_details['ro_email_id'];

		//get single user posted or not
		$isSingleUserPosted = $this->isSingleOfficerPosted($office_id);

		//check grant role for PP
		$DmiUserRoles = TableRegistry::getTableLocator()->get('DmiUserRoles');
		$check_grant_role = $DmiUserRoles->find('all',array('fields'=>'so_grant_pp','conditions'=>array('so_grant_pp'=>'yes')))->first();

		//get scenario
		//the no. of scenario will be as per the diagrams suggested to DMI from NIC for CA, PP and Lab
		//as per the no. of scenario the application will be processed
		$scenario = '';

		if ($office_type=='SO') {

			if ($isSingleUserPosted == true) {
				$scenario = 2; //SO with single officer posted
			} else {

				if (!empty($check_grant_role)) {
					$scenario = 3;// SO with multiple officer posted, and having grant PP role
				} else {
					$scenario = 1;// SO with multiple officer posted, not having grant PP role
				}
			}

		} else {
			$scenario = 4;// application submitted to RO office
		}

	}


		//function to check laboratory application scenario, to manage the flow
		//on 18-06-2021 by Amol
		public function checkScenarioOfLab($customer_id){



		}


		//thie is created to display firm commodity details, to provide update commodity option
		//on 02-07-2021 by Amol
		public function getCommodityDetails($firm_details,$firm_type){

			//load models
			$categoryTable = TableRegistry::getTableLocator()->get('MCommodityCategory');
			$commodityTable = TableRegistry::getTableLocator()->get('MCommodity');
			$packingTypeTable = TableRegistry::getTableLocator()->get('DmiPackingTypes');

			if($firm_type==1){

				//in CA to show only already selected category list, to avoid payment amount conflict
				$commodity_array = explode(',',$firm_details['sub_commodity']);

				$i=0;
				foreach($commodity_array as $commodity_id)
				{
					$fetch_commodity_id = $commodityTable->find('all',array('fields'=>'category_code','conditions'=>array('commodity_code IS'=>$commodity_id)))->first();
					$category_id[$i] = $fetch_commodity_id['category_code'];
					$sub_commodity_data[$i] =  $fetch_commodity_id;
					$i=$i+1;
				}

				$category_id_list = array_unique($category_id);

				$category_list = $categoryTable->find('list',array('valueField'=>'category_name','conditions'=>array('category_code IN'=>$category_id_list)))->toArray();

				$sub_comm_id = explode(',',$firm_details['sub_commodity']);

				$selected_commodities = $commodityTable->find('list',array('keyField'=>'commodity_code','valueField'=>'commodity_name', 'conditions'=>array('commodity_code IN'=>$sub_comm_id)))->toArray();

				$this->Controller->set(compact('firm_type','category_list','selected_commodities'));


			}elseif($firm_type==2){

				$packing_types = $packingTypeTable->find('list',array('valueField'=>'packing_type','conditions'=>array('delete_status IS Null')))->toArray();

				$packaging_type_id = explode(',',$firm_details['packaging_materials']);

				$selected_packing_types = $packingTypeTable->find('list',array('keyField'=>'id','valueField'=>'packing_type', 'conditions'=>array('id IN'=>$packaging_type_id)))->toArray();

				$this->Controller->set(compact('firm_type','packing_types','selected_packing_types'));

			}elseif($firm_type==3){

				$category_list = $categoryTable->find('list',array('valueField'=>'category_name','conditions'=>array('display'=>'Y')))->toArray();

				$sub_comm_id = explode(',',$firm_details['sub_commodity']);

				$selected_commodities = $commodityTable->find('list',array('keyField'=>'commodity_code','valueField'=>'commodity_name', 'conditions'=>array('commodity_code IN'=>$sub_comm_id)))->toArray();

				$this->Controller->set(compact('firm_type','category_list','selected_commodities'));
			}
		}

//added custom method to check if the lab application is NABL accreditated
//on 29-09-2021 by Amol
		public function checkIfLabNablAccreditated($customer_id){

			//check firm type
			$firm_type = $this->Controller->Customfunctions->firmType($customer_id);

			if($firm_type==3){
				//check if the applicant for laboratory selected the NABL accreditation
				$DmiLaboratoryOtherDetails = TableRegistry::getTableLocator()->get('DmiLaboratoryOtherDetails');
				$checkNabl = $DmiLaboratoryOtherDetails->find('all',['conditions'=>['customer_id'=>$customer_id],'order'=>'id desc'])->first();

				if(!empty($checkNabl) && $checkNabl['is_accreditated']=='yes'){

					return $checkNabl['nabl_accreditated_upto'];
				}else{

					return null;
				}
			}else{
				return null;
			}
		}


	}



?>
