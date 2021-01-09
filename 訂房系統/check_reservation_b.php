<?php 

require_once("mysql.php");

session_start();
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: check_reservation.php");
}



//讀取資料
 $check="SELECT number,name,reservation_style,reservation_date,reservation_money,remarks FROM reservation WHERE number='{$_SESSION["loginMember"] }' " ;
 $check_res=$db_link->prepare($check);
	$check_res->execute();
	$check_res->bind_result($number,$name,$reservation_style,$reservation_date,$reservation_money,$remarks);
	$check_res->fetch();
	$check_res->close();

	//刪除紀錄
unset($_SESSION["loginMember"]);




 ?>




<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<title>曙光訂房系統/訂房查詢</title>
		<link rel="stylesheet" href="">
	</head>
	<style>
	.container-fluid{background-color: #000000;height:100vh;}
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
	#footer{position: relative;}
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
			#footer{width: 100%; position:fixed;top:95%;}
#check_table{
padding-top: 20px;

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
				<div class="col-xs-1 col-sm-1 offset-sm-3 text-nowrap" id="btn1" ><a href="index.php">回首頁</a> </div>
				<div class="col-xs-1 col-sm-1 text-nowrap" id="btn1"><a href="new.php">最新消息</a> </div>
				<div class="col-xs-1 col-sm-1 text-nowrap" id="btn1"><a href="room.php">客房導覽</a> </div>
				<div class="col-xs-1 col-sm-1 text-nowrap" id="btn1"> <a href="note.php">訂房須知</a>  </div>
				<div class="col-xs-1 col-sm-1 text-nowrap" id="btn1"><a href="reservation.php">我要訂房</a>  </div>
				<div class="col-xs-1 col-sm-1 text-nowrap" id="btn1"><a href="check_reservation.php">訂房查詢</a> </div>
			</div>
			<div class="row">
				<div class="col-xs-12  col-sm-3 offset-sm-3">
					<p><h1>訂房查詢</h1></p>
				</div>
			</div>
			<div class="row" >
				<div class="col-xs-12 col-sm-6 offset-sm-3" id="newcolor">new</div>
			</div>

		
				<div class="row" id="check_table" >
				<div class="col-sm-4 offset-sm-4" >

				<table class="table table-bordered table-dark">
					<thead>
						<tr>

							<th colspan="2"><center>您的訂房資料</center></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>姓名</td>
							<td><?php echo $name ?></td>
						</tr>
						<tr>
							<td>房型</td>
							<td><?php echo $reservation_style ?></td>
						</tr>
						<tr>
							<td>入住日期</td>
							<td><?php echo $reservation_date ?></td>
						</tr>
						<tr>
							<td>金額</td>
							<td><?php echo $reservation_money ?></td>
						</tr>
						<tr>
							<td>備註</td>
							<td><?php echo $remarks ?></td>
						</tr>

					</tbody>
				</table>
  

				
			</div>
			</div>











			<div class="row" id="footer">
				
				<div class="col-md-8 offset-md-2 text-center" ><small>曙光訂房 地址:台中市潭子區圓通南路1111111號&nbsp;
					<a href="https://www.google.com.tw/maps/place/427%E5%8F%B0%E4%B8%AD%E5%B8%82%E6%BD%AD%E5%AD%90%E5%8D%80%E5%9C%93%E9%80%9A%E5%8D%97%E8%B7%AF/@24.2071179,120.7034518,17z/data=!3m1!4b1!4m5!3m4!1s0x3469177bf3da901d:0x94636ee2f3d9a057!8m2!3d24.207113!4d120.7056405?hl=zh-TW" target="_blank">
					<img src="images/map.png" width="15px"> </a>服務電話:(04)1234-5678 傳真:(04)1234-9865</small></div>
				</div>
			</div>
		</body>
		
	</html>