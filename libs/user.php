<?php

$tableNameUser="users";





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


$tableName="students";

function getAllstudents()
{
	global $dbh;
	global $tableName;

	$sql = "SELECT * FROM $tableName";

	$stm = $dbh->prepare($sql);

	if ($stm->execute()) {
		return $stm->fetchAll();
	} else {
		return false;
	}
}

function getbyidstudent($id){
    
    global $dbh;
    global $tableName;
    
    $sql="SELECT * FROM $tableName WHERE id=:id";
    
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

function insertstudent($username ,$email ,$password){
    
    global $dbh;
    global $tableName;
    
    $sql="INSERT INTO $tableName (`username`, `email`, `password`) VALUES (:username,:email,:password)";
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
function updatestudent($username ,$email ,$password,$id){
    global $dbh;
    global $tableName;
    $sql="UPDATE $tableName SET `username`=:username,`email`=:email,`password`=:password WHERE id=:id";
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

function deletestudent($id){
    global $dbh;
    global $tableName;
    $sql="DELETE FROM $tableName WHERE id=:id";
    
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

function loginstudent($username,$password){
    global $dbh;
    global $tableName;
    $sql="select id,username from $tableName where username=:username AND password=:password";
    $stm=$dbh->prepare($sql);
    $data=[':username'=>$username,':password'=>$password];
    if($stm->execute($data)){
        return true;
    }else{
        return false;
    }
    
}




?>