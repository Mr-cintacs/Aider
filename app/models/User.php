<?php

class User{
    private $db ;

    public function __construct(){
        $this->db= new Database;
    }

    public function register($data)
    {
        $this->db->query('insert into users(name, email,password) values(:name,:email,:password)');
        //BIND VALUES
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function login($data)
    {
        $this->db->query('select * from users where email= :email');
        $this->db->bind(':email',$data['email']);
        $result= $this->db->single();

        if(password_verify($data['password'],$result->password))
        {
            return $result;
        } else{
            return false;
        }




    }
    public function findemail($email){
        $this->db->query('select * from users where email = :email');
        $this->db->bind(':email',$email);
        $this->db->single();

        if($this->db->rowCount() > 0){
            return true;
        } else{
            return false;
        }

    }

    public function findUser($id)
    {
        $this->db->query('select * from users where id = :id');
        $this->db->bind('id',$id);
        return $this->db->single();
    }
}