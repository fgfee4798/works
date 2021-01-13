<?php
require_once("mysql.php");
session_start();

//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: admin_login.php");
}







//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	header("Location: admin_login.php");
}



//查詢資料



if(isset($_POST["action"]) && ($_POST["action"]=="show")){
$search="SELECT number,name,reservation_style,reservation_date,reservation_money,remarks,id FROM reservation WHERE (reservation_date LIKE ?) AND  (name LIKE ?) AND  (number LIKE ?) ";

$reservation_date ="%".$_POST["date_table"]."%";
	$number="%".$_POST["number_table"]."%";
	$name="%".$_POST["name_table"]."%";
	$search_result=$db_link->prepare($search);
	$search_result->bind_param("sss", $reservation_date,$name,$number);
	$search_result->execute();
	$search_result->bind_result($number,$name,$reservation_style,$reservation_date,$reservation_money,$remarks,$id) ;
	$search_result->store_result();
	//查詢筆數
	$total_records=$search_result ->num_rows;

	
}









?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		
		<title>管理系統/訂房查詢</title>
		<link rel="stylesheet" href="">
	</head>
	<style>
	.container-fluid{height:100%;}
	#top{background-color: #dab04c;
		text-indent: -9999px;
		height: 5px;
	}
	#top1{background-color: #393e46;
		background: radial-gradient(closest-side at 55% 50%,#BBBBBB,#000000,#000001);
		
		text-align: center;
		color: #FFFFFF;
		padding: 2%;
		}
	#nav{background-color: #222831;
		color: #FFFFFF;
		text-align: center;
		padding: 0.5%;
		font-size:1rem;
		font-family: "微軟正黑體";
	}
	#carousel{margin-top: 1%;
	}
	#footer{width: 100%; position:fixed;top:95%;}
	small{color:#FFFFFF;}
	a{color: #FFFFFF;text-decoration: none;outline: none;}
	a:hover,a:focus{color:#fff;text-decoration: none;outline: none;}
		
	#btn1 {
	letter-spacing: 0;
	}
	#btn1:hover,
	#btn1:active {
	letter-spacing: 3px;   /*聚焦時的間距*/
	}
	#btn1:after,
	#btn1:before {
	-webkit-backface-visibility: hidden;
	backface-visibility: hidden;
	border: 1px solid rgba(255, 255, 255, 0);
	bottom: 0px;
	content: " ";
	display: block;
	margin: 0 auto;
	position: relative;
	-webkit-transition: all 280ms ease-in-out;
	transition: all 280ms ease-in-out;
	width: 0;
	}
	#btn1:hover:after,
	#btn1:hover:before {
	-webkit-backface-visibility: hidden;
	backface-visibility: hidden;
	border-color: #fff;
	-webkit-transition: width 350ms ease-in-out;
	transition: width 350ms ease-in-out;
	width: 70%;
	}
	#btn1:hover:before {
	bottom: auto;
	top: 0;
	width: 70%;
	}
	h1,h3,h4,h5,p,li{color:#FFFFFF;}
	h2{color:#FF9;
	}
	#newcolor{background-color: #FFFFFF;
				text-indent: -9999px;
				height: 2px;
	}
	ul{margin-top:25px;
	list-style: none;
	}
	li{margin-bottom:25px;background-color: #222222;
		height: 100px;
		position: relative;.
	}
	#total_records{color:#c70039;
font-size: 25px;
	}	

	</style>
	<body>
		
		<div class="container-fluid">
			<div class="row" id="top">
				<div class="col-xs-12 col-sm-12">光光訂房</div>
			</div>
			<div class="row" id="top1">
				
				<div class="col-xs-4 col-sm-4 offset-sm-4 "><a href="index.php"><img src="images/LOGO.png"></a></div>
				
			</div>
			<div class="row" id="nav">
				<div class="col-xs-1 col-sm-1 offset-sm-4 text-nowrap" id="btn1"><a href="admin_index.php">最新消息</a> </div>
				<div class="col-xs-1 col-sm-1 text-nowrap" id="btn1"><a href="admin_check.php">訂房查詢</a> </div>
				<div class="col-xs-1 col-sm-1 text-nowrap" id="btn1"><a href="admin_index.php?logout=true">登出</a> </div>
			</div>
			
			
			<div class="row">
				<div class="col-md-8 offset-sm-2">
					
				<form action="admin_check.php" method="POST" accept-charset="utf-8">
					<table class="table table-striped">
					<tr><td>
					日期:<input type="date" name="date_table" value="">
					姓名:<input type="text" name="name_table" value="">
					身分證字號:<input type="text" name="number_table" value="">
					<input type="hidden" name="action" value="show">
					<input type="submit" name="" value="搜尋" class="btn btn-primary">
					</td></tr>
				</table>
			</form>
		</div>
</div>

<div class="row">
	<div class="col-md-8 offset-sm-2" id="total_records">
<?php

if(isset($_POST["action"])&& ($_POST["action"]=="show")){
echo "查詢到".$total_records."筆";
};
?>
</div>
</div>
<div class="row">
				<div class="col-md-8 offset-sm-2">
<table class="table table-striped table-hover">
	
	
<tr><th>#</th><th>日期</th><th>姓名</th><th>身分證字號</th><th>房型</th><th>價錢</th><th>備註</th></tr>


<?php
if(isset($_POST["action"])&& ($_POST["action"]=="show")){
		while($search_result->fetch()){
		echo "<tr>" ;
		echo "<td>".$id."</td>" ;
		echo "<td>".$reservation_date."</td>" ;
		echo "<td>".$name."</td>" ;
		echo "<td>".$number."</td>" ;
		echo "<td>".$reservation_style."</td>" ;
		echo "<td>".$reservation_money."</td>" ;
		echo "<td>".$remarks."</td>" ;
		echo "</tr>" ;

		 };
		 
	
};	
		
		 ?>



</table>




	</div>
</div>



		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</html>