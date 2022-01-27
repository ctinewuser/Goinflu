<!---Go--->
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Base_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library("pagination");
        $this->load->helper('common');
        $this->load->library('Paypal_lib');
        $this->load->helper(array('form','url','common')); 
	}
   
    
    public function resetPassword()
  {

    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('confPassword', 'Password Confirmation', 'required|matches[password]');
    if ($this->form_validation->run() == FALSE)
    {

      $data['title'] = 'Reset Password';
      $this->frontHtml('Eula', 'forget_password', $data);
    }
    else
    {

       if(!empty($_POST['gettoken'])){
         $exp = explode('_', $_POST['gettoken']);
        
         $getuser = $this->common->getData('user',array('token'=>$exp[0],'id'=>$exp[1]),array('single'));
        
        if(!empty($getuser)){
           $_POST['password'] = md5($_POST['password']);
           print_r("hellogoinflu");
         
            $update = $this->common->updateData('user', array('token' => "", 'password' => $_POST['password']), array('id' => $exp[1]));

             $this->session->set_flashdata('success', "Your Password Changed Successfully");
            redirect(base_url('home/resetPassword?token='));
        }else{

            $this->session->set_flashdata('error', 'Link expired. Please reset password again');
            redirect(base_url('home/resetPassword?token='.$_POST['gettoken']));
        }
         
       }else {

         $this->session->set_flashdata('error', 'Link expired. Please reset password again');
            redirect(base_url('home/resetPassword?token='.$_POST['gettoken']));
      }

  
    }
  }
  public function forgetPassword()
{
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    if ($this->form_validation->run() == FALSE)
    {
      $data['title'] = 'Forget Password';
      //$this->load->view('admin_header');
      $this->frontHtml('Eula', 'forget_password', $data);
    }
    else
    {
      $user = $this->session->userdata('user');
      
      $type = $_POST['user_type'];
      
      if($type=="User")
      {
        $data = $this->common->getData('user', array('email' => $_POST['email']), array('single'));
      }
     

    if (!empty($data))
      {
        $token = $this->generateToken();
    $data['token'] = $data['id'] . $token;
        $data['name'] = $data['full_name'];
        $data['user_type'] = $data['user_type'];

        if($data['user_type']=="User")
        {
          $this->common->updateData('user', array('token' => $data['token']), array('id' => $data['id']));
        }
       
        $message = $this->load->view('template/reset-mail', $data, true);
        $mail = $this->common->sendMail($_POST['email'], 'Forgot Password', $message);
        if($mail)
        {
          $this->flashMsg('success', "Please check your email with instruction to reset your password. If you Don't receive this e-mail, please check your junk mail folder or contact us for further assistance.");
          redirect(base_url('home/forgetPassword'));
        }
        else
        {
          $this->flashMsg('danger', "Some error occured. Please try again");
          redirect(base_url('home/forgetPassword'));
        }
      }
      else
      {
        if($type=="User")
        {
          $this->flashMsg('danger', "Email does not belong to any account.");
          redirect(base_url('home/forgetPassword_customer'));
        }
       
      }
    }
  }
	public function index()
	{
	    $data['tittle'] = 'Home page';
		$this->frontHtml('artist_army','index',$data);
			//redirect(base_url('admin_login'));
	}
	public function privacy()
	{
	    $data['tittle'] = 'privacy page';
	    $data['privacy'] = $this->common->getData('contact_about',array('id'=>4),array('single'));
		$this->frontHtml('artist_army','privacy',$data);
	}
	public function terms()
	{
	    $data['tittle'] = 'teams page';
	    $data['terms'] = $this->common->getData('contact_about',array('id'=>3),array('single'));
		$this->frontHtml('artist_army','terms',$data);
	}
	public function contact()
	{
	    $data['tittle'] = 'Contact page';
		$this->frontHtml('artist_army','contact',$data);
	}
	public function aboutUs()
	{
        $data['tittle'] = 'About page';
		$this->frontHtml('artist_army','aboutus',$data);
	}

    public function paymentdata(){
        $paypal =  json_decode(file_get_contents('php://input'), true);

        if(!empty($paypal)){
                $date=date("Y-m-d H:i:s");
                $data['txn_id']=$paypal["txn_id"];
                $data['payment_gross']=$paypal["payment_gross"];
                $data['currency_code']=$paypal["currency_code"];
                $data['payer_email']=$paypal["payer_email"];
                 $data['payer_name']=$paypal["payer_name"];
                $data['status']=$paypal["status"];
                $data['user_id']=$paypal["user_id"];
                $data['bitpack_id']=$paypal["bitpack_id"];
                $data['created_at']=$date;

                $insert = $this->common->insertData('payments', $data);

                if($data['status'] =="Completed"){

                $select =   $this->common->getData('bitpack_users', array('user_id' => $data['user_id']), array('sort_by'=>'id','sort_direction'=>'desc','single'));
                $total_donatebit = "";
                $selectb =   $this->common->getData('bit_pack', array('id' => $data['bitpack_id']), array('single'));

                  if(!empty($select)){
                    $total_donatebit = ($select['total_donate_bit']+$selectb['amount_in_bit']);
                  }else{
                    $total_donatebit = $selectb['amount_in_bit'];
                  }

                $array = array("bit_pack_id"=>$data['bitpack_id'], "bit_pack_amount"=>$selectb['amount_in_bit'], "total_donate_bit"=>$total_donatebit, "user_id"=>$data['user_id']);

                $insert = $this->common->insertData('bitpack_users', $array);
                $insertid = $this->db->insert_id();

                }
                
                //json_encode($data);
            }
    }
	
    public function ipn(){
            
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = $ipnCheck;
        fwrite($myfile,"testing");
        fclose($myfile);

        $paypalInfoo = $_REQUEST;
        $paypalInfoo1=json_encode($paypalInfoo);
        
        if(!empty($paypalInfoo)){
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfoo);
           
            if($ipnCheck){
                $date=date("Y-m-d H:i:s");
                $data['txn_id']=$paypalInfoo["txn_id"];
                $data['payment_gross']=$paypalInfoo["mc_gross"];
                $data['currency_code']=$paypalInfoo["mc_currency"];
                $data['payer_email']=$paypalInfoo["payer_email"];
                $data['status']=$paypalInfoo["payment_status"];
                $data['created_at']=$date;

                $insert = $this->common->insertData('payments', $data);
                json_encode($data);
            }
        }
    }
