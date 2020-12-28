<?php 


require_once("mysql.php");
session_start();

//檢查權限是否足夠
if($_SESSION["memberLevel"]!="admin"){
	header("Location:index.php");
}



include("mysql.php");
//更新資料
if(isset($_POST["action"])&&($_POST["action"]=="update")){
$sql_query="UPDATE user SET name=?,username=?,sex=?,birthday=?,email=?, phone=?,home_phone=?,addr=? WHERE id=?"; 
$stmt=$db_link ->prepare($sql_query);
$stmt ->bind_param("ssssssssi",$_POST["name"],$_POST["username"],$_POST["sex"],$_POST["birthday"],$_POST["email"],$_POST["phone"],$_POST["home_phone"],$_POST["addr"],$_POST["id"]);
$stmt ->execute();
$stmt ->close();
$db_link ->close();
header("Location: admin.php");
}

//查詢資料
$sql_select="SELECT id,name,username,sex,birthday,email, phone,home_phone,addr FROM user WHERE id=?";
$stmt= $db_link ->prepare($sql_select); 
$stmt -> bind_param("i",$_GET["id"]);
$stmt -> execute();
$stmt -> bind_result($id,$name,$username,$sex,$birthday,$email, $phone,$home_phone,$addr);
$stmt -> fetch();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>會員管理系統/修改資料</title>
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


<div class="container"	>
	<div class="row">
	<div class="col-md-4 offset-md-4">
<p><h2>會員管理系統-修改資料</h2></p>





		 <form action="admin_update.php" method="post" accept-charset="utf-8">
<table class="table table-sm ">
  <thead class="thead-dark">
	<tr >
	<th scope="col">欄位</th>
      <th scope="col">資料</th>
  </tr>


 	
 	

</thead>

<tbody>
<tr><td scope="row">姓名</td><td><input type="text" name="name" value="<?php echo $name; ?>"></td></tr>
<tr><td scope="row">帳號</td><td><input type="text" name="username" value="<?php echo $username; ?>"></td></tr>
<tr><td scope="row">性別</td><td>
	<input type="radio" name="sex" value="男" <?php if($sex=="男") echo "checked";  ?>>男
	<input type="radio" name="sex" value="女"<?php if($sex=="女") echo "checked";  ?>>女
</td></tr>
<tr><td scope="row">生日</td><td><input type="date" name="birthday" value="<?php echo $birthday; ?>"></td></tr>
<tr><td scope="row">信箱</td><td><input type="email" name="email" value="<?php echo $email; ?>"></td></tr>
<tr><td scope="row">行動電話</td><td><input type="tel" name="phone" value="<?php echo $phone; ?>"></td></tr>
<tr><td scope="row">家電話	</td><td><input type="tel" name="home_phone" value="<?php echo $home_phone; ?>"></td></tr>
<tr><td scope="row">地址</td><td><input type="text" name="addr" value="<?php echo $addr; ?>"></td></tr>
<tr><td colspan="2" align="center" >
	<input type="hidden" name="id" value="<?php echo $id;?>">
<input type="hidden" name="action" value="update">
<input type="submit" name="button" id="button" value="更新資料">

</td>
<tr>
</tbody>
</table>



 </form>
 <center>
 <p><a href="admin.php">回主畫面</a></p></center>
</div>
</div>
</div>



</body>
</html>

<?php
$stmt ->close();
$db_link ->close();
?>