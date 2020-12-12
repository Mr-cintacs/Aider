<?php 
    session_start();

    function isloggedIn(){
        if(isset($_SESSION['id']))
        {
            return true;
        }
        else{
            return false;
    }
}
?>