public function success(){
 // [PayerID] => 5ZH3BGEVYHBUS [payer_email] => sb-tsp6h7437792@business.example.com [payer_id] => 5ZH3BGEVYHBUS [payer_status] => VERIFIED [first_name] => John [last_name] => Doe [address_name] => John Doe [address_street] => 1 Main St [address_city] => San Jose [address_state] => CA [address_country_code] => US [address_zip] => 95131 [residence_country] => US [txn_id] => 3NY32840RF6131614 [mc_currency] => USD [mc_fee] => 27.97 [mc_gross] => 600.00 [protection_eligibility] => ELIGIBLE [payment_fee] => 27.97 [payment_gross] => 600.00 [payment_status] => Completed [payment_type] => instant [handling_amount] => 0.00 [shipping] => 0.00 [item_number] => 1 [quantity] => 1 [txn_type] => web_accept [payment_date] => 2021-08-31T13:36:31Z [business] => sb-accm77447157@business.example.com [receiver_id] => J6TNW5SSYLWTA [notify_version] => UNVERSIONED [verify_sign] => A6oZ6iWntv6rjL--ROQD20z5knrJAqFSe6kTEQRptNpakXoOsqcE.NTJ )

        $paypalInfo = $_REQUEST;
       // print_r($paypalInfo);
        $data['user_id']      = $paypalInfo['user_id'];
        $data['payment_gross']    = $paypalInfo['payment_gross'];
        $data['txn_id']         = $paypalInfo["txn_id"];
        $data['payer_name']    = $paypalInfo["payer_name"];
        $data['currency_code']  = $paypalInfo["currency_code"];
        $data['payment_status']         = $paypalInfo["payment_status"];
         $data['address_name']         = $paypalInfo["address_name"];
        $data['payer_id'] =   $paypalInfo["payer_id"];
        $data['payer_email'] =  $paypalInfo["payer_email"];

        $this->frontHtml('Eula','success',$data);
        //$this->load->view('PaymentDoneByPayPal://host/PaymentDone',$data);
        //header("Location : PaymentDoneByPayPal://host/PaymentDone");
        // redirect('https://ctinfotech.com/CTCC/artist_army/deeplinking/success.php');
    }
     public function cancel(){
        $this->frontHtml('Eula','cancel');
        //header("Location : PaymentDoneByPayPal://host/PaymentCancel");
        //$this->load->view('PaymentDoneByPayPal://host/PaymentCancel');
     }


}

