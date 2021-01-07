<?php 
session_start();

//檢查權限	
if($_SESSION["memberLevel"]!="member"){
	header("Location:login.php");
	}


if(isset($_POST["action"])&&($_POST["action"]=="add")){
include ("mysql.php");

$sql_query="INSERT INTO sales(date,number,money,name,phone,email,addr) VALUES(?,?,?,?,?,?,?)";
$stmt=$db_link->prepare($sql_query);
$stmt->bind_param("sisssss",$_POST["date"],$_POST["number"],$_POST["money"],$_POST["name"],$_POST["phone"],$_POST["email"],$_POST["addr"]);
$stmt->execute();
$stmt->close();
$db_link->close();
	header("Location:index.php");
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
	
.container{margin-top: 5%;}

</style>

<body>
	

<div class="container">
<div class="row">
<div class="col-md-6 offset-md-3">
<h2>新增訂單系統</h2>



<form action="index_add.php" method="POST" accept-charset="utf-8">
	

<table class="table table-sm ">
								<thead class="thead-dark">
		<tr>
			<th>欄位</th><th>內容</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>日期</td>
			<td><input type="date" name="date" value="" required></td>
		</tr>
		<tr>
			<td>數量</td>
			<td><input type="number" name="number" value="" min="1" required></td>
		</tr><tr>
			<td>商品</td>
			<td><select name="money">
				<option value="白咖啡">白咖啡</option>
				<option value="黑咖啡">黑咖啡</option>
				<option value="美式咖啡">美式咖啡</option>
				<option value="義式咖啡">義式咖啡</option>
				<option value="拿鐵">拿鐵</option>
			 </select></td> 

		</tr><tr>
			<td>聯絡人</td>
			<td><input type="text" name="name" value="" required></td>
		</tr><tr>
			<td>電話</td>
			<td><input type="tel" name="phone" value="" required></td>
		</tr><tr>
			<td>信箱</td>
			<td><input type="email" name="email" value="" required></td>
		</tr><tr>
			<td>地址</td>
			<td><input type="text" name="addr" value="" required></td>
		</tr>
			<tr><td colspan="2" align="center" >
									
									<input type="hidden" name="action" value="add">
									<input type="submit" name="button" id="button" value="新增資料">
									<input type="reset" name="button2" id="button2" value="重新填寫">
								</td>
								



</table>
</form>


<center>
<a href="index.php">回首頁</a></center>

</div></div></div>



</body>
</html>



