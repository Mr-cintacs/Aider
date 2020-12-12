<?php

class  Post{

    private $db;
    
    public function __construct(){
        $this->db = new Database ;
    }

    public function getPost()
    {
        $this->db->query("select *,
            
            users.id as user_id,
            posts.id as post_id,
            posts.created_at as post_created_at,
            users.created_at as user_created_at
            from posts inner join users on posts.user_id = users.id
            order by post_created_at desc ");

        //RETURNS AN OBJECT
        $result=$this->db->resultSet();
        return $result;
    }

    public function addPost($data){
        
        $this->db->query('insert into posts(title,body,user_id) values(:title,:body,:user_id)'); 
        $this->db->bind('title',$data['title']);
        $this->db->bind('body',$data['body']);
        $this->db->bind('user_id',$data['user_id']);
        
        return $this->db->execute()? true : false;
    }

    public function getPostById($id)
    {
        $this->db->query('select * from posts where id = :id');
        $this->db->bind('id',$id);
        
        return $this->db->single();

    }

    public function updatePost($data)
    {
        $this->db->query('update posts set title = :title, body = :body where id = :id');
        $this->db->bind('title',$data['title']);
        $this->db->bind('body',$data['body']);
        $this->db->bind('id',$data['id']);

        return $this->db->execute() ? true : false;
    }

    public function deletePost($id)
    {
        $this->db->query('delete from posts where id =:id');
        $this->db->bind('id',$id);

        return $this->db->execute() ? "true" : "false";

    }
}