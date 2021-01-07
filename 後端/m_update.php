<?php 
require_once("mysql.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: login.php");
			}
if($_SESSION["memberLevel"]!="member" ){
	header("Location:login.php");
	}else{
		//查詢會員資料
		$sql_select="SELECT id,name,username,sex,birthday,email, phone,home_phone,addr FROM user WHERE username='{$_SESSION["loginMember"]}'";
$stmt= $db_link ->prepare($sql_select); 

$stmt -> execute();
$stmt -> bind_result($id,$name,$username,$sex,$birthday,$email, $phone,$home_phone,$addr);
$stmt -> fetch();
	$stmt->close();
	}


//執行更新動作	
if(isset($_POST["action"]) && ($_POST["action"]=="update")){
	$query_update="UPDATE user SET birthday=?,email=?,phone=?,home_phone=?,addr=? WHERE id=?";
	$stmtt=$db_link ->prepare($query_update);
$stmtt ->bind_param("sssssi",$_POST["birthday"],$_POST["email"],$_POST["phone"],$_POST["home_phone"],$_POST["addr"],$_POST["id"]);
$stmtt ->execute();
$stmtt ->close();
$db_link ->close();
header("Location: index.php");
}









 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<style type="text/css" media="screen">
	#TOP{margin-top: 10%;

	}

</style> 

<body>



<div class="container-fluid">
       
 <div class="row">      
<div class="col-md-6 offset-md-3" id="TOP">
<center>
<p>會員/修改資料</p></center>


<form action="" method="POST" accept-charset="utf-8">
	

<table class="table table-sm ">
	
	<thead class="thead-dark">
		<tr>
			<th>欄位</th><th>資料</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>姓名</td><td><?php echo $name ; ?></td>
		</tr>
		<tr>
			<td>帳號</td><td><?php echo $username ; ?></td>
		</tr>
		<tr>
			<td>性別</td><td><?php echo $sex ; ?></td>
		</tr>
		<tr>
			<td>生日</td><td><input type="date" name="birthday" value="<?php echo $birthday ; ?>"></td>
		</tr>
		<tr>
			<td>信箱</td><td><input type="email" name="email" value="<?php echo $email ; ?>"></td>
		</tr>
		</tr>
		<tr>
			<td>行動電話</td><td><input type="tel" name="phone" value="<?php echo $phone ; ?>"></td>
		</tr>

			<td>家裡電話</td><td><input type="tel" name="home_phone" value="<?php echo $home_phone; ?>"></td>
		</tr>
		</tr>
		
			<td>地址</td><td><input type="text" name="addr" value="<?php echo $addr; ?>"></td>
		</tr>

		<tr><td colspan="2" align="center" >
			<input type="hidden" name="id" value="<?php echo $id ;?>">
			<input type="hidden" name="action" value="update">
			<input type="submit" name="button" id="button" value="送出">
			<a href="index.php"><input type="button" value="上一頁" ></a>
		</td></tr>

	</tbody>
</table>
			


</form>


</div></div></div>


</body>
</html>