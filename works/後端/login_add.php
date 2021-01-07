<?php 
require_once("mysql.php");
session_start();




if(isset($_POST["action"])&&($_POST["action"]=="add")){
include ("mysql.php");

$sql_query="INSERT INTO user(name,username,password,sex,birthday,email,phone,home_phone,addr) VALUES(?,?,?,?,?,?,?,?,?)";
$stmt=$db_link->prepare($sql_query);
$stmt->bind_param("sssssssss",$_POST["name"],$_POST["username"],$_POST["password"],$_POST["sex"],$_POST["birthday"],$_POST["email"],$_POST["phone"],$_POST["home_phone"],$_POST["addr"]);
$stmt->execute();
$stmt->close();
$db_link->close();

	header("Location:login.php");
}




 ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>會員註冊</title>
		<link rel="stylesheet" href="">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>

<style>
.container{margin-top: 5%;}
tbody{border:1px solid;}


</style>
	<body>
		
		<div class="container"	>
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<center><p><h2>會員註冊</h2></p></center>
				
				
					
						<form action="admin_add.php" method="post" accept-charset="utf-8">
							<table class="table table-sm ">
								<thead class="thead-dark">
									<tr >
										<th scope="col">欄位</th>
										<th scope="col">資料</th>
									</tr>
								</thead>
								<tbody>
									<tr><td scope="row">姓名</td><td><input type="text" name="name" required ></td></tr>
									<tr><td scope="row">帳號</td><td><input type="text" name="username" required ></td></tr>
									<tr><td scope="row">密碼</td><td><input type="password" name="password" required></td></tr>
									<tr><td scope="row">性別</td><td>
									<input type="radio" name="sex" value="男" checked>男
									<input type="radio" name="sex" value="女" >女
								</td></tr>
								<tr><td scope="row">生日</td><td><input type="date" name="birthday" required></td></tr>
								<tr><td scope="row">信箱</td><td><input type="email" name="email" required ></td></tr>
								<tr><td scope="row">行動電話</td><td><input type="tel" name="phone" required></td></tr>
								<tr><td scope="row">家電話</td><td><input type="tel" name="home_phone" required></td></tr>
								<tr><td scope="row">地址</td><td><input type="text" name="addr"required ></td></tr>
								<tr><td colspan="2" align="center" >
									
									<input type="hidden" name="action" value="add">
									<input type="submit" name="button" id="button" value="新增資料">
									<input type="reset" name="button2" id="button2" value="重新填寫">
								</td></tr>
								
								</tbody>
							</table>
						</form>
							<center><p><a href="admin.php">回登入畫面</a></p></center>
					</div>
				</div>
			</div>
		</body>
	</html>