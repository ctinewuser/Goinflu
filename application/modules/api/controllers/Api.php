 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
class Api extends Base_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->library('Paypal_lib');
        $this->load->model('product');
        $this->data = json_decode(file_get_contents("php://input"));
    }
  
      /////Signup Api///
      public function signup_email() {
        if (!empty($_POST['email'])) {
            $rand = rand(1000, 9999);
            $_POST['otp'] = (string)$rand;
            $this->response(true, "First Step Done Succesfully!", array('userinfo' => array('email' => $_POST['email'], 'otp' => $_POST['otp'])));
        } else {
            $this->response(false, " Invalid detail, please try again.");
        }
    }

////////Test Notification
      public function testnoti(){
        $user_id = $_POST['user_id'];
         $send_all = $this->common->send_all_notification($user_id,"hello ",$type,$data=array());

         print_r($send_all);
      }


    public function signup() {
        if (!empty($_POST['email'])) {

            $_POST['status'] = 1;
            $_POST['created_at'] = date('Y-m-d H:i:s');
            $_POST['password'] = md5($_POST['password']);
            $_POST['profile_image'] = 'dummy.png';
            $exist2 = $this->common->getData('user', array('email' => $_POST['email']), array('single'));
            if ($exist2) {
                $this->response(false, "Email already exist");
                die;
            } else {
                $post = $this->common->getField('user', $_POST);
                $result = $this->common->insertData('user', $post);
                $user_id = $this->db->insert_id();
                if ($user_id) {
                    $user = $this->common->getData('user', array('id' => $user_id), array('single'));
                    $this->response(true, "Signup Succesfully!");
                } else {
                    $this->response(false, " Invalid details, please try again.");
                }
            }
        } else {
            $this->response(false, " Invalid details, please try again.");
        }
    }

 
    //////////////////////////////forgot_passowrd//////////////////////
        public function otp_verification() {
        if (!empty($_POST['otp'])) {
            $this->response(true, "OTP Verified!", array('userinfo' => array('email' => $_POST['email'], 'otp' => $_POST['otp'])));
        } else {
            $this->response(false, " Invalid detail, please try again.");
        }
    }

    public function forgot_passowrd()
        {
         $subject = "";

        if(!empty($_REQUEST['email']))
            {
            $email=$_REQUEST['email'];
            $type = $_REQUEST['type'];
            if($type == 0)
            {
                $subject = "Forgot password";

            }else{
              $subject = "Change password";   
            }
           /*  $rand = rand(1000, 9999);
            $_POST['otp'] = (string)$rand;*/
            $result = $this->common->getData('user',array('email'=>$_REQUEST['email'],'status'=>'1'),array('single'));  
                if(empty($result))
                {
                    $this->response(false,"Invalid Email. Please try again.");
                }else{
                    $email=$_POST['email'];
                  
                    $result['token'] = $this->generateToken();
                    $this->common->updateData('user',array('token'=>$result['token']),array('id' => $result['id']));
             $message = $this->load->view('template/reset-mail', $result, true);
                $this->common->sendMail($email,$subject,$message);
                  
                    $this->response(true, "Link has been sent to your Email , Please Check your Email ", array("userinfo" => $result));
                }
            }
            else
            {
             $this->response(false,"Missing parameter");
            }
        }
    
    //////////////////////////////// login //////////////////////////////
   public function login() {
        $_POST['password'] = md5($_POST['password']);
        $result = array();
        $where = "password = '" . $_POST['password'] . "' && email = '".$_POST['email']."' ";
        $result = $this->common->getData('user', $where, array('single'));
      
        if ($result) {  
        $this->common->updateData('user', array( 'fcm_token' => $_REQUEST['fcm_token']),array('id' => $result['id']));
            $result['fcm_token'] = $_REQUEST['fcm_token'];
         $this->response(true, 'Successfully Login', array("userinfo" => $result));
        } else {
            $message = "Invalid Email Or Password!";
            $this->response(false, $message, array("userinfo" => (object) array()));
        }
    }


  ////////Update User Profile//////


    public function update_profile() {
        $result = $this->common->getData('user', array('id' => $_POST['user_id']), array('single'));
        if ($result) 
        {
           // if(!empty($_POST['password'])){
           //   $_POST['password'] = md5($_POST['password']);
           // }
      
                 if (!empty($_FILES['profile_image']['name'])) {
                    $pro_image = $this->common->do_upload('profile_image', './assets/userfile/profile');
                    if (isset($pro_image['upload_data'])) {
                        $_POST['profile_image'] = $pro_image['upload_data']['file_name'];
                          $image_name = $_POST['profile_image'];

                    }
                }else if(!empty($result['profile_image'])){
                   $_POST['profile_image'] = $result['profile_image'];
                }else{
                    $_POST['profile_image'] = "dummy.png";
                }
                if(!empty($_POST['language']) && $_POST['language']!= 'null'){
               $_POST['language_id']=$_POST['language'];
           }
             $post = $this->common->getField('user', $_POST);
            $info = $this->common->updateData('user', $post, array('id' => $_POST['user_id']));
            $this->db->select('U.*');
            $this->db->from('user as U');
            $this->db->where('U.id', $_POST['user_id']);
            $query = $this->db->get();
            $user = $query->result_array()[0];
            
             $select =   $this->common->getData('user', array('id' => $_POST['user_id']), array('sort_by'=>'id','sort_direction'=>'desc','single'));
            $this->response(true, "Your Profile Is Updated Sucessfully,Thank You.", array('userinfo' => $user));
        } else {
            $this->response(false, "There Is a Problem, Please Try Again.", array('userinfo' => (object)array()));
        }
    }

    //////Get user  & influencer  Profile///

      public function getProfile()
      {
      $user_id= $_POST['user_id'];
      $user =   $this->common->getData('user', array('id' =>$user_id), array('single'));  

       $language_id = $user['language_id'];
      if(!empty($language_id)){
       $explode = explode(",",$language_id);
       foreach ($explode as $key => $value) {
        $val[] = language_name($value);
       }
   }
        $implode = implode(",",$val);
       $user['language']=$implode; 
     if ($user) {
            $this->response(true, "User Profile Fetch Successfully", array("userinfo" =>  array($user)));
        } else {
            $this->response(false, "There Is a Problem, Please Try Again.", array("userinfo" => array()));
        }
    }


  /////
