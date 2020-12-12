<?php 

class Posts extends Controller{

    public function __construct()
    {
        $this->postmodel= $this->model("Post");
        $this->usermodel = $this->model("User");
        if(!isLoggedIn())
        {
            redirect("users/login");
        }
    }

    //CONTROLLER FOR VIEWING ALL THE POSTS
    public function index($status =""){

        $data=[
            "posts"=>$this->postmodel->getPost(),
            "status"=>$status
        ];

        $this->view("/posts/index",$data);
    }

    //CONTROLLER FOR MANAGING ADDING OF POSTS
    public function add()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $data=[
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'user_id'=>$_SESSION['id'],
                'title_err'=>"",
                'body_err'=>""
            ];

            //VALIDATE TITLE
            if(empty($data['title']))
            {
                $data['title_err']="Please enter a title";
            }
            //VALIDATE BODY
            if(empty($data['body']))
            {
                $data['body_err']="Please write something in the body";
            }
            //CHECK ALL ERRORS ARE EMPTY
            if(empty($data['title_err']) && empty($data['body_err']))
            {
                if($this->postmodel->addPost($data))
                {
                    redirect("posts");
                }
                else{
                    die("something went wrong");
                }
            }
            else{
                //LOAD VIEW WITH ERRORS
                $this->view("/posts/add",$data);
            }
        }
        else{
            $data=[
                'title'=>"",
                'body'=>""
            ];
            
            $this->view("/posts/add",$data);
        }
        
    }
    public function show($id)
    {
        $post = $this->postmodel->getPostById($id);
        $user = $this->usermodel->finduser($post->user_id);
        $data=[
            'post'=>$post,
            'user'=>$user
        ];

        $this->view('/posts/show',$data);
    }
    public function edit($id)
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $data=[
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'id'=>$id,
                'title_err'=>"",
                'body_err'=>""
            ];

            //VALIDATE TITLE
            if(empty($data['title']))
            {
                $data['title_err']="Please enter a title";
            }
            //VALIDATE BODY
            if(empty($data['body']))
            {
                $data['body_err']="Please write something in the body";
            }
            //CHECK ALL ERRORS ARE EMPTY
            if(empty($data['title_err']) && empty($data['body_err']))
            {

                if($this->postmodel->updatePost($data))
                {
                    redirect("posts");
                }
                else{
                    die("something went wrong");
                }
            }
            else{
                //LOAD VIEW WITH ERRORS
                $this->view("/posts/edit",$data);
            }
        }
        else{

            $post = $this->postmodel->getPostById($id);

            if($post->user_id != $_SESSION['id'])            
            {
                // redirect('posts');
                echo $post->user_id."  ".$_SESSION['id'];
            }
            $data=[
                'title'=>$post->title,
                'body'=>$post->body,
                'id'=>$id
            ];
            
            $this->view("/posts/edit",$data);
        }
    }

    public function delete($id)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $post = $this->postmodel->getPostById($id);
            if($post->user_id != $_SESSION['id'])
            {
                redirect("posts");
            }
            $status = $this->postmodel->deletePost($id);

            if($status == "true")
            {
                redirect("posts/index/true");
            }
            else{
                die("something went very wrong");
            }
        
        }
        else
        {
            redirect("posts");
        }
        
    }
}