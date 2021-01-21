<?php 
	require_once("mysql.php");


session_start();

//判斷帳號密碼
if(isset($_POST["username"]) && isset($_POST["password"])){

$query_RecLogin="SELECT username, password  FROM user WHERE username=?";
	$stmt=$db_link->prepare($query_RecLogin);
	$stmt->bind_param("s", $_POST["username"]);
	$stmt->execute();
	//取出帳號密碼的值綁定結果
	$stmt->bind_result($username, $password);
	$stmt->fetch();
	$stmt->close();
	//比對密碼，若登入成功則呈現登入狀態
	if($_POST["password"]==$password){
	$_SESSION["loginMember"]=$username;
	header("Location:admin_index.php");
	}else{
	header("Location:admin_login.php?errMsg");

}
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
	

	<title>管理登入系統</title>
	<link rel="stylesheet" href="">
</head>

<style>
.container-fluid{background-color: #456268;height:100vh;}
#top{background-color: #dab04c;
	text-indent: -9999px;
	height: 5px;
}
#top1{background-color: #393e46;
	background: radial-gradient(closest-side at 55% 50%,#456268,#456268,#456268);
	
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
		
table{background-color: #f1f1f1;
	border:1px solid #cdac81; 
margin-top: 30px;
}
td{font-size: 1.2rem;}
</style>


<body>
	
<div class="container-fluid">



<div class="row" id="top">
<div class="col-xs-12 col-sm-12">管理系統</div>
</div>


<div class="row" id="top1">
 
<div class="col-xs-4 col-sm-4 offset-sm-4 "><a href="admin_login.php"><img src="images/LOGO.png"></a></div>  
 
</div>


<div class="row" >
<div class="col-xs-12 col-sm-6 offset-sm-3" id="newcolor">admin</div>
</div>


<div class="row" id="table" >

<div class="col-sm-4 offset-sm-5" >

<form action="admin_login.php" method="POST" accept-charset="utf-8">
	

<table>
	<tr>
		<td>帳號:</td><td><input type="text" name="username" value="" required></td>
	</tr>
	<tr>
		<td>密碼:</td><td><input type="password" name="password" value="" required></td>
	</tr>
<tr>
		<td colspan="2"><center>
			<input type="submit" name="action" value="送出" class="btn btn-secondary">
			<input type="reset" name="" value="重填" class="btn btn-secondary"><?php
							if(isset($_GET['errMsg']))
									{
										echo "<p style='color: red'	>輸入錯誤</p>" ;
									}
						?></center></td>
	</tr>


</table>

</form>


<h2>帳號admin</h2>
<h2>密碼admin</h2>
</div>

</div>














</div>


</body>







</html>