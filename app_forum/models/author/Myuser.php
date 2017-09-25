<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Myuser extends CI_Model {

 public $id;
 public $name;
 public $password;
 public $level;
 public $avatar;

 function __construct (){
 	parent::__construct();
	$this->load->library('session');
 } 

 function insertUser($data)
    {
		return $this->db->insert('user', $data);
	}
	
	//send verification email to user's email id
	function sendEmail($to_email)
	{
		$from_email = 'team@mydomain.com';
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Silahkan klik link aktivasi dibawah ini untuk memverifikasi Email Anda untuk mengaktifkan akun Anda yang telah mendaftar sebagai riliser di website Kami.<br /><br /> http://www.mydomain.com/user/verify/' . md5($to_email) . '<br /><br /><br />Terima Kasih<br />Mydomain Team';
		
		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = '********'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);
		
		//send mail
		$this->email->from($from_email, 'Mydomain');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}
	
	//activate user account
	function verifyEmailID($key)
	{
		$data = array('status' => Y);
		$this->db->where('md5(email)', $key);
		return $this->db->update('user', $data);
	}
	
 function set($id,$name,$password){


 	$query=$this->db->query("SELECT * from user where id_user='$id'and name_user='$name' and password_user='$password' and level_user='0' and status_user='Y' and terhapus='N'");
 	if($query->num_rows()>0){
 	$row=$query->row();
 	$this->id=$row->id_user;
 	$this->name=$row->name_user;
 	$this->password=$row->password_user;
 	$this->level=$row->level_user;
 	$this->avatar=$row->avatar_user;
 	$data_sessi=array('login'=>true,
	 				  'id_user'=>$row->id_user,
	 				  'name_user'=>$row->name_user,
	 				  'password_user'=>$this->password,
	 				  'level_user'=>$this->level);
	 $this->session->set_userdata($data_sessi);


	 // mulai generate access security key
	 if(!$this->session->userdata("random_filemanager_key")){
	 	$karakter = 'abcdefghijklmnopqrstuvwxyz0123456789';
	 	$hasil = '';
		 for ($i = 0; $i < 10; $i++) {
		      $hasil .= $karakter[rand(0, strlen($karakter) - 1)];
		 }
		 $this->session->set_userdata(array("random_filemanager_key"=>$hasil));
	 };
	 
 	 return true;
 	}
 	else {
 		$data_sessi=array('login'=>false,
	 						'id_user'=>"",
	 						'name_user'=>"",
	 						'password_user'=>"");
	 	$this->session->set_userdata($data_sessi);
 		return false;
 	}
 }



}


?>