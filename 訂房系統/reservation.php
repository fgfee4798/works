<?php


//取得當天日期
$date_server=date("Y-m-d");
require_once("mysql.php");
$check="SELECT * FROM room_img " ;
$check_signal_2 = $db_link->query($check);



//判斷表單傳送資料
if(isset($_POST["action"])&& ($_POST["action"]=="search")){
require_once("mysql.php");
$search="INSERT INTO reservation(number,name,reservation_style,reservation_date,reservation_money,remarks) VALUES(?,?,?,?,?,?)";
$search_s=$db_link->prepare($search);
$search_s->bind_param("ssssss",$_POST["number_table"],$_POST["name_table"],$_POST["room_table"],$_POST["date_table"],$_POST["money_table"],$_POST["remarks_table"]);
$search_s->execute();
$search_s->close();
$db_link->close();
	echo "<script>alert('訂房成功')</script>";
}

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
		<title>曙光訂房系統</title>
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
<script>
	


$(document).change(function(){
		$('select').bind('click',sayOK);	

	});

	function sayOK(){
		if (event.target.value == '豪華風/單人房'){
		 document.getElementById("sList").innerHTML='$1,000';
		 document.getElementById("money_bb").value='$1,000';
				}
		if (event.target.value == '豪華風/雙人房'){
		 document.getElementById("sList").innerHTML='$2,000';
		 document.getElementById("money_bb").value='$2,000';
				}
		if (event.target.value == '尊爵風/單人房'){
		 document.getElementById("sList").innerHTML='$3,000';
		 document.getElementById("money_bb").value='$3,000';
				}
		if (event.target.value == '尊爵風/雙人房'){
		 document.getElementById("sList").innerHTML='$4,000';
		 document.getElementById("money_bb").value='$4,000';
				}
		}	
	


</script>

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
					<p><h1>我要訂房</h1></p>
				</div>
			</div>
			<div class="row" >
				<div class="col-xs-12 col-sm-6 offset-sm-3" id="newcolor">new</div>
			</div>
			<div class="row" id="check_table">
				<div class="col-sm-4 offset-sm-4" >
					<form action="reservation.php" method="POST" accept-charset="utf-8">
						
						
						<table class="table table-bordered table-dark">
							
							<tbody>
								<tr>
									<td>姓名</td>
									<td><input type="text" name="name_table" value="" placeholder="必填" required></td>
								</tr>
								<tr>
									<td>身分證字號</td>
									<td><input type="text" name="number_table" value="" placeholder="必填*10碼" pattern="[A-Z0-9]{10,}" required>

									</td>
								</tr>
								<tr>
									<td>選擇入住時間</td>
									<td><input type="date" name="date_table" value="<?php echo $date_server ; ?>" min="<?php echo $date_server ; ?>" ></td>
								</tr>
								<tr>
									<td>選擇房型</td>
									<td><select name="room_table" >
										<option  disabled selected>請選擇房型</option>
										<?php while($check_signal_3=$check_signal_2->fetch_assoc()){
												
										echo "<option>".$check_signal_3["img_styles"]."</option>" ;
												}
												
										 ?>
									</select></td>
								</tr>
								<tr>
									<td>金額</td>
									<td id="sList">
										
									</td>
								</tr>
								<tr><td>備註</td><td>
									<input type="text" name="remarks_table" value="">

								</td></tr>
								<tr>
									<td colspan="2"><center>
										<input type="hidden" name="money_table" value="" id="money_bb">
										<input type="hidden" name="action" value="search">
										<button type="submit" class="btn btn-dark">送出</button>
										<button type="reset" class="btn btn-dark">重填</button></center>
									</td>

								</tr>>
							</tbody>
						</table>
						
						
					</form>
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