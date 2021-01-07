<?php
require_once("mysql.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: login.php");
}
//檢查權限是否足夠
if($_SESSION["memberLevel"]!="admin"){
	header("Location:login.php");
}



//刪除資料
if(isset($_POST["action"]) && ($_POST["action"]=="delete")){
$sql_del="DELETE FROM sales WHERE id=?" ;
$sql_del_sales=$db_link->prepare($sql_del);
$sql_del_sales ->bind_param("i",$_POST["id"]);
$sql_del_sales ->execute();
$sql_del_sales ->close();
$db_link ->close();
	header("Location:admin_index.php");
}

//查詢資料
$sql_query="SELECT * FROM sales WHERE id='{$_GET["id"]}'";
$stmt= $db_link ->query($sql_query); 
$sales=$stmt ->fetch_assoc();
?>



<!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>刪除訂單</title>
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
<div class="col-md-6 offset-md-3" id="TOP"><center>
<h2>刪除訂單</h2></center>
</div></div>

<div class="row">
<div class="col-md-4 offset-4">
<form action="admin_index_delete.php" method="POST" accept-charset="utf-8">
	

<table class="table table-sm ">
								<thead class="thead-dark">
		<tr>
			<th>欄位</th><th>內容</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>日期</td>
			<td><?php echo $sales["date"] ; ?></td>
		</tr>
		<tr>
			<td>數量</td>
			<td><?php echo $sales["number"] ; ?></td>
		</tr><tr>
			<td>商品</td>
			<td><?php echo $sales["money"] ; ?></td> 

		</tr><tr>
			<td>聯絡人</td>
			<td><?php echo $sales["name"] ; ?></td>
		</tr><tr>
			<td>電話</td>
			<td><?php echo $sales["phone"] ; ?></td>
		</tr><tr>
			<td>信箱</td>
			<td><?php echo $sales["email"] ; ?></td> 
		</tr><tr>
			<td>地址</td>
			<td><?php echo $sales["addr"] ; ?></td>
		</tr>
			<tr><td colspan="2" align="center" >
									
									<input type="hidden" name="id" value="<?php echo $sales["id"] ?> ">
									<input type="hidden" name="action" value="delete">
									<input type="submit" name="button" id="button" value="確認刪除">
									<a href=admin_index.php><input type="button" name="button2" id="button2" value="上一頁"></a>
								</td>
								<tr>



</table>
</div></div>

 	</div>
 </body>
 </html>
<?php
$stmt ->close();
$db_link ->close();
?>