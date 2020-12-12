<?php

class Users extends Controller{

    public function __construct(){
        $this->usermodel= $this->model("User");
    }

    public function register(){

        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $data=[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_err'=>"",
                'email_err'=>"",
                'password_err'=>"",
                'confirm_password_err'=>""
            ];
    
            //SANITIZE POST DATA
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
    
            //VALIDATE NAME
            if(empty(trim($data['name'])))
            {
                $data['name_err']="No name entered!!";
            }

            //VALIDATE EMAIL
            if(empty($data['email']))
            {
                $data['email_err']="No email entered!!";
            }
            else if($this->usermodel->findEmail($data['email'])){
                $data['email_err']="Email already exists!!";
            }
            
            //VALIDATE PASSWORD AND CONFIRM PASSWORD
            if(empty($data['password']))
            {
                $data['passsword_err']="Enter a password";

            }else if(strlen($data['password']) < 6)
            {
                $data['password_err']="Min password length is 6 characters";
            }

            if(empty($data['confirm_password']))
            {
                $data['confirm_password']="Enter password again";

            } else if($data['password']!=$data['confirm_password'])
            {
                $data['password_err']="Passwords do not match";
            }
            
            //CHECK IF ALL ERRORS ARE EMPTY
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                $data['password']= password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->usermodel->register($data))
                {
                    redirect("users/login");
                }
                else{
                    die("Something went very wrong!!");
                }
            }else{

                $this->view('users/register',$data);
            }
    
        }
        else{
            //INIT DATA
            $data=[
                'name'=>"",
                'email'=>"",
                'password'=>"",
                'confirm_password'=>"",
                'name_err'=>"",
                'email_err'=>"",
                'password_err'=>"",
                'confirm_password_err'=>""
            ];
            $this->view("users/register",$data);
        }
        
    }
    
    public function login(){

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data=[    
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_err'=>"",
                'password_err'=>""   
            ];

            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            //VALIDATE EMAIL
            if(empty($data['email']))
            {
                $data['email_err']="Please enter an email";

            }else if(!$this->usermodel->findemail($data['email'])){

                $data['email_err']="This email doesn't exist!!";
            }

            //VALIDATE PASSWORD
            if(empty($data['password']))
            {
                $data['password_err']="Please enter a password";
            }

            //CHECK IF ALL ERRORS ARE EMPTY
            if(empty($data['email_err']) && empty($data['password_err']))
            {
                $loggedInUser = $this->usermodel->login($data);
                if($loggedInUser)
                {
                    $this->createUserSession($loggedInUser);
                }
                else
                {
                    $data['password_err'] = "Incorrect Password";
                    $this->view("users/login",$data);
                }
            }
            else
            {
                $this->view("users/login",$data);
            }
        }
        else{
            //INIT DATA
            $data=[    
                'email'=>"",
                'password'=>"",
                'email_err'=>"",
                'password_err'=>""   
            ];
            $this->view("users/login",$data);
        }
    }

    public function createUserSession($user){
        $_SESSION['name'] = $user->name;
        $_SESSION['email']= $user->email;
        $_SESSION['id']= $user->id;
        redirect('pages/index');
    }
    
    public function logout(){
        unset($_SESSION);
        session_destroy();
        redirect('users/login');
    }
}