////////Update Influencer Profile//////


    public function update_influencer_profile() {
         
        $result = $this->common->getData('user', array('id' => $_POST['user_id']), array('single'));

        if ($result) 
        {
           // if(!empty($_POST['password'])){
           //   $_POST['password'] = md5($_POST['password']);
           // }
            if (!empty($_FILES['profile_image']['name'])) {
                    $pro_image = $this->common->do_upload('profile_image', './assets/userfile/profile');
                    if (isset($pro_image['upload_data'])) {
                        $_POST['profile_image'] = $pro_image['upload_data']['file_name'];
                          $image_name = $_POST['profile_image'];

                    }
                }else if(!empty($result['profile_image'])){
                   $_POST['profile_image'] = $result['profile_image'];
                }else{
                    $_POST['profile_image'] = "dummy.png";
                }
                  if(!empty($_POST['language']) && $_POST['language']!= 'null'){
               $_POST['language_id']=$_POST['language'];
           }
              
             $post = $this->common->getField('user', $_POST);
            $info = $this->common->updateData('user', $post, array('id' => $_POST['user_id']));
            $this->db->select('U.*');
            $this->db->from('user as U');
            $this->db->where('U.id', $_POST['user_id']);
            $query = $this->db->get();
            $user = $query->result_array()[0];
            
             $select =   $this->common->getData('user', array('id' => $_POST['user_id']), array('sort_by'=>'id','sort_direction'=>'desc','single'));
            $this->response(true, "Your Infuencer Profile Is Updated Sucessfully.", array('userinfo' => $user));
        } else {
            $this->response(false, "There Is a Problem, Please Try Again.", array('userinfo' => (object)array()));
        }
    }

    
  /////



  public  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

   ///////Post Apis////

      public function add_post()
       {
        if (!empty($_POST['user_id'])) {
      $description =  $_POST['description'];
      if($description !='' || $_FILES['images']['name']!="")
      {
            $_POST['created_at'] = date('Y-m-d H:i:s');
            $post = $this->common->getField('post', $_POST);
            $result = $this->common->insertData('post', $post);
            $postid = $this->db->insert_id();

            $image_name = "" ;

            if ($_FILES['images']['name'] != "") {  
            $image = $this->common->do_upload('images', './assets/post/');


            if (isset($image['upload_data'])) {
            $_POST['images'] = $image['upload_data']['file_name'];
              $image_name = $_POST['images'];
            }

            $res = $this->common->insertData('post_image', array('user_id' => $_POST['user_id'], 'post_id' => $postid, 'image' => $image_name , 'created_at'=>date('Y-m-d H:i:s')));
            } 
            $this->response(true, "Post successfully added,Thank You!");
            }else {
            $this->response(false, "Please enter image/description to upload the post..!");
            exit();
            } 
            }else {
            $this->response(false, "User Id field is required");
            exit();
            }

            }
    public function delete_post()
            {
                $user_id = $_POST['user_id'];
                $post_id = $_POST['post_id'];
         $check_post = $this->common->getData('post', array('id' => $post_id , 'user_id' => $user_id));
               if($check_post)
               {
                  $result = $this->common->deleteData('post', array('id' => $post_id , 'user_id' => $user_id));
                $this->common->deleteData('post_image', array('post_id' => $post_id ));

                 if (!empty($result)){    
                    $this->response(true, "Successfully! user post deleted");
                    } else {
                    $this->response(true, "Please Check Id");
                    }
               }else{
                 $this->response(true, "No record found");
               }        
            }
    public function post_list()
    {
        $arr = array();
        $key0 = "";   
        $limit = $offset= '';
        $page_count = $_POST['page_count'];
        if($_POST['start'] == 0){
             $offset  = ($_POST['start']+$page_count);
             $limit = 0;
        }
        if($_POST['start'] != 0){
             $limit  = $_POST['start'];
             $offset = ($_POST['start']+ $page_count);
        }
        $post_list = $this->common->post_list($_POST['user_id'],$limit,$offset,$page_count);
        if (!empty($post_list)) {
            foreach ($post_list as $key => $value) {
                $value['chat_charge'] =   $value['chat_charge'];
                $value['datetime'] =  $this->time_elapsed_string($value['created_at']);
                $r = $this->common->getData('post_image', array('post_id' => $value['id']), array('', 'field' => 'image'));
                if (!empty($r)) {
                    $value['post_images'] = $r;
                } else {
                    $value['post_images'] = array();
                } 
                if (!empty($_POST['post_id']) && $_POST['post_id'] == $value['id']) {
                    $key0 = $value;
                    unset($value);
                }
                if (!empty($value)) {
                    $arr[] = $value;
                }
            }
            if (!empty($key0)) {
                array_unshift($arr, $key0);
            }
            $this->response(true, "Post List", array('post_list' => $arr));
        } else {
            $this->response(true, "Post List.", array('post_list' => array()));
        }
    }

     public function add_post_comment() {
        $_POST['created_date'] = date('Y-m-d');
        $_POST['created_time'] = date('H:i:s');

        $post_list = $this->common->add_post_comment($_POST['post_id']);

        if(!empty($post_list)){
             if ($_POST['comment_id']) {
            $_POST['refer_id'] = $_POST['comment_id'];
            $_POST['sender_id'] = $_POST['user_id'];
            $_POST['reciever_id'] = $post_list['user_id'];
        } else {
            $_POST['refer_id'] = 0;
            $_POST['reciever_id'] = $_POST['user_id'];
        }
        unset($_POST['comment_id']);
        
      
       // 
         
        $post = $this->common->getField('post_comment', $_POST);

        $result = $this->common->insertData('post_comment', $post);
        if (!empty($result)) {
            $id = $this->db->insert_id();
            $comment = $this->common->getData('post_comment', array('post_id' => $_POST['post_id']), array());
            $count = count($comment);
            $upcomment = $this->common->updateData('post', array('total_comment' => $count), array('id' => $_POST['post_id']));
            $this->response(true, "Successfully Comment Added");
        } else {
            $this->response(false, "No Comments Yet!");
        }

    }else{
         $this->response(false, "Post id not found,Please check!");
    }
     }


       public function post_all_comments() {
        $user_id = $_POST['user_id'];
        $post_comments = $this->common->getcomment($_POST['post_id'], $user_id);
      
        if ($post_comments) {
            $this->response(true, "Post List", array('post_comment' => $post_comments, 'total_comment' => count($post_comments)));
        } else {
            $this->response(true, "There is a problem, please try again.", array('post_comments' => array()));
        }
    }


     public function post_comment_list()
     {
               $post_id = $_POST['post_id'];
       $data = $this->common->getdata('post_comment', array('post_id' => $post_id), array());
       if (!empty($data)) {
              
            $this->response(true, "Post Comment List", array('post_comment_list' => $data));
        } else {
            $this->response(true, "Post Comment List", array('post_comment_list' => array()));
        } 
     }
 public function user_list()
    { 
         //$type = $_POST['user_type'];
       $data = $this->common->getdata('user', array('user_type' => 0), array());
       if (!empty($data)) {
              
            $this->response(true, "Users List", array('user_list' => $data));
        } else {
            $this->response(true, "Users List", array('user_list' => array()));
        }
    } 
    public function influencer_list()
    { 

                $data = $this->common->getdata('user', array('user_type' => 1 ), array());
                $allData= array() ;

                foreach ($data as $key => $value) {
                $all_lang = array() ;
                $language =  explode(',',$value['language_id']) ;
                if($value['language_id']!='' && $value['language_id']!=0){

                foreach ($language as $key => $val) {

                $getlanguage = $this->common->getSingleRowById('language','id',$val,'array');

                $all_lang[] = ['id'=>$getlanguage['id']  , 
                'name'=>$getlanguage['name'],

                'image'=>base_url('assets/flag/').$getlanguage['image'],
                ] ;
                }

                }
                $allData[] =[  "id" => $value['id'] ,         
                "password" => $value['password'] ,       
                "email" => $value['email'] ,         
                "full_name" => $value['full_name'] ,        
                "language_data"=>  $all_lang, 
                "user_type" => $value['user_type'] ,        
                "chat_charge" => $value['chat_charge'] ,       
                "post_charge" => $value['post_charge'] ,       
                "video_call_charge" => $value['video_call_charge'] ,       
                "euro_sign" => $value['euro_sign'] ,     
                "device_type" => $value['device_type']   ,
                "profile_image" => $value['profile_image']   ,   
                "fcm_token" => $value['fcm_token']      ,
                "token" => $value['token']       ,
                "social" => $value['social']      ,
                "facebook" => $value['facebook']   ,  
                "otp" => $value['otp']       ,
                "status" => $value['status']     ,
                "notification_status" => $value['notification_status']    ,
                "total_like" => $value['total_like']  ] ;
                }

                if (!empty($data)) {

                $this->response(true, "Influencer List", array('influencer_list' => $allData));
                } else {
                $this->response(true, "Influencer List", array('influencer_list' => array()));
                }
    } 


     public function search_influencer()
     {
       $user_id = $_POST['user_id'];
        $user = $this->common->getData('user', array('id' => $user_id), array('single'));
          if (!empty($user)) {
            $search = $_POST['search'];
            $userinfo = $this->common->influencer_search($user_id,$search);
            
            if (!empty($userinfo)) {
                $this->response(true, "Fetch influencer Successfully!", array("userinfo" => $userinfo));
            } else {
                $this->response(false, "No Influencer found");
            }
        } else {
            $this->response(false, "User Id field is mandatory", array("userinfo" => array()));
        
        }

     }

   
   /////////////////Get Notification ///
    public function get_notification() {
        $user_id = $_POST['user_id'];
        $data = $this->common->getData('notification', array('user_id' => $user_id), array('sort_by' => 'created_at', 'sort_direction' => 'desc'));
        if (!empty($data)) {
            $this->response(true, "Notification fetch Successfully", array('notification' => $data));
        } else {
            $this->response(false, "No notification found");
        }
    }
    
     public function get_notification_by_date() {
        $user_id = $_POST['user_id'];
        $array = array();

         $limit = $offset= '';
         $page_count = $_POST['page_count'];

        if($_POST['start'] == 0){
             $offset  = ($_POST['start']+$page_count);
             $limit = 0;
        }
        if($_POST['start'] != 0){
             $limit  = $_POST['start'];
             $offset = ($_POST['start']+ $page_count);
        }
         $notification = $this->common->get_notification_by_date($user_id,$limit,$offset,$page_count);

        if (!empty($notification)) {
            foreach ($notification as $key => $value){ 
                 $data1 = $this->common->getData('notification', array('user_id' => $user_id,'created_at'=>$value['created_at']), array('sort_by' => 'notification_id','sort_direction' => 'desc'));
                    
                       if(!empty($data1)){
                            $arr['date'] = $value['created_at'];
                            $arr['data'] = $data1;
                            $array[] = $arr;
                       }
            }
         
            $this->response(true, "Notification fetch Successfully", array('notification' => $array));
        } else {
            $this->response(true,"Notification fetch Successfully", array('notification' => array()));
        }
    }


    /////End Notification////

    //////////////////post_like///////////
        public function post_like() {
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        $_POST['created_date'] = date('Y-m-d');
        $_POST['created_time'] = date('H:i:s');
        $count = 0;
        $message = "";
        $likedata = $this->common->getData('post_like', array('user_id' => $user_id, 'post_id' => $post_id), array('single'));

        $postdata = $this->common->getData('post', array('id' => $post_id), array('single'));
        if (!empty($likedata)) {
            $result = $this->common->deleteData('post_like', array('like_id' => $likedata['like_id']));
            if ($postdata['total_like'] > 0) {
                $count = $postdata['total_like'] - 1;
            } else {
                $count = $postdata['total_like'];
            }
            $message = "Dislike Post";
            $test = 2;
        } else {
            $post = $this->common->getField('post_like', $_POST);
            $result = $this->common->insertData('post_like', $post);
            $count = $postdata['total_like'] + 1;
            $message = "Like Post";
            $test = 1;
           
        }
        $update = $this->common->updateData('post', array('total_like' => $count), array('id' => $post_id));

        if (!empty($update)) {

            if($test == 1){
                $user_detail = user_detail($_POST['user_id']);
             $sendnoti =  $this->common->send_all_notification($postdata['user_id'],ucwords($user_detail['full_name'])." liked your post","Like",'1',array('refer_id'=>$_POST['post_id']));
            }
            $this->response(true, $message, array('count' => $count));
        } else {
            $this->response(false, "There is a problem, please try again.", array('count' => $count));
        }
    }   
    ///////////////////////////Leave Group ////////////////////////
    public function user_chat_messages() {
        $user_id = $_POST['user_id'];
        $receiver_id = $_POST['receiver_id'];
        $arr = array();
        if (!empty($user_id)) {
            $where = " (sender_id = '" . $user_id . "' and receiver_id = '" . $receiver_id . "') OR  (receiver_id = '" . $user_id . "' and sender_id = '" . $receiver_id . "') ";
        
             $chat_messages = $this->common->getData('chat_messages', $where, array('sort_by'=>"messages_id",'sort_direction'=>"ASC"));
           // print_r($chat_messages);
           //  die;
             if(!empty($chat_messages)){
                foreach ($chat_messages as $key => $value) {
                     if (!empty($value['messages'])) {

                        if($value['type'] > 0){

                             $value['messages'] = base_url().$value['messages'];
                        }
                      
                    }
                    $arr[] = $value;
                }
             }
            $this->response(true, "Fetch messages Successfully!", array("chat_messages" => $arr));
        } else {
            $this->response(false, "No message found", array("chat_messages" => array()));
        }
    }
    public function chat_users() {
        $arr = array();
        $key0 = "";   
        $limit = $offset= '';
        $page_count = $_POST['page_count'];
        if($_POST['start'] == 0){
             $offset  = ($_POST['start']+$page_count);
             $limit = 0;
        }
        if($_POST['start'] != 0){
             $limit  = $_POST['start'];
             $offset = ($_POST['start']+ $page_count);
        }
        $user_id = $_POST['user_id'];
        $chats = array();
        $cmessages = array();
        if (!empty($user_id)) {
            $cwhere = " receiver_id = '" . $user_id . "'";
            $cmessages = $this->common->getData('chat_messages', $cwhere, array('field'=>'sender_id as id, sender_name as full_name, sender_image as profile_image','group_by'=>'id','sort_by'=>'messages_id','sort_direction'=>'desc'));
            $user = $this->common->getData('user', array('id' => $user_id), array('single'));
         $chat_users =  $this->common->chat_users($user_id,$user['user_type']);
            if (!empty($chat_users)) {
                if(!empty($cmessages)){
                $array1 = array_merge($cmessages, $chat_users);
                $ids = array_column($array1, 'id');
                $ids = array_unique($ids);
                $array = array_filter($array1, function ($key, $value) use ($ids) {
                    return in_array($value, array_keys($ids));
                }, ARRAY_FILTER_USE_BOTH);
                }else{
                           $array = $chat_users;
                }
            if(!empty($page_count)){
                 $array =  array_splice($array,$limit,$offset);
            
              }
                foreach ($array as $key => $value) {

                     $lwhere = "(sender_id = '" . $value['id'] . "') OR  (receiver_id = '" . $value['id'] . "')";  

                     $chat_messages = $this->common->getData('chat_messages',$lwhere, array('sort_by'=>'messages_id','sort_direction'=>'desc','limit'=>1,'single'));

                    if (!empty($chat_messages['messages'])) {

                        if($chat_messages['type'] > 0){

                          /*    $value['messages'] = base_url().$chat_messages['messages'];*/
                        }else{
                              $value['messages'] = $chat_messages['messages'];
                        }
                      
                    } else if (!empty($chat_messages['image'])) {
                        $value['messages'] = "Photo";
                    } else {
                        $value['messages'] = "";
                    }
                    $value['datetime'] = $value['datetime'] = !empty($chat_messages['datetime']) ? $chat_messages['datetime'] : "";
                    $value['count'] = 0;
                    $chats[] = $value;
                }
                $this->response(true, "Fetch messages Successfully!", array("chat_users" => $chats));
            } else {
                $this->response(false, "No chat user found", array("chat_users" => array()));
            }
        } else {
            $this->response(false, "user Id field is mandatory", array("chat_users" => array()));
        }
    }
       /////Recent Chat , Post //
    public function recent_post()
    {
        $user_id= $_POST['user_id'];
       
        $recent_post = $this->common->getData('post',array('user_id'=>$user_id), array('sort_by'=>'created_at','sort_direction'=>'desc'));
        $recent_postDetail = array();
        foreach ($recent_post as $key => $value) {
         $user = $this->common->getSingleRowById('user','id',$value['user_id'],'array');
         $post_image = $this->common->getSingleRowById('post_image','post_id',$value['id'],'array');
         ///=========================
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($value['created_at']);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
        $vardate = date('Y-m-d',strtotime($value['created_at']));
        $getDAte = '' ;
        if($vardate === date('Y-m-d')){
        $getDAte = $interval->format(' %h hours ago');
        }else{
          $getDAte = $interval->format(' %a days ');
        }
        //===========================
        $recent_postDetail[]= [ 
          'user_id'=>$value['user_id'],  
        'full_name'=>$user['full_name'],
       'user_image'=>base_url('assets/userfile/profile/').$user['profile_image'],
         'time'=>$getDAte,
        // 'post_details'=>$value,
        ];
     }  
     if (!empty($recent_post)) {
                $this->response(true, "Recent User Post List", array('recent_list' => $recent_postDetail));
        } else {
            $this->response(true, "There is a problem, please try again.", array('post_list' => array() ));
        }
    }

    public function recent_chat()
    {
        $user_id= $_POST['user_id'];
        $recent_chat = $this->common->getData('chat_schdule',array('chat_by'=>$user_id), array('sort_by'=>'created_at','sort_direction'=>'desc'));
        $chatDetail = array();
        foreach ($recent_chat as $key => $value) {
       $user = $this->common->getSingleRowById('user','id',$value['chat_by'],'array');
       $influencer = $this->common->getSingleRowById('user','id',$value['chat_with'],'array');
        $chatBy = $this->common->getSingleRowById('user','id',$value['chat_by'],'array');
        $chatTo = $this->common->getSingleRowById('user','id',$value['chat_with'],'array');
         ///=========================
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($value['created_at']);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
        $vardate = date('Y-m-d',strtotime($value['created_at']));
        $getDAte = '' ;
        if($vardate === date('Y-m-d')){
        $getDAte = $interval->format(' %h hours ago');
        }else{
          $getDAte = $interval->format(' %a days ');
        }
        //===========================
        $chatDetail[]= [ 
           'user_id'=>$value['chat_by'],  
           // 'full_name'=>$chatBy['full_name'],
           'influenecer_id'=>$value['chat_with'],  
           'full_name'=>$chatTo['full_name'],
           'user_image'=>base_url('assets/userfile/profile/').$influencer['profile_image'],
           'time'=>$getDAte,   
        ];
     }  
     if (!empty($recent_chat)) {
            $this->response(true, "Recent Chat List", array('recent_list' => $chatDetail));
        } else {
            $this->response(true, "There is a problem, please try again.", array('chat_list' => array() ));
        }
    }
    public function recent_video()
    {
      $user_id= $_POST['user_id'];
        $recent_video = $this->common->getData('video_schdule',array('video_call_by'=>$user_id), array('sort_by'=>'created_at','sort_direction'=>'desc'));
        $videoDetail = array();
        foreach ($recent_video as $key => $value) {
        $user = $this->common->getSingleRowById('user','id',$value['video_call_by'],'array');
        $influencer = $this->common->getSingleRowById('user','id',$value['video_call_with'],'array');
        $videoBy = $this->common->getSingleRowById('user','id',$value['video_call_by'],'array');
        $videoTo = $this->common->getSingleRowById('user','id',$value['video_call_with'],'array');
     
         ///=========================
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($value['created_at']);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
        $vardate = date('Y-m-d',strtotime($value['created_at']));
        $getDAte = '' ;
        if($vardate === date('Y-m-d')){
        $getDAte = $interval->format(' %h hours ago');
        }else{
          $getDAte = $interval->format(' %a days ');
        }
        //===========================
        $videoDetail[]= [ 
           'user_id'=>$value['video_call_by'],  
           // 'full_name'=>$videoBy['full_name'],
           'influenecer_id'=>$value['video_call_with'],  
           'full_name'=>$videoTo['full_name'],
           'user_image'=>base_url('assets/userfile/profile/').$influencer['profile_image'],
           'time'=>$getDAte,   
        ];
     }  
     if (!empty($recent_video)) {
            $this->response(true, "Recent Video List", array('recent_list' => $videoDetail));
        } else {
            $this->response(true, "There is a problem, please try again.", array('video_list' => array() ));
        }
    }
    //////Influencer Post List by id/////

      public function influencer_post_list() {
        $userid = $_POST['user_id'];
        $post_list = $this->common->influ_post_list($_POST['user_id'],$_POST['influencer_id']);
        $follower_count = $this->common->getData('follower', array('influencer_id'=>$_POST['influencer_id']), array('count'));
       
        $following_count = "0";

        if (!empty($post_list)) {
              $i = 0;
            foreach ($post_list as $key => $value) {

                $r = $this->common->getData('post_image', array('post_id' => $value['id']), array('', 'field' => 'image'));
                if (!empty($r)) {
                    $post_list[$key]['post_images'] = $r;
                } else {
                    $post_list[$key]['post_images'] = array();
                }
                $follower_status = $value['follower_status'];
                $i++;
            }

        $this->response(true, "Post List", array('post_list' => $post_list ,'post_count'=>"$i" , 'followers_count'=> "$follower_count" ,'following_count'=>$following_count,'follower_status'=>$follower_status ));
        } else {
            $this->response(true, "There is a problem, please try again.",array('post_list' => array(),'post_count'=> 0, 'followers_count'=> 0,'following_count'=>0,'follower_status'=>0 ) );
        }
    }
    /////User Post List By user Id//

    public function user_post_list_byid()
    {
        $user_id = $_POST['user_id'];  
        $user = $this->common->getdata('user', array('id'=>$user_id), array('single'));
        $follower_count = $this->common->getData('follower', array('user_id'=>$_POST['user_id']), array('count')); 
        $follower_status = $this->common->getData('follower', array('user_id'=>$_POST['user_id']), array('count')); 
        $following_count = "0";
        $follower_status = "0";

        if(!empty($user))
        {
        $postdata = $this->common->getdata('post', array('user_id'=>$user_id), array());  
        }
        else{
          $this->response(false, "Add valid user id");
          exit;
        }
        $data = array();
         if (!empty($postdata)) {
              $i = 0;
            foreach ($postdata as $key => $value) {
            
            $getsingleuser = $this->common->getdata('user', array('id'=>$value['user_id']), array('single'));
            $getLike = $this->common->getdata('post_like', array('user_id'=>$value['user_id'],'post_id'=>$value['id']), array('single'));


             $getLikeStatus = 0;
            if($getLike){
             $getLikeStatus = "1";

            }else{
                  $getLikeStatus = "0";

            }
            $r = $this->common->getData('post_image', array('post_id' => $value['id']), array('', 'field' => 'image'));

            $data[] = [
            "id"=>$value['id'],
            "user_id"=>$value['user_id'],
            "post_type"=>$value['post_type'],
            "description"=>$value['description'],
            "total_like"=>$value['total_like'],
            "total_comment"=>$value['total_comment'],
            "user_profile_image"=>$getsingleuser['profile_image'],
            "user_full_name"=>$getsingleuser['full_name'],
            "is_like"=>$getLikeStatus,
            ];

             if (!empty($r)) {
                    $data[$key]['post_images'] = $r;
                } else {
                    $data[$key]['post_images'] = array();
                }
             $i++;
            }

              $this->response(true, "Post List", array('post_list' => $data ,'post_count'=>"$i" , 'followers_count'=> "$follower_count" ,'following_count'=>$following_count,'follower_status'=>$follower_status));
                //$this->response(true, "Post detail", array('post_detail' => $postdata));
        } else {
            $this->response(false, "No record Found");
        }
    }

    /////Chat, Video , Post Schdule////
   public function chat_schdule()
   {
        $user_id = $_POST['user_id'];
        $influencer_id = $_POST['influencer_id'];
        $time =  $_POST['time'];
        $date = $_POST['date'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        $datenew = $date.' '.$time ;
        $currentDate = strtotime($datenew);
        $futureDate = $currentDate+(60*5);
        $formatDate = date("Y-m-d H:i:s", $futureDate); 
      if($type == 1) ///for chat schdule
      {
      $data = $this->common->insertData('chat_schdule',array('chat_with' => $influencer_id, 'chat_by' => $user_id,'time' => $time,'date' => $date,'chat_duration'=>'5','price'=>'50','end_datetime'=>$formatDate));
      $message = "Chat Schduled";
     $myres = 'chat_detail';
      }elseif($type == 2) //for video schdule
      {
     $data = $this->common->insertData('video_schdule',array('video_call_by' => $user_id, 'video_call_with' => $influencer_id,'time' => $time,'date' => $date,'video_call_duration'=>'5','price'=>'80','end_datetime'=>$formatDate));
     $message = "Video Schduled";
     $myres = 'video_detail';
      }elseif($type == 3) ///for post schdule
      {
       $data = $this->common->insertData('post_schdule',array('user_id' => $user_id, 'influencer_id' => $influencer_id,'time' => $time,'date' => $date,'price'=>'50','post_id'=>'0','description'=>$_POST['description']));
       $message = "Post Schduled";
       $myres = 'post_detail';

      }
                $timestamp = strtotime($date);
                $year = date('Y', $timestamp);
                $month = date('M', $timestamp);
                $day = date('D', $timestamp);
                $only_date = date('d', $timestamp);
                
                $all_Detail= [
                'year'=> $year,
                'date'=>$only_date,
                'start_time'=> date('h:i a', $currentDate)  ,
                'end_time'=>  date('h:i a',strtotime($formatDate)),
                "day"=> $day,
                "month"=>$month,
                 ];      
        if (!empty($data)) {
                $this->response(true, $message, array('chat_detail' => $all_Detail));
        } else {
            $this->response(false, "No record Found");
        }          
   }

////////User
    public function upcoming_chat_schdule()
    {
     $user_id = $_POST['user_id'];   
     $userdata = $this->common->getdata('user', array('id'=>$user_id), array('single')); 
     if($userdata['user_type'] == 0)
     {   
     $data = $this->common->getData('chat_schdule', array('chat_by'=>$user_id ), array('sort_by'=>'time','sort_direction'=>'desc'));
     }else
     {
     $data = $this->common->getData('chat_schdule', array('chat_with'=>$user_id,'status!='=> 2), array('sort_by'=>'time','sort_direction'=>'desc'));
     }
/*
     echo $this->db->last_query();
     die;*/
     $chatDetail = array();
     foreach ($data as $key => $value) { 
        $chatBy = $this->common->getSingleRowById('user','id',$value['chat_by'],'array');
        $chatTo = $this->common->getSingleRowById('user','id',$value['chat_with'],'array');
        $timestamp = strtotime($value['date']);
       // $year = date('Y', strtotime($date));
       $month = date('F', $timestamp);
       $day = date('D', $timestamp);
       $only_date = date('d', $timestamp);
        $chatDetail[]= [
        'id' =>  $value['id'],
        'chat_by'=>  $value['chat_by'],
        'chat_by_name'=>$chatBy['full_name'],
        'chat_by_image'=>base_url('assets/userfile/profile/').$chatBy['profile_image'],
        'chat_with' =>  $value['chat_with'],
        'chat_with_name'=>$chatTo['full_name'],
        'chat_with_image'=>base_url('assets/userfile/profile/').$chatTo['profile_image'],
        'price'=>  $value['price'],
        'date'=>  $value['date'],
        'time'=>  $value['time'],
        "status"=> $value['status']  ,
       "day"=> $day,
      "month"=>$month,
      "only_date"=>$only_date,
        "chat_duration"=> $value['chat_duration']  , 
        ];
     }
     if (!empty($data)) {
                $this->response(true, "Upcoming Chat detail", array('chat_detail' => $chatDetail));
        } else {
            $this->response(false, "No record Found");
        }
    }
////////Influenecer 
    public function upcoming_chat_influ_schdule()
    {
     $user_id = $_POST['user_id'];   
     $userdata = $this->common->getdata('user', array('id'=>$user_id), array('single'));  
  if($userdata['user_type'] == 1)
     {   
      $data = $this->common->getData('chat_schdule', array('chat_with'=>$user_id,'status!='=> 2), array('sort_by'=>'time','sort_direction'=>'desc'));
     }else
     {    
  $data = $this->common->getData('chat_schdule', array('chat_by'=>$user_id ), array('sort_by'=>'time','sort_direction'=>'desc'));
     }
     $chatDetail = array();
     foreach ($data as $key => $value) { 
        $chatBy = $this->common->getSingleRowById('user','id',$value['chat_by'],'array');
        $chatTo = $this->common->getSingleRowById('user','id',$value['chat_with'],'array');
        $timestamp = strtotime($value['date']);
       // $year = date('Y', strtotime($date));
       $month = date('F', $timestamp);
       $day = date('D', $timestamp);
       $only_date = date('d', $timestamp);
        $chatDetail[]= [
        'id' =>  $value['id'],
        'chat_by'=>  $value['chat_by'],
        'chat_by_name'=>$chatBy['full_name'],
        'chat_by_image'=>base_url('assets/userfile/profile/').$chatBy['profile_image'],
        'chat_with' =>  $value['chat_with'],
        'chat_with_name'=>$chatTo['full_name'],
        'chat_with_image'=>base_url('assets/userfile/profile/').$chatTo['profile_image'],
        'price'=>  $value['price'],
        'date'=>  $value['date'],
        'time'=>  $value['time'],
        "status"=> $value['status']  ,
       "day"=> $day,
      "month"=>$month,
      "only_date"=>$only_date,
        "chat_duration"=> $value['chat_duration']  , 
        ];
     }
     if (!empty($data)) {
                $this->response(true, "Upcoming Chat detail", array('chat_detail' => $chatDetail));
        } else {
            $this->response(false, "No record Found");
        }
    }

    //////////
      public function upcoming_video_schdule()
    {
     $user_id = $_POST['user_id'];    
     $data = $this->common->getData('video_schdule', array('video_call_by'=>$user_id), array('sort_by'=>'time','sort_direction'=>'desc'));
     $videoDetail = array();
     foreach ($data as $key => $value) { 
        $videoBy = $this->common->getSingleRowById('user','id',$value['video_call_by'],'array');
        $videoTo = $this->common->getSingleRowById('user','id',$value['video_call_with'],'array');
        $timestamp = strtotime($value['date']);
       // $year = date('Y', strtotime($date));
       $month = date('F', $timestamp);
       $day = date('D', $timestamp);
       $only_date = date('d', $timestamp);
        $videoDetail[]= [
        'id' =>  $value['id'],
        'video_by'=>  $value['video_call_by'],
        'video_by_name'=>$videoBy['full_name'],
        'video_by_image'=>base_url('assets/userfile/profile/').$videoBy['profile_image'],
        'video_with' =>  $value['video_call_with'],
        'video_with_name'=>$videoTo['full_name'],
        'video_with_image'=>base_url('assets/userfile/profile/').$videoTo['profile_image'],
        'price'=>  $value['price'],
        'date'=>  $value['date'],
        'time'=>  $value['time'],
        "status"=> $value['status']  ,
       "day"=> $day,
      "month"=>$month,
      "only_date"=>$only_date,
    "video_call_duration"=> $value['video_call_duration']  , 
        ];
     }
     if (!empty($videoDetail)) {
            $this->response(true, "Upcoming Video Call Detail", array('video_call_detail' => $videoDetail));
        } else {
            $this->response(false, "There is a problem, please try again.");
        }
    }
     public function upcoming_post_schdule()
    {

     $user_id = $_POST['user_id'];    
     $data = $this->common->getData('post_schdule', array('influencer_id'=>$user_id), array('sort_by'=>'time','sort_direction'=>'desc'));
     $postDetail = array();
     foreach ($data as $key => $value) { 
        $userby = $this->common->getSingleRowById('user','id',$value['user_id'],'array');
        $influencerby = $this->common->getSingleRowById('user','id',$value['influencer_id'],'array');
        $timestamp = strtotime($value['date']);
       // $year = date('Y', strtotime($date));
       $month = date('F', $timestamp);
       $day = date('D', $timestamp);
       $only_date = date('d', $timestamp);
        $postDetail[]= [
        'id' =>  $value['id'],
           'influencer_id' =>  $value['user_id'],
        'influencer_name'=>$userby['full_name'],
        'post_id'=>$value['post_id'],
        'influencer_with_image'=>base_url('assets/userfile/profile/').$influencerby['profile_image'],
        'user_id'=>  $value['influencer_id'],
        'user_name'=>$influencerby['full_name'],
        'user_by_image'=>base_url('assets/userfile/profile/').$influencerby['profile_image'],

        // 'user_id'=>  $value['user_id'],
        // 'user_name'=>$userby['full_name'],
        // 'user_by_image'=>base_url('assets/userfile/profile/').$userby['profile_image'],
        // 'influencer_id' =>  $value['influencer_id'],
        // 'influencer_name'=>$influencerby['full_name'],
        // 'post_id'=>$value['post_id'],
        // 'influencer_with_image'=>base_url('assets/userfile/profile/').$influencerby['profile_image'],
        'price'=>  $value['price'],
        'date'=>  $value['date'],
        'time'=>  $value['time'],
        "status"=> $value['status']  ,
       "day"=> $day,
      "month"=>$month,
      "only_date"=>$only_date,
   
        ];
     }
     if (!empty($postDetail)) {
                $this->response(true, "Upcoming Post List", array('post_detail' => $postDetail));
        } else {
            $this->response(false, "There is a problem, please try again.");
        }
    }
    
    //////Add follower
        public function add_followers() {
        $influencer_id = $_POST['influencer_id'];
        $user_id = $_POST['user_id'];
        $message = "";
        $code = ""; 
        $likedata = $this->common->getData('follower', array('influencer_id' => $influencer_id, 'user_id' => $user_id), array('single'));
        if (!empty($likedata)) {
            $result = $this->common->deleteData('follower', array('id' => $likedata['id']));
            $message = "UnFollow successfully!";
            //$code = false;      
        } else {
            
        $result = $this->common->insertData('follower',array('influencer_id' => $influencer_id, 'user_id' => $user_id));
            $message = "Follow successfully!";
          $userdetail = user_detail($_POST['user_id']);
            $sendnoti =  $this->common->send_all_notification($_POST['influencer_id'],ucwords($userdetail['full_name'])." started following you.","Follow",'4',array('refer_id'=>$_POST['user_id']));    
        }
        if (!empty($message)) {
            $this->response(true, $message, array());
        } else {
            $this->response(false, "There is a problem, please try again.", array());
        }
    }
   


    ///////Accept/Decline user chat/video/post//////
    public function response_chat_req()
    {
        $chat_id = $_POST['chat_id'];
        $user_id = $_POST['user_id'];  
        $status = $_POST['status'];    //0=pending, 1=accept, 2=reject
        $message = "";
        $data = $this->common->getData('chat_schdule', array('id' => $_POST['chat_id'],'chat_with'=>$_POST['user_id']), array('single')); 
        if($status == 0){
            $message = "Request Pending";
        }
        elseif($status == 1)
        {
            $message = "Chat Request Accepted";
        }
        elseif($status == 2)
        {
            $message = " Chat Request Decline";
        }
       if (!empty($data)) 
       {
         $check_status = $this->common->updateData('chat_schdule',array('status'=>$status),array('id' => $_POST['chat_id'],'chat_with'=>$_POST['user_id']));     
         if($check_status){
                  $data = $this->common->getData('chat_schdule', array('id' => $_POST['chat_id'],'chat_with'=>$_POST['user_id']), array('single'));
                    $this->response(true,  $message ,array('status_detail' => $data));  
            } else {
                $this->response(false, "There is a problem, please try again.", array('status_detail' => array()));
            }      
       }else{
            $this->response(false, "Please sent valid details");
       }
    }
     public function response_video_req()
    {
        $video_id = $_POST['video_id'];
        $user_id = $_POST['user_id'];  
        $status = $_POST['status'];    //0=pending, 1=accept, 2=reject
        $message = "";
        $data = $this->common->getData('video_schdule', array('id' => $_POST['video_id'],'video_call_with'=>$_POST['user_id']), array('single')); 
        if($status == 0){
            $message = "Request Pending";
        }
        elseif($status == 1)
        {
            $message = "Video Call Request Accepted";
        }
        elseif($status == 2)
        {
            $message = " Video Call Request Decline";
        }
       if (!empty($data)) 
       {
         $check_status = $this->common->updateData('video_schdule',array('status'=>$status),array('id' => $_POST['video_id'],'video_call_with'=>$_POST['user_id']));     
          if($check_status){
                  $data = $this->common->getData('video_schdule', array('id' => $_POST['video_id'],'video_call_with'=>$_POST['user_id']), array('single'));
                    $this->response(true,  $message ,array('status_detail' => $data));  
            } else {
                $this->response(false, "There is a problem, please try again.", array('status_detail' => array()));
            }      
       }else{
            $this->response(false, "Please sent valid details");
       }
    }
     public function response_post_req()
    {
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];  
        $status = $_POST['status'];    //0=pending, 1=accept, 2=reject
        $message = "";
        $data = $this->common->getData('post_schdule', array('id' => $_POST['post_id'],'user_id'=>$_POST['user_id']), array('single')); 
        if($status == 0){
            $message = "Request Pending";
        }
        elseif($status == 1)
        {
            $message = "Post Request Accepted";
        }
        elseif($status == 2)
        {
            $message = " Post Request Decline";
        }
       if (!empty($data)) 
       {
         $check_status = $this->common->updateData('post_schdule',array('status'=>$status),array('id' => $_POST['post_id'],'user_id'=>$_POST['user_id']));     
         if($check_status){
                  $data = $this->common->getData('post_schdule', array('id' => $_POST['post_id'],'user_id'=>$_POST['user_id']), array('single'));
                    $this->response(true,  $message ,array('status_detail' => $data));  
            } else {
                $this->response(false, "There is a problem, please try again.", array('status_detail' => array()));
            }      
       }else{
            $this->response(false, "Please sent valid details");
       }
    }

     public function upcoming_post_influ_schdule()
    {
     $user_id = $_POST['user_id'];    

     $userdata = $this->common->getData('user', array('id'=>$user_id), array('single'));
  
  if($userdata['user_type'] == 1)
     {   
      $data = $this->common->getData('post_schdule', array('user_id'=>$user_id,'status!='=> 2), array('sort_by'=>'time','sort_direction'=>'desc'));
     }else
     {  
      $data = $this->common->getData('post_schdule', array('user_id'=>$user_id ), array('sort_by'=>'time','sort_direction'=>'desc'));
     }
   
   $postDetail = array();
      foreach ($data as $key => $value) { 
        $userby = $this->common->getSingleRowById('user','id',$value['user_id'],'array');
        $influencerby = $this->common->getSingleRowById('user','id',$value['influencer_id'],'array');
        $timestamp = strtotime($value['date']);
       // $year = date('Y', strtotime($date));
       $month = date('F', $timestamp);
       $day = date('D', $timestamp);
       $only_date = date('d', $timestamp);
        $postDetail[]= [
        'id' =>  $value['id'],
           'influencer_id' =>  $value['user_id'],
        'influencer_name'=>$userby['full_name'],
        'post_id'=>$value['post_id'],
        'influencer_with_image'=>base_url('assets/userfile/profile/').$influencerby['profile_image'],
        'user_id'=>  $value['influencer_id'],
        'user_name'=>$influencerby['full_name'],
        'user_by_image'=>base_url('assets/userfile/profile/').$userby['profile_image'],
        'description'=>  $value['description'],
        'price'=>  $value['price'],
        'date'=>  $value['date'],
        'time'=>  $value['time'],
        "status"=> $value['status']  ,
       "day"=> $day,
      "month"=>$month,
      "only_date"=>$only_date,
   
        ];
     }
    
    if (!empty($data)) {
                $this->response(true, "Upcoming post detail", array('post_detail' => $postDetail));
        } else {
            $this->response(false, "No record Found");
        }
    }
     
 public function upcoming_video_influ_schdule()
    {
     $user_id = $_POST['user_id'];    

     $userdata = $this->common->getData('user', array('id'=>$user_id), array('single'));
  
  if($userdata['user_type'] == 1)
     {   
      $data = $this->common->getData('video_schdule', array('video_call_with'=>$user_id,'status!='=> 2), array('sort_by'=>'time','sort_direction'=>'desc'));
     }else
     {  
      $data = $this->common->getData('video_schdule', array('video_call_by'=>$user_id ), array('sort_by'=>'time','sort_direction'=>'desc'));
     }
   $videoDetail = array();
     foreach ($data as $key => $value) { 
        $videoBy = $this->common->getSingleRowById('user','id',$value['video_call_by'],'array');
        $videoTo = $this->common->getSingleRowById('user','id',$value['video_call_with'],'array');
        $timestamp = strtotime($value['date']);
       // $year = date('Y', strtotime($date));
       $month = date('F', $timestamp);
       $day = date('D', $timestamp);
       $only_date = date('d', $timestamp);
        $videoDetail[]= [
        'id' =>  $value['id'],
        'video_by'=>  $value['video_call_by'],
        'video_by_name'=>$videoBy['full_name'],
        'video_by_image'=>base_url('assets/userfile/profile/').$videoBy['profile_image'],
        'video_with' =>  $value['video_call_with'],
        'video_with_name'=>$videoTo['full_name'],
        'video_with_image'=>base_url('assets/userfile/profile/').$videoTo['profile_image'],
        'price'=>  $value['price'],
        
        'date'=>  $value['date'],
        'time'=>  $value['time'],
        "status"=> $value['status']  ,
       "day"=> $day,
      "month"=>$month,
      "only_date"=>$only_date,
    "video_call_duration"=> $value['video_call_duration']  , 
        ];
     }
    if (!empty($data)) {
                $this->response(true, "Upcoming video detail", array('video_call_detail' => $videoDetail));
        } else {
            $this->response(false, "No record Found");
        }
    }

   //////End ///
   public function user_list_byinflu()
   {
        $user_id = $_POST['user_id'];  ////Influenecer Id 
        $all_follower= $this->common->getData('follower', array(), array());
        $single_user = $this->common->getSingleRowById('user','id',$user_id,'array');
        $var=array();
        $type= ""; $check_follow=0;
        if(empty($single_user))
        {
        $this->response(false, "There is a problem, User id not found.");
        }
        if($single_user['user_type']==1){
         $type = '0';
        }else{
         $type = '1';
        }
        $all_user = $this->common->getData('user', array('user_type'=>$type), array());
        foreach ($all_user as $key => $value) {
        $check_follow_user =$this->common->getData('follower', array('influencer_id'=>$user_id,'user_id'=>$value['id']), array());
        if($check_follow_user)
        {
        $check_follow = '1';
        }else{
         $check_follow = '0'; 
        }
        $all_lang = array() ;
            $language =  explode(',',$value['language_id']) ;
            if($value['language_id']!='' && $value['language_id']!=0){
            foreach ($language as $key => $val) {
            $getlanguage = $this->common->getSingleRowById('language','id',$val,'array');
            $all_lang[] = ['id'=>$getlanguage['id']  , 
            'name'=>$getlanguage['name'],
            'image'=>base_url('assets/flag/').$getlanguage['image'],
            ] ;
            }
            }
        $user[] = [
        'id'=>$value['id'],
        'follower_status'=>$check_follow ,
        'full_name'=>$value['full_name'],
        'email'=>$value['email'],
        'profile_image'=>base_url('assets/userfile/profile/').$value['profile_image'],
        "language_data"=>  $all_lang, 
        'status'=>$value['status'],
        'user_type'=>$value['user_type'],

        ];
        }
          if (!empty($user)) {
        $this->response(true, "User Detail", array('user_detail' => $user));
        } else {
        $this->response(false, "There is a problem, please try again.", array('user_detail' => array()));
        }
   }

 ///////////////post image //////////////////////
