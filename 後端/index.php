<?php 
require_once("mysql.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: login.php");
}	
//檢查權限	
if($_SESSION["memberLevel"]!="member"){
	header("Location:login.php");
	}else{
		$query_RecLogin="SELECT   name  FROM user WHERE username=? ";
		$stmt=$db_link->prepare($query_RecLogin);
		$stmt->bind_param("s", $_SESSION["loginMember"]);
		$stmt->execute();
		//取出帳號密碼的值綁定結果
		$stmt->bind_result($name_usss);
		$stmt->fetch();
		$stmt->close();
		}


//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
    unset($_SESSION["memberLevel"]);
	header("Location: login.php");
}

/*
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
$sql_query="SELECT * FROM sales";
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

*/


//查詢資料
if(isset($_POST["action"])&& ($_POST["action"]=="search")){





		$search="SELECT money,number,name,phone,email,addr,date,id FROM sales WHERE (money LIKE ?) AND  (name LIKE ?) AND  (date LIKE ?) ";
	$money="%".$_POST["money"]."%";
	$date="%".$_POST["date"]."%";
	$name="%".$_POST["name_user"]."%";
	$search_result=$db_link->prepare($search);
	$search_result->bind_param("sss", $money,$name,$date);
	$search_result->execute();
	$search_result->bind_result($money,$number,$name,$phone,$email,$addr,$date,$id) ;

}







 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>訂單管理系統</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<style type="text/css" media="screen">
	
#TOP{margin-top: 5%;}
#name_co{color: #357def;
		font-family: 新細明體;}

</style>

<body>

<div class="container-fluid">
       
 <div class="row">      
<div class="col-md-12" id="TOP">

<center><h2 >訂單管理系統</h2></center> 
</div>
</div>
  
<div class="row">
<div class="col-md-3 offset-md-9">
<?php echo "<span id='name_co'>".$name_usss."</span>"."你好" ?> <a href="m_update.php">修改會員</a> <a href="index.php?logout=true">登出管理</a>
</div>	
</div>






<div class="row">
	<div class="col-md-6">
<!--查詢功能!-->
<form action="index.php" method="POST" accept-charset="utf-8"> 
 <label for="date">日期</label>
			 <input type="text" name="date" placeholder=2020-12-17 value= "" >
			 <label for="money">商品</label>
				<select name="money" >
				<option value=""></option>
				<option value="白咖啡">白咖啡</option>
				<option value="黑咖啡">黑咖啡</option>
				<option value="美式咖啡">美式咖啡</option>
				<option value="義式咖啡">義式咖啡</option>
				<option value="拿鐵">拿鐵</option>
			 </select>
			
			 <label for="name_user">聯絡人</label>
			 <input type="text" name="name_user" value="" placeholder="輸入姓名">



			 <input type="hidden" name="action" value="search">
			<input type="submit" name="button" id="button" value="查詢">
</form>
</div>
<div class="col-md-1"><a href="index_add.php">新增表單</a>  </div>

</div>
<!--查詢功能結束!-->

<!--查詢顯示!--> 
<table>
	<thead>
		<tr>
	<table class="table table-hover " >
	<tr class="table-info">
			<th>#</th>
			<th>日期</th>
			<th>數量</th>
			<th>商品</th>
			<th>聯絡人</th>
			<th>電話</th>
			<th>信箱</th>
			<th>地址</th></tr>
			

<?php
if(isset($_POST["action"])&& ($_POST["action"]=="search")){
		while($search_result->fetch()){
		echo "<tr>" ;
		echo "<td>".$id."</td>" ;
		echo "<td>".$date."</td>" ;
		echo "<td>".$number."</td>" ;
		echo "<td>".$money."</td>" ;
		echo "<td>".$name."</td>" ;
		echo "<td>".$phone."</td>" ;
		echo "<td>".$email."</td>" ;
		echo "<td>".$addr."</td>" ;
		echo "</tr>" ;

		 };
		 
		 echo "</table>";
};	
		
		 ?>


</div>

</body>


<script type="text/javascript">




$(function(){
$("tbody tr:odd").css("background-color","#FFFCDD");

});

</script>

</html>