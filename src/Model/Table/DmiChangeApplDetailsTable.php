<?php 
	namespace app\Model\Table;
	use Cake\ORM\Table;
	use App\Model\Model;
	use App\Controller\AppController;
	use App\Controller\CustomersController;
	use Cake\ORM\TableRegistry;
	
	class DmiChangeApplDetailsTable extends Table{

		var $name = "DmiChangeApplDetails";
		
		public $validate = array();
		
		
		
		// Fetch form section all details
		public function sectionFormDetails($customer_id)
		{
			$form_fields = $this->find('all', array('conditions'=>array('customer_id IS'=>$customer_id),'order'=>'id desc'))->first();
					
			if($form_fields != null){		
				$form_fields_details = $form_fields;
				$DistList = $this->DmiDistricts->find('list',array('keyFields'=>'id','valueFields'=>'district_name','conditions'=>array('state_id'=>$form_fields['premise_state'],'delete_status IS NULL'),'order'=>'district_name asc'),)->toList();
				$form_fields_details['dist_list'] = $DistList;
				
			}else{
				$form_fields_details = Array ( 'id'=>"", 'firm_name' =>"",'premise_state'=>"", 'premise_street' => "", 'premise_city' => "", 'premise_pin' => "", 'const_of_firm' => "",
											   'mobile_no' => "", 'email_id' => "", 'phone_no' => "", 'comm_category' => "", 'commodity' =>"", 'lab_type' =>"",
											   'lab_name' =>"", 'lab_consent_docs' =>"", 'lab_equipped_docs' =>"", 'chemist_details_docs' =>"", 'packing_types' =>"", 'created' => "", 'modified' =>"", 'customer_id' => "", 'reffered_back_comment' => "",
											   'reffered_back_date' => "", 'form_status' =>"", 'customer_reply' =>"", 'customer_reply_date' =>"", 'approved_date' => "",
											   'user_email_id' => "", 'current_level' => "",'mo_comment' =>"", 'mo_comment_date' => "", 'ro_reply_comment' =>"", 'ro_reply_comment_date' =>"", 'delete_mo_comment' =>"", 'delete_ro_reply' => "",
											   'delete_ro_referred_back' => "", 'delete_customer_reply' => "", 'ro_current_comment_to' => "",
											   'rb_comment_ul'=>"",'mo_comment_ul'=>"",'rr_comment_ul'=>"",'cr_comment_ul'=>"",'dist_list'=>""); 
				
			}
			
			$CustomersController = new CustomersController;
			
			//for firm details
			$DmiFirms = TableRegistry::getTableLocator()->get('DmiFirms');
			$firm_details = $DmiFirms->firmDetails($customer_id);

			//premises details
			$DmiCustomerPremisesProfiles = TableRegistry::getTableLocator()->get('DmiCustomerPremisesProfiles');
			$premises_details = $DmiCustomerPremisesProfiles->find('all',array('fields'=>array('street_address','state','district','postal_code'),'conditions'=>array('customer_id IS'=>$customer_id),'order'=>'id desc'))->first();
			
			//tbl details
			$DmiChangeAllTblsDetails = TableRegistry::getTableLocator()->get('DmiChangeAllTblsDetails');
			$checkChangeTbl = $DmiChangeAllTblsDetails->find('all',array('fields'=>'id','conditions'=>array('customer_id IS'=>$customer_id)))->first();
			
			//for first time only
			if(empty($checkChangeTbl)){
				//fetch last details
				$DmiAllTblsDetails = TableRegistry::getTableLocator()->get('DmiAllTblsDetails');
				$getLastTbls = $DmiAllTblsDetails->find('all',array('conditions'=>array('customer_id IS'=>$customer_id,'delete_status IS NULL'),'order'=>'id asc'))->toArray();
				$dataArr = array();
				foreach($getLastTbls as $each){
					$dataArr[] = array(
						'customer_id'=>$customer_id,
						'tbl_name'=>$each['tbl_name'],
						'tbl_registered'=>$each['tbl_registered'],
						'tbl_registered_no'=>$each['tbl_registered_no'],
						'tbl_registration_docs'=>$each['tbl_registration_docs'],
						'created'=>$CustomersController->Customfunctions->changeDateFormat($each['created']),
						'modified'=>$CustomersController->Customfunctions->changeDateFormat($each['modified'])
					);
				}
				//save last details in change tbl table
				$ChangeTblsEntity = $DmiChangeAllTblsDetails->newEntities($dataArr);
				foreach($ChangeTblsEntity as $each){
					$DmiChangeAllTblsDetails->save($each);
				}
			}
			$added_tbls_details = $DmiChangeAllTblsDetails->tblsDetails();
			
			//for director details
			$DmiChangeDirectorsDetails = TableRegistry::getTableLocator()->get('DmiChangeDirectorsDetails');
			$checkChangeDirector = $DmiChangeDirectorsDetails->find('all',array('fields'=>'id','conditions'=>array('customer_id IS'=>$customer_id)))->first();
			
			//for first time only
			if(empty($checkChangeDirector)){
				//fetch last details
				$DmiAllDirectorsDetails = TableRegistry::getTableLocator()->get('DmiAllDirectorsDetails');
				$getLastDirector = $DmiAllDirectorsDetails->find('all',array('conditions'=>array('customer_id IS'=>$customer_id,'delete_status IS NULL'),'order'=>'id asc'))->toArray();
				$dataArr = array();
				foreach($getLastDirector as $each){
					$dataArr[] = array(
						'customer_id'=>$customer_id,
						'user_email_id'=>$each['user_email_id'],
						'd_name'=>$each['d_name'],
						'd_address'=>$each['d_address'],
						'created'=>$CustomersController->Customfunctions->changeDateFormat($each['created']),
						'modified'=>$CustomersController->Customfunctions->changeDateFormat($each['modified'])
					);
				}
				//save last details in change tbl table
				$ChangeDirectorEntity = $DmiChangeDirectorsDetails->newEntities($dataArr);
				foreach($ChangeDirectorEntity as $each){
					$DmiChangeDirectorsDetails->save($each);
				}
			}
			$added_directors_details = $DmiChangeDirectorsDetails->allDirectorsDetail($customer_id);			
					
			//loboratory details
			$DmiCustomerLaboratoryDetails = TableRegistry::getTableLocator()->get('DmiCustomerLaboratoryDetails');
			$laboratory_types = $CustomersController->Mastertablecontent->allLaboratoryType();
			$fetchlabDetails = $DmiCustomerLaboratoryDetails->find('all',array('fields'=>array('laboratory_name','laboratory_type','consent_letter_docs','chemist_detail_docs','lab_equipped_docs'),'conditions'=>array('customer_id IS'=>$customer_id),'order'=>'id desc'))->first();
			$labDetails = array($laboratory_types,$fetchlabDetails);		
					
			//category list
			$MCommodityCategory = TableRegistry::getTableLocator()->get('MCommodityCategory');
			$cat_list = $MCommodityCategory->find('list',array('valueField'=>'category_name','conditions'=>array('display'=>'Y')))->toArray();
			
			return array($form_fields_details,$firm_details,$premises_details,$added_tbls_details,$added_directors_details,$labDetails,$cat_list);
				
		}		
		
		
		// save or update form data and comment reply by applicant
		public function saveFormDetails($customer_id,$forms_data){
			
			$dataValidatation = $this->postDataValidation($customer_id,$forms_data);
			
			if($dataValidatation == 1 ){
				
				$CustomersController = new CustomersController;
	
				$section_form_details = $this->sectionFormDetails($customer_id);
				
				$DmiChangeSelectedFields = TableRegistry::getTableLocator()->get('DmiChangeSelectedFields');
				$selectedfields = $DmiChangeSelectedFields->selectedChangeFields();
				$selectedValues = $selectedfields[0];
	
				
				// If applicant have referred back on give section				
				if($section_form_details[0]['form_status'] == 'referred_back'){
					
					$max_id = $section_form_details[0]['id'];
					$htmlencoded_reply = htmlentities($forms_data['customer_reply'], ENT_QUOTES);
					$customer_reply_date = date('Y-m-d H:i:s');
					
					if(!empty($forms_data['cr_comment_ul']->getClientFilename())){				
						
						$file_name = $forms_data['cr_comment_ul']->getClientFilename();
						$file_size = $forms_data['cr_comment_ul']->getSize();
						$file_type = $forms_data['cr_comment_ul']->getClientMediaType();
						$file_local_path = $forms_data['cr_comment_ul']->getStream()->getMetadata('uri');
						
						$cr_comment_ul = $CustomersController->Customfunctions->fileUploadLib($file_name,$file_size,$file_type,$file_local_path); // calling file uploading function
				
					}else{ $cr_comment_ul = null; }
						
				}else{ 			
						$htmlencoded_reply = ''; 
						$max_id = ''; 
						$customer_reply_date = '';
						$cr_comment_ul = null;	
				}

				if(empty($section_form_details[0]['created'])){  $created = date('Y-m-d H:i:s'); }
				//added date function on 31-05-2021 by Amol to convert date format, as saving null
				else{ $created = $CustomersController->Customfunctions->changeDateFormat($section_form_details[0]['created']); }
				
				$newEntity = $this->newEntity(array(
				
					'id'=>$max_id,
					'customer_id'=>$customer_id,
					'once_card_no'=>$_SESSION['once_card_no'],
					'firm_name'=>$firm_name_main,
					'street_address'=>$firm_street_address,
					'state'=>$firm_state_id,
					'district'=>$firm_district_id,
					'postal_code'=>$firm_postal_code,
					'firm_email_id'=>base64_encode($firm_email_id),//for email encoding
					'firm_mobile_no'=>$firm_mobile_no,
					'firm_fax_no'=>$firm_fax_no,
					'business_type'=>$business_type,
					'business_type_docs'=>$business_type_docs,
					'business_years'=>$business_years,
					'have_reg_no'=>$have_reg_no,
					'fssai_reg_no'=>$htmlencoded_fssai_reg_no,
					'fssai_reg_docs'=>$fssai_reg_docs,
					//fields for BEVO starts
					'authorised_for_bevo'=>$authorised_for_bevo,
					'authorised_bevo_docs'=>$authorised_bevo_docs,				
					'oil_manu_affidavit_docs'=>$oil_manu_affidavit_docs, //Add By pravin 22/07/2017
					'vopa_certificate_docs'=>$vopa_certificate_docs, //Add By pravin 22/07/2017					
					'quantity_per_month'=>$html_encoded_quantity_per_month,
					'bank_references'=>$html_encoded_bank_references,
					'bank_references_docs'=>$bank_references_docs,
					//fields for BEVO end	
					'form_status'=>'saved',
					'customer_reply'=>$htmlencoded_reply,
					'customer_reply_date'=>$customer_reply_date,
					'cr_comment_ul'=>$cr_comment_ul,
					'created'=>$created,
					'modified'=>date('Y-m-d H:i:s')));
				
				if ($this->save($newEntity)){ 			
					
					return 1;
					
				};
				
			}else{	return false; }	
			
					
		}
				
		
		
		// To save 	RO/SO referred back  and MO reply comment
		public function saveReferredBackComment ($customer_id,$forms_data,$comment,$comment_upload,$reffered_back_to)
		{			
			// Import another model in this model	
			
			$logged_in_user = $_SESSION['username'];
			$current_level = $_SESSION['current_level'];
			
			$DmiOldApplicationDetails = TableRegistry::getTableLocator()->get('DmiOldApplicationCertificateDetails');
			
			$CustomersController = new CustomersController;
			$oldapplication = $CustomersController->Customfunctions->isOldApplication($customer_id);
			
			//added date function on 31-05-2021 by Amol to convert date format, as saving null
			$created_date = $CustomersController->Customfunctions->changeDateFormat($forms_data['created']);
			
			if($reffered_back_to == 'Level3ToApplicant'){
				
				$form_status = 'referred_back';
				$reffered_back_comment = $comment;
				$reffered_back_date = date('Y-m-d H:i:s');
				$rb_comment_ul = $comment_upload;
				$ro_current_comment_to = 'applicant';
				$mo_comment = null;
				$mo_comment_date = null;
				$mo_comment_ul = null;
				$ro_reply_comment = null;
				$ro_reply_comment_date = null;
				$rr_comment_ul = null;
				
			}elseif($reffered_back_to == 'Level1ToLevel3'){
				
				$form_status = $forms_data['form_status'];
				$reffered_back_comment = null;
				$reffered_back_date = null;
				$rb_comment_ul = null;
				$ro_current_comment_to = null;
				$mo_comment = $comment;
				$mo_comment_date = date('Y-m-d H:i:s');
				$mo_comment_ul = $comment_upload;
				$ro_reply_comment = null;
				$ro_reply_comment_date = null;
				$rr_comment_ul = null;
				
			}elseif($reffered_back_to == 'Level3ToLevel'){
				
				$form_status = $forms_data['form_status'];
				$reffered_back_comment = $forms_data['reffered_back_comment'];
				$reffered_back_date = $forms_data['reffered_back_date'];
				$rb_comment_ul = $forms_data['rb_comment_ul'];
				$ro_current_comment_to = 'mo';
				$mo_comment = null;
				$mo_comment_date = null;
				$mo_comment_ul = null;
				$ro_reply_comment = $comment;
				$ro_reply_comment_date = date('Y-m-d H:i:s');
				$rr_comment_ul = $comment_upload;
				
			}		
			
			$newEntity = $this->newEntity(array(
			
				'customer_id'=>$customer_id,
				'once_card_no'=>$forms_data['once_card_no'],
				'firm_name'=>$forms_data['firm_name'],
				'street_address'=>$forms_data['street_address'],
				'state'=>$forms_data['state'],
				'district'=>$forms_data['district'],
				'postal_code'=>$forms_data['postal_code'],
				'firm_email_id'=>base64_encode($forms_data['firm_email_id']),//for email encoding
				'firm_mobile_no'=>$forms_data['firm_mobile_no'],
				'firm_fax_no'=>$forms_data['firm_fax_no'],
				'business_type'=>$forms_data['business_type'],
				'business_type_docs'=>$forms_data['business_type_docs'],
				'business_years'=>$forms_data['business_years'],
				'have_reg_no'=>$forms_data['have_reg_no'],
				'fssai_reg_no'=>$forms_data['fssai_reg_no'],
				'fssai_reg_docs'=>$forms_data['fssai_reg_docs'],
				'authorised_for_bevo'=>$forms_data['authorised_for_bevo'],
				'authorised_bevo_docs'=>$forms_data['authorised_bevo_docs'],
				
				// Add new Fields oil_manu_affidavit_docs and vopa_certificate_docs by pravin 22/07/2017
				'oil_manu_affidavit_docs'=>$forms_data['oil_manu_affidavit_docs'],
				'vopa_certificate_docs'=>$forms_data['vopa_certificate_docs'],
				
				'quantity_per_month'=>$forms_data['quantity_per_month'],
				'bank_references'=>$forms_data['bank_references'],
				'bank_references_docs'=>$forms_data['bank_references_docs'],
				'created'=>$created_date,
				'modified'=>date('Y-m-d H:i:s'),
				'form_status'=>$form_status,
				'reffered_back_comment'=>$reffered_back_comment,
				'reffered_back_date'=>$reffered_back_date,
				'rb_comment_ul'=>$rb_comment_ul,
				'user_email_id'=>$_SESSION['username'],
				'user_once_no'=>$_SESSION['once_card_no'],
				'current_level'=>$current_level,
				'ro_current_comment_to'=>$ro_current_comment_to,	
				'mo_comment'=>$mo_comment,
				'mo_comment_date'=>$mo_comment_date,
				'mo_comment_ul'=>$mo_comment_ul,
				'ro_reply_comment'=>$ro_reply_comment,
				'ro_reply_comment_date'=>$ro_reply_comment_date,
				'rr_comment_ul'=>$rr_comment_ul
				
			));
			
			if($this->save($newEntity)){ 
			
				if($oldapplication == 'yes'){
                                    
                                        $old_certificate_details = $DmiOldApplicationDetails->oldApplicationCertificationDetails($customer_id);
                                        
					$DmiOldApplicationDetailsEntity = $DmiOldApplicationDetails->newEntity(array(											
                                            'id'=>$old_certificate_details['id'],
                                            'old_certificate_pdf'=>$old_certificate_details['old_certificate_pdf'],
                                            'old_application_docs'=>$old_certificate_details['old_application_docs'],
					));
						
					if($DmiOldApplicationDetails->save($DmiOldApplicationDetailsEntity)){ return true;  } 
					
				}else{ return true; } 
			}

		}


		public function postDataValidation($customer_id,$forms_data){
		//	print_r($forms_data); exit;
			$returnValue = true;
			$DmiChangeSelectedFields = TableRegistry::getTableLocator()->get('DmiChangeSelectedFields');
			$selectedfields = $DmiChangeSelectedFields->selectedChangeFields();
			$selectedValues = $selectedfields[0];
			
			$CustomersController = new CustomersController;
			$firm_type = $CustomersController->Customfunctions->firmType($customer_id);
						
			if(in_array(1,$selectedValues) && empty($forms_data['firm_name'])){ $returnValue = null ; }
			
			if(in_array(2,$selectedValues)){ 
			
				if(empty($forms_data['mobile_no']) || empty($forms_data['email_id']) || empty($forms_data['phone_no'])){
					$returnValue = null ; 
				}
			
			}	
			if(in_array(5,$selectedValues)){ 
			
				if(empty($forms_data['premise_street']) || empty($forms_data['premise_state']) || empty($forms_data['premise_city']) || empty($forms_data['premise_pin'])){
					$returnValue = null ; 
				}
			
			}	
			if(in_array(6,$selectedValues)){ 
			
				if(empty($forms_data['lab_name']) || empty($forms_data['lab_type'])){
					$returnValue = null ; 
				}
			
			}
			if(in_array(7,$selectedValues)){ 
			
				if ($firm_type==1 || $firm_type==3) {
					if(empty($forms_data['comm_category']) || empty($forms_data['selected_commodity'])){
						$returnValue = null ; 
					}
				}
				if ($firm_type==2) {
					if(empty($forms_data['packing_types'])){
						$returnValue = null ; 
					}
					
				}
				
			
			}
			
			return $returnValue;
			
		}

} ?>