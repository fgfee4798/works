<?php 
require_once("mysql.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: login.php");
}
if($_SESSION["memberLevel"]!="admin"){
	header("Location:index.php");
}

//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
     unset($_SESSION["memberLevel"]);
	header("Location: login.php");
}

//預設每頁比數
$pageRow_records=10;
//預設頁數
$num_pages=1;
//若已經有翻頁，將頁數更新
if(isset($_GET["page"])){
	$num_pages=$_GET["page"];
}
//本業開始記錄筆數=(頁數-1)*每頁紀錄筆數
$startRow_records=($num_pages -1) * $pageRow_records;
//未加限制顯示筆數的SQL敘述句 	
$sql_query="SELECT * FROM user";
//加上限制顯示筆數的SQL敘述句，由本頁開始記錄比數開始，每頁顯示預設筆數
$sql_query_limit=$sql_query." LIMIT {$startRow_records}, {$pageRow_records}";
//以加上限制顯示筆數的SQL敘述句查詢資料到$result中
$result=$db_link->query($sql_query_limit);
//以未加上限限制筆數的SQL敘述句查詢資料到$all_result中
$all_result=$db_link ->query($sql_query);
//計算總比數
$total_records=$all_result ->num_rows;
//計算總頁數=(總比數/每頁筆數)後無條件進位
$total_pages=ceil($total_records/$pageRow_records);

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>管理者頁面</title>
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

<div class="container-fluid">

	<center>
	<h1 >會員帳號系統</h1>
</center>

	<div class="row">
		<div class="col-md-1 offset-11">
	 <a href="admin.php?logout=true">登出管理</a> 
</div></div>
<h2>帳號列表</h2>
<span style="font-size: 1.5rem">共有<?php echo $total_records; ?>組帳號 </span><a href="admin_add.php">新增會員帳號。</a>
<table class="table table-hover " >
	<tr class="table-info"><th>#</th>
		<th>姓名</th>
		<th>帳號</th>
		<th>性別</th>
		<th>生日</th>
		<th>信箱</th>
		<th>行動電話</th>
		<th>家電話</th>
		<th>地址</th>
		<th>登入次數</th>
		<th>最後登入時間</th>
		<th>備註</th></tr>	

<?php 
while($row_result=$result->fetch_assoc()){
	echo "<tr>";

	
	echo "<td>".$row_result["id"]."</td>";
	echo "<td>".$row_result["name"]."</td>";
echo "<td>".$row_result["username"]."</td>";
echo "<td>".$row_result["sex"]."</td>";                                                                                                                                                                            
echo "<td>".$row_result["birthday"]."</td>";
echo "<td>".$row_result["email"]."</td>";
echo "<td>".$row_result["phone"]."</td>";
echo "<td>".$row_result["home_phone"]."</td>";
echo "<td>".$row_result["addr"]."</td>";
echo "<td>".$row_result["login"]."</td>";
echo "<td>".$row_result["logintime"]."</td>";
echo "<td><a href='admin_update.php?id=".$row_result["id"]."'>修改|</a>";
echo "<a href='admin_delete.php?id=".$row_result["id"]."'>刪除</a></td>";
echo "</tr>";
}
?>
	</table>
<?php if($num_pages > 1){//若不是第一頁則顯示 ?>
<a href="admin.php?page=1">第一頁</a>
<a href="admin.php?page=<?php echo $num_pages-1; ?>">上一頁</a>
<?php } ?>
<?php if ($num_pages <$total_pages){ //若不是最後一頁則顯示 ?>
<a href="admin.php?page=<?php echo $num_pages+1;?>">下一頁</a>
<a href="admin.php?page=<?php echo $total_pages;?>">下一頁</a>
<?php } ?>
<p>
頁數:
<?php 
for($i=1;$i<=$total_pages;$i++){
	if($i==$num_pages){
		echo $i."";
	}else{
		echo "<a href=\"admin.php?page={$i}\">{$i}</a>";
	}
}
 ?>
</p>


</div>
</body>
</html>