public function get_post_image()
    {
         $post_image = $this->common->getData('post_image', array('post_id' => $_POST['post_id']), array('field' => 'image'));
         if (!empty($post_image)) {
                $this->response(true, "Post image", array('post_images' => $post_image));
        } else {
            $this->response(false, "There is a problem, please try again.", array('post_images' => array()));
        }
    }

 ////Post Comment Like ////
 
  public function post_comment_like() {

        $user_id = $_POST['user_id'];
        $comment_id = $_POST['comment_id'];

        $_POST['created_date'] = date('Y-m-d');
        $_POST['created_time'] = date('H:i:s');
        $count = 0;
        $message = "";
        $likedata = $this->common->getData('post_comment_like', array('user_id' => $user_id, 'comment_id' => $comment_id), array('single'));
        $postdata = $this->common->getData('post_comment', array('comment_id' => $comment_id), array('single'));
        if (!empty($likedata)) {
            $result = $this->common->deleteData('post_comment_like', array('like_id' => $likedata['like_id']));
            if ($postdata['total_like'] > 0) {
                $count = $postdata['total_like'] - 1;
            } else {
                $count = $postdata['total_like'];
            }
            $message = "Dislike Comment";
        } else {
            $post = $this->common->getField('post_comment_like', $_POST);
            $result = $this->common->insertData('post_comment_like', $post);
            $count = $postdata['total_like'] + 1;
            $message = "Like Comment";
        }
        $update = $this->common->updateData('post_comment', array('total_like' => $count), array('comment_id' => $comment_id));
        if (!empty($update)) {
            $postdata = $this->common->getData('post_comment', array('comment_id' => $comment_id), array('single'));
            $like = $this->common->getData('post_comment_like', array("comment_id" => $comment_id, "user_id" => $user_id), array('single'));
            if (!empty($like)) {
                $is_comment_like = 1;
            } else {
                $is_comment_like = 0;
            }
            $this->response(true, $message, array('count' => (string)$count, 'is_comment_like' => $is_comment_like));
        } else {
            $this->response(false, "There is a problem, please try again.", array('count' => $count));
        }
    }  
    public function testfile(){
         $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = $ipnCheck;
        fwrite($myfile,$_REQUEST);
        fclose($myfile);
    }
}