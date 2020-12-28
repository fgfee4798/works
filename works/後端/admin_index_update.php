<?php  
require_once("mysql.php");
session_start();

//檢查權限是否足夠
if($_SESSION["memberLevel"]!="admin"){
	header("Location:login.php");
}








include("mysql.php");
//更新資料
if(isset($_POST["action"]) && ($_POST["action"]=="update")){
$sql_sales="UPDATE sales SET date=?,number=?,money=?,name=?,phone=?,email=?,addr=? WHERE id=?";
$stmtt=$db_link ->prepare($sql_sales);
$stmtt->bind_param("sisssssi", $_POST["date"],$_POST["number"],$_POST["money"],$_POST["name"],$_POST["phone"],$_POST["email"],$_POST["addr"],$_POST["id"]);
$stmtt ->execute();
$stmtt ->close();
$db_link ->close();
header("Location: admin_index.php");
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
 	<title>修改訂單</title>
 	<link rel="stylesheet" href="">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 </head>

<style type="text/css" media="screen">
	
.container-fluid{margin-top: 5%;}


</style>

 <body>

<center> 	
<div class="container-fluid" >
<div class="row">
<div class="col-md-12">
<h2>修改資料</h2></div></div>
<div class="row">
<div class="col-md-4 offset-md-4">
<form action="admin_index_update.php" method="POST" accept-charset="utf-8">
	

<table class="table table-sm ">
								<thead class="thead-dark">
		<tr>
			<th>欄位</th><th>內容</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>日期</td>
			<td><input type="date" name="date" value="<?php echo $sales["date"] ; ?>" required></td>
		</tr>
		<tr>
			<td>數量</td>
			<td><input type="number" name="number" value="<?php echo $sales["number"] ; ?>"  required></td>
		</tr><tr>
			<td>商品</td>
			<td>
								


					<select name="money">
			<option value="白咖啡"<?php if($sales["money"]=="白咖啡") echo "selected";  ?> >白咖啡</option>
				<option value="黑咖啡" <?php if($sales["money"]=="黑咖啡") echo "selected";  ?> >黑咖啡</option>
				<option value="美式咖啡" <?php if($sales["money"]=="美式咖啡") echo "selected";  ?> >美式咖啡</option>
				<option value="義式咖啡" <?php if($sales["money"]=="義式咖啡") echo "selected";  ?> >義式咖啡</option>
				<option value="拿鐵" <?php if($sales["money"]=="拿鐵") echo "selected";  ?> >拿鐵</option>
		
			 </select>


				


			</td> 



		</tr><tr>
			<td>聯絡人</td>
			<td><input type="text" name="name" value="<?php echo $sales["name"] ; ?>" required></td>
		</tr><tr>
			<td>電話</td>
			<td><input type="tel" name="phone" value="<?php echo $sales["phone"] ; ?>" required></td>
		</tr><tr>
			<td>信箱</td>
			<td><input type="email" name="email" value="<?php echo $sales["email"] ; ?>" required></td> 
		</tr><tr>
			<td>地址</td>
			<td><input type="text" name="addr" value="<?php echo $sales["addr"] ; ?>" required></td>
		</tr>
			<tr><td colspan="2" align="center" >
									
									<input type="hidden" name="id" value="<?php echo $sales["id"] ?> ">
									<input type="hidden" name="action" value="update">
									<input type="submit" name="button" id="button" value="修改資料">
									<input type="reset" name="button2" id="button2" value="重新填寫">
								</td>
								<tr>



</table>



<a href="admin_index.php">回首頁</a>
</div>
 	</div></div></center>
 </body>
 </html>

