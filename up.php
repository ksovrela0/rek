<?php
error_reporting(E_ERROR);
require 'db.php';
global $db;
$db      = new dbClass();
$act            = $_REQUEST['act'];
$user_id 		= $_SESSION['USERID'];
$original_name	= $_REQUEST['original'];
$type		    = $_REQUEST['ext'];
$new_name		= $_REQUEST['newName'];
$chatID	        = $_REQUEST['chatID'];

$new = $new_name.'.'.$type;
if($act == 'product_img'){
    if (0 < $_FILES['file']['error']) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        if(move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $new_name.'.'.$type))
        {
            $user_id = $_REQUEST['user_id'];
            $db->setQuery(" SELECT  COUNT(*) AS cc
                            FROM    users
                            WHERE   id = '$user_id' AND actived = 1");
            $isset = $db->getResultArray();
            $pic = "files/". $new_name.'.'.$type;
            
            $db->setQuery(" UPDATE  users 
                            SET     avatar='$pic'
                            WHERE   id='$user_id'");
            $db->execQuery();
            

            echo json_encode(array("status" => 'OK', "src" => $pic));
        }
        else{
            echo 'error';
        }
    }
}
else if($act == 'upload_new_file'){
    $type_send = $_REQUEST['type'];
    if (0 < $_FILES['file']['error']) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        if(move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $new_name.'.'.$type))
        {
            $user_id = $_REQUEST['user_id'];
            $db->setQuery(" SELECT  COUNT(*) AS cc
                            FROM    users
                            WHERE   id = '$user_id' AND actived = 1");
            $isset = $db->getResultArray();
            $pic = "files/". $new_name.'.'.$type;
            
            switch($type_send){
                case 'order_file':
                    $db->setQuery(" UPDATE  users 
                                    SET     order_file='$pic'
                                    WHERE   id='$user_id'");
                    $db->execQuery();
                break;
                case 'register_file':
                    $db->setQuery(" UPDATE  users 
                                    SET     register_file='$pic'
                                    WHERE   id='$user_id'");
                    $db->execQuery();
                break;
                case 'anketa_file':
                    $db->setQuery(" UPDATE  users 
                                    SET     anketa_file='$pic'
                                    WHERE   id='$user_id'");
                    $db->execQuery();
                break;
                case 'instructions_file':
                    $db->setQuery(" UPDATE  users 
                                    SET     instructions_file='$pic'
                                    WHERE   id='$user_id'");
                    $db->execQuery();
                break;
                case 'orderTaken_file':
                    $db->setQuery(" UPDATE  users 
                                    SET     orderTaken_file='$pic'
                                    WHERE   id='$user_id'");
                    $db->execQuery();
                break;
                case 'layoff_order_file':
                    $db->setQuery(" UPDATE  users 
                                    SET     layoff_order_file='$pic'
                                    WHERE   id='$user_id'");
                    $db->execQuery();
                break;
            }
                
            

            echo json_encode(array("status" => 'OK', "src" => $pic));
        }
        else{
            echo 'error';
        }
    }
}


?>