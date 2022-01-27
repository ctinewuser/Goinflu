<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function user_detail($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('user',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
     return $user_detail;
    }
    else{
      return false;
    }
}






function language_name($name)
{
     $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
     $exp1 = explode(',',$name);

       foreach ($exp1 as $key => $value) {

    $language_name = $CI->common->getData('language',array('id'=>$value),array('single'));
  $detail[]  = $language_name['name']; }
      $imp = implode(',', $detail);
  
 if(!empty($imp)){
        return $imp;
     }else
     {
      return "";
     }

}
function user_full_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('user',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
      return $user_detail['full_name'];
    }else{
     return false;
    }
}






function user_type($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('user',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
      return $user_detail['user_type'];
    }else{
     return false;
    }
}
