<?php
require_once("mysql.php");
session_start();
//檢查是否經過登入,若有登入則導向
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMeber"]!="")){
		//若帳號等級為member 則導向
	if($_SESSION["memberLevel"]=="member"){
		header("Location:index.php");
		//否則導向管理中心
	}else{
		header("Location:admin_index.php");
	}
}
//執行會員登入
if(isset($_POST["username"]) && isset($_POST["password"])){
	//繫結登入會員資料
	$query_RecLogin="SELECT username, password, level FROM user WHERE username=?";
	$stmt=$db_link->prepare($query_RecLogin);
	$stmt->bind_param("s", $_POST["username"]);
	$stmt->execute();
	//取出帳號密碼的值綁定結果
	$stmt->bind_result($username, $password, $level);
	$stmt->fetch();
	$stmt->close();
	//比對密碼，若登入成功則呈現登入狀態
	if($_POST["password"]==$password){
		//計算登入次數及更新登入時間
		$query_RecLoginUpdate="UPDATE user SET login=login+1, logintime=NOW() WHERE username=?";
		$stmt=$db_link->prepare($query_RecLoginUpdate);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->close();
		//設定登入者的名稱及等級
		$_SESSION["loginMember"]=$username;
		$_SESSION["memberLevel"]=$level;
		
		//若帳號等級為member 則導向系統頁面
		if($_SESSION["memberLevel"]=="member"){
			header("Location:index.php");
		//否則導向管理系統頁面
		}else{
			header("Location:admin_index.php");
		}
	}else{
		header("Location:login.php?errMsg");
	}
}
/*session_start();
//如果沒有登入session或是是session值為空則執行登入動作
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	if(isset($_POST["username"]) && isset($_POST["password"])){
		require_once("mysql.php");
		//選取儲存帳號密碼的資料表
		$sql_query="SELECT * FROM user";
		$result=$db_link->query($sql_query);
		//取出帳號密碼的值
		$row_result=$result ->fetch_assoc();
		$username=$row_result["username"];
		$password=$row_result["password"];
		$db_link ->close();
		//比對帳號密碼，若登入成功則進管理介面，否則就退回主畫面。
		if(($username==$_POST["username"]) && ($password==$_POST["password"])){
			$_SESSION["loginMember"]=$username;
			header("Location: admin.php");
		}else{
			header("Location: login.php?errMsg");
		}
	}
}else{
	//若已經有登入Session值則前往管理介面
	header("Location:admin.php");
}
*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>登入頁面</title>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		
		
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@500;700&display=swap" rel="stylesheet">
	</head>
	<style type="text/css" media="screen">
    
	#row{height: 50rem;
		margin-top:5vh;
	}
	h2{margin-top:70%;}
	.username_password{font-family: 'Noto Sans TC', sans-serif;
   
	font-size: 1rem;
	}
	#tab{margin: 10%;
	}
	div{background-image:url("https://cestmarie.com/wp-content/uploads/2019/01/Screenshot-4.png")}

	</style>
	<body>
		
		<div class="container-fluid" >
			<div class="row" id="row" >
				<div class="hidden-xs col-md-1 " style="background-color:#FFFFFF;"></div>
				
				<div class="hidden-xs col-md-6 " style="background-color:lavender;">
					
					<!--標籤頁!-->
					<div id="tab">
						<ul class="nav nav-tabs">
							<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1">注意事項</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2">聯絡我</a></li>
							
						</ul>
						<div class="tab-content" id="tab_color">
							<div id="tab1" class="container tab-pane active"><br>
								<ul><h3>感謝各位來到會員系統</h3> </ul>
									所有的會員功能都必須經由登入後才能使用，
												請您在右方視窗中執行登入動作。
									<li>本會員系統擁有以下的功能：</li>
									
									<li>每個會員可修改本身資料。</li>
									<li>管理者可以修改、刪除會員的資料。</li>
									<li>請各位會員遵守以下規則：</li>
									<li>遵守各項有關法律法規。</li>
									<li>不得在發佈任何色情非法， 以及危害國家安全的言論。</li>
									<li>嚴禁連結有關政治， 色情， 宗教， 迷信等違法訊息。</li>
									<li>承擔一切因您的行為而直接或間接導致的民事或刑事法律責任。</li>
									<li>互相尊重， 遵守互聯網絡道德；嚴禁互相惡意攻擊， 漫罵。</li>
									<li>管理員擁有一切管理權力。</li>
									<li>管理員帳號:admin</li>
								</div>
								<div id="tab2" class="container tab-pane fade"><br>
									<img src="LOGO-1_01.png"  width="100" height="100">
                                    <span style="font-size:1.5rem">管理員:謝翼光0912377956</span>
                                    
								</div>
								
							</div>
						</div>
						<!--標籤頁!-->
					</div>
					<div class="col-md-2 col-xs-12  " style="background-color:#D4DFE6;">
						<p><h2  class="">登入系統</h2></p>
						<form action="login.php" method="POST" accept-charset="utf-8">
							<br>
							
							<p ><span class="username_password">使用者帳號</span></p>
							<p><input type="text" name="username"  required  style="width:80% "></p>
							<p><span class="username_password">使用者密碼</span></p>
							<p><input type="password" name="password" required style="width:80% "></p>
							
							<br>
							<p ><input type="submit" class="btn btn-info btn-primary" value="登入" style="width:70% "></p><br>
							<p><a href="login_add.php"><input type="button" class="btn btn-info btn-primary" name="" value="註冊" style="width:70% "></a></p>
							<!--<p ><input type="btn" class="btn btn-info btn-primary btn " value="註冊"></p>
							<a href="">&nbsp;忘記密碼</a> !-->
							
						</form>
						<?php
							if(isset($_GET['errMsg']))
									{
										echo "帳號有誤請重新登入" ;
									}
						?>
					</div>
					<div class="hidden-xs col-md-2 " style="background-color:lavender;"></div>
					
				</div>
			</div>
		</body>
	</html>