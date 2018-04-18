<?php

$tableNameUser="users";


/*function getall(){
    
    global $dbh;
    //global $tableNameUser;
        
     //$sql = "SELECT * FROM $tablename";
     $sql = "SELECT * FROM users";
    
    //$stm = $dbh->prepare($sql);
    $stm = $dbh->prepare($sql);
    if($stm->execute()){
        return $stm->fetchAll();
    }else{
        return false;
    }
}*/

function getAll()
{
	global $dbh;
	global $tableNameUser;

	$sql = "SELECT * FROM $tableNameUser";

	$stm = $dbh->prepare($sql);

	if ($stm->execute()) {
		return $stm->fetchAll();
	} else {
		return false;
	}
}

function getbyid($id){
    
    global $dbh;
    global $tableNameUser;
    
    $sql="SELECT * FROM $tableNameUser WHERE id=:id";
    
    $stm=$dbh->prepare($sql);
    
    $data=[
        
       ':id'=>$id
    ];
        if ($stm->execute($data)) {
            
            return $stm->fetch();
        }else{
            return false;
        }
    
}

function insert($username ,$email ,$password){
    
    global $dbh;
    global $tableNameUser;
    
    $sql="INSERT INTO $tableNameUser (`username`, `email`, `password`) VALUES (:username,:email,:password)";
    $stm=$dbh->prepare($sql);
    $data=[
        ':username'=>$username,
        ':email'=>$email,
        ':password'=>$password
    ];
    if($stm->execute($data)){
        
        return $dbh->lastInsertId();
                     
    }else{
        return false;
    }
}
function update($username ,$email ,$password,$id){
    global $dbh;
    global $tableNameUser;
    $sql="UPDATE $tableNameUser SET `username`=:username,`email`=:email,`password`=:password WHERE id=:id";
    $stm=$dbh->prepare($sql);
     $data=[
        ':username'=>$username,
        ':email'=>$email,
        ':password'=>$password,
         'id'=>$id
    ];
    
    if($stm->execute($data)){
        return true;
    }else{
        return false;
        
    }
}

function delete($id){
    global $dbh;
    global $tableNameUser;
    $sql="DELETE FROM $tableNameUser WHERE id=:id";
    
    $stm=$dbh->prepare($sql);
    $data=[
        ':id'=>$id
    ];
    
    if($stm->execute($data)){
        return true;
    }else{
        return false;
    }
    
}

function login($username,$password){
    global $dbh;
    global $tableNameUser;
    $sql="select id,username from $tableNameUser where username=:username AND password=:password";
    $stm=$dbh->prepare($sql);
    $data=[':username'=>$username,':password'=>$password];
    if($stm->execute($data)){
        return true;
    }else{
        return false;
    }
    
}




?>