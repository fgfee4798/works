<?php
	require_once("connMysql.php");
	$sql_query_signal_1 = "SELECT * FROM signal_1";
	$result_signal_1 = $db_link->query($sql_query_signal_1);
	$sql_query_signal_2 = "SELECT * FROM signal_2";
	$result_signal_2 = $db_link->query($sql_query_signal_2);
	
	$sql_query_signal_3 = "SELECT * FROM signal_3";
	$result_signal_3 = $db_link->query($sql_query_signal_3);
	$sql_query_signal_4 = "SELECT * FROM signal_4";
	$result_signal_4 = $db_link->query($sql_query_signal_4);
	$sql_query_signal_5 = "SELECT * FROM signal_5";
	$result_signal_5 = $db_link->query($sql_query_signal_5);
	$sql_query_committee_member = "SELECT * FROM committee_member_list";
	$result_committee_member = $db_link->query($sql_query_committee_member);
	$sql_query_assistant = "SELECT * FROM assistant_list";
	$result_assistant = $db_link->query($sql_query_assistant);
	if (!isset($_POST["action_search"])) {
		  
		$result_search = $db_link->prepare("SELECT `signal_5`.`signal_number`, `signal_5`.`unit_name`, `signal_5`.`contact_person_name`, `signal_5`.`contact_person_phone`, `signal_5`.`consultation_address`, `signal_5`.`evaluation_date`, `signal_5`.`committee_member_a`, `signal_5`.`c_a_phone`, `signal_5`.`committee_member_b`, `signal_5`.`c_b_phone`, `signal_5`.`assistant_real`, `signal_5`.`a_r_phone`, `signal_5`.`assistant_sign`, `signal_3`.`evaluation_time`, `committee_member_list`.`c_address`, `committee_member_list`.`c_email`, `assistant_list`.`a_address`, `assistant_list`.`a_email`, `signal_3`.`case_closed_upload`, `signal_3`.`case_closed_post`, `signal_3`.`tutor_frequency`
			FROM `signal_5`
			INNER JOIN `signal_3`
			ON `signal_5`.`signal_number` = `signal_3`.`signal_number`
			INNER JOIN `committee_member_list`
			ON (`signal_5`.`committee_member_a` = `committee_member_list`.`c_name`) OR (`signal_5`.`committee_member_b` = `committee_member_list`.`c_name`)
			INNER JOIN `assistant_list`
			ON `signal_5`.`assistant_real` = `assistant_list`.`a_name`
			WHERE `signal_5`.`evaluation_date` LIKE ?
			GROUP BY `signal_5`.`signal_number`");
	
		$result_search->execute();
		$result_search->bind_result($search_number, $search_un, $search_cpn, $search_cpp, $search_ca, $search_ed, $search_cma, $search_cap, $search_cmb, $search_cbp, $search_ar, $search_arp, $search_as, $search_et, $search_cca, $search_ce, $search_aa, $search_ae, $search_ccu, $search_ccp, $search_tf);
		$result_search->store_result();
		$a = $result_search->num_rows;
	} elseif (isset($_POST["action_search"]) && ($_POST["action_search"] == "search")) {
		$sql_query_search = "SELECT `signal_5`.`signal_number`, `signal_5`.`unit_name`, `signal_5`.`contact_person_name`, `signal_5`.`contact_person_phone`, `signal_5`.`consultation_address`, `signal_5`.`evaluation_date`, `signal_5`.`committee_member_a`, `signal_5`.`c_a_phone`, `signal_5`.`committee_member_b`, `signal_5`.`c_b_phone`, `signal_5`.`assistant_real`, `signal_5`.`a_r_phone`, `signal_5`.`assistant_sign`, `signal_3`.`evaluation_time`, `committee_member_list`.`c_address`, `committee_member_list`.`c_email`, `assistant_list`.`a_address`, `assistant_list`.`a_email`, `signal_3`.`case_closed_upload`, `signal_3`.`case_closed_post`, `signal_3`.`tutor_frequency`
			FROM `signal_5`
			INNER JOIN `signal_3`
			ON `signal_5`.`signal_number` = `signal_3`.`signal_number`
			INNER JOIN `committee_member_list`
			ON (`signal_5`.`committee_member_a` = `committee_member_list`.`c_name`) OR (`signal_5`.`committee_member_b` = `committee_member_list`.`c_name`)
			INNER JOIN `assistant_list`
			ON `signal_5`.`assistant_real` = `assistant_list`.`a_name`
			WHERE `signal_5`.`evaluation_date` LIKE ? AND
			(`signal_5`.`unit_name` LIKE ? OR
			`signal_5`.`consultation_address` LIKE ? OR
			`signal_5`.`contact_person_name` LIKE ? OR
			`signal_5`.`committee_member_a` LIKE ? OR
			`signal_5`.`committee_member_b` LIKE ? OR
			`signal_5`.`assistant_real` LIKE ? OR
			`signal_5`.`assistant_sign` LIKE ?) AND
			(`signal_5`.`committee_member_a` LIKE ? OR
			`signal_5`.`committee_member_b` LIKE ?) AND
			(`signal_5`.`assistant_real` LIKE ? OR
			`signal_5`.`assistant_sign` LIKE ?)
			GROUP BY `signal_5`.`signal_number` ";
		if ($_POST['search_month'] >= 1 && $_POST['search_month'] <= 9) {
			$keypoint_month = "____-"."0".$_POST['search_month']."-__";
		} elseif ($_POST['search_month'] == null) {
			$keypoint_month = "%".$_POST['search_month']."%";
		} else {
			$keypoint_month = "____-".$_POST['search_month']."-__";
		};

		$keypoint_k_un = "%".$_POST['search_keypoint']."%";
		$keypoint_k_ca = "%".$_POST['search_keypoint']."%";
		$keypoint_k_cpn = "%".$_POST['search_keypoint']."%";
		$keypoint_k_cma = "%".$_POST['search_keypoint']."%";
		$keypoint_k_cmb = "%".$_POST['search_keypoint']."%";
		$keypoint_k_ar = "%".$_POST['search_keypoint']."%";
		$keypoint_k_as = "%".$_POST['search_keypoint']."%";
		$keypoint_committee_cma = "%".$_POST['search_committee_member']."%";
		$keypoint_committee_cmb = "%".$_POST['search_committee_member']."%";
		$keypoint_assistant_ar = "%".$_POST['search_assistant']."%";
		$keypoint_assistant_as = "%".$_POST['search_assistant']."%";
		$result_search_k = $db_link->prepare($sql_query_search);
		$result_search_k->bind_param('ssssssssssss',
			$keypoint_month,
			$keypoint_k_un,
			$keypoint_k_ca,
			$keypoint_k_cpn,
			$keypoint_k_cma,
			$keypoint_k_cmb,
			$keypoint_k_ar,
			$keypoint_k_as,
			$keypoint_committee_cma,
			$keypoint_committee_cmb,
			$keypoint_assistant_ar,
			$keypoint_assistant_as
		);
		$result_search_k->execute();
		$result_search_k->bind_result($search_number, $search_un, $search_cpn, $search_cpp, $search_ca, $search_ed, $search_cma, $search_cap, $search_cmb, $search_cbp, $search_ar, $search_arp, $search_as, $search_et, $search_cca, $search_ce, $search_aa, $search_ae, $search_ccu, $search_ccp, $search_tf);
		$result_search_k->store_result();
		$b = $result_search_k->num_rows;
	}
?>
<!DOCTYPE html>
<html lang="zh">
	<head>
		<meta charset="utf8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			#navbar{
				background-color: #D0E0E3;
				font-size: 32px ;
				vertical-align: center;
				color: #76A5AF;
				margin-bottom: 2%;
			}
			.navbar-header{
				margin-left: 1%;
			}
			#row_search{
				color:#76A5AF ;
				font-family: "微軟正黑體";
				font-size: 22px ;
				font-weight: bolder;
				margin-bottom: 1%;
				margin-top: 1%;
			}
			#row_schedule{
				color:#76A5AF ;
				font-family: "微軟正黑體";
				font-size: 22px ;
				font-weight: bolder;
				margin-bottom: 1%;
				margin-top: 1%;
			}
			#row_month{
				color:#76A5AF ;
				font-family: "微軟正黑體";
				font-size: 22px ;
				font-weight: bolder;
				margin-bottom: 1%;
				margin-top: 1%;
			}
			#search_month{
				border-color: #76A5AF;
				color: #939393;
			}
			#search_keypoint{
				border-color: #76A5AF;
				margin-bottom: 1%;
				border-color: #76A5AF;
				width: 150%;
			}
			#search_committee_member{
				border-color: #76A5AF;
				color: #939393;
				border-color: #76A5AF;
				margin-bottom: 1%;
			}
			#search_assistant{
				border-color: #76A5AF;
				color: #939393;
				border-color: #76A5AF;
				margin-bottom: 1%;
				margin-left:8%;
			}
			.num_search{
				background-color: #FFE3E8;
				border-radius: 10px;
				padding-left:0.5%;
				padding-right:0.5%;
				color: #f48c9d;
			}
			
			#assistant_search{
				border-color: #76A5AF;
				margin-bottom: 1%;
			}
			#tbody{
				color: #272D2D;
				font-family: "微軟正黑體";
				font-size: 15px ;
				font-weight: normal;
			}
			.submit_Btn{
				margin-bottom: 1%;
			}
			.table-striped tbody tr:nth-of-type(odd) {
			background-color: #FFFFFF;
			}
			.table-striped tbody tr:nth-of-type(even) {
			background-color: rgba(0, 0, 0, 0.075);
			}
			.table-hover tbody tr:hover {
			color: #212529;
			background-color: #e4f4f1;
			}

					
		</style>
	</head>
	<body>
		<div class="row" id="navbar">
			<div class="col-xs-12 col-sm-12">
				<nav class="navbar">
					<div class="navbar-header">
					</div>
				</nav>
			</div>
		</div>
		<div class="container-fluid">
			<form action="index.php" method="post" id="form1"accept-charset="utf8" class="form-inline">
				<div class=row id="row_month">
					<span class="col-xs-12 col-sm-12 col-sm-offset-1">
						<label for="search_month">
							目前為
							<span>
								<select name="search_month" class="form-control" id="search_month">
									<option value="">請選擇月份</option>
									<option value=<?php $month_now = date("m"); echo "$month_now"; ?> >本月</option>
									<?php
										for ($m = 1; $m <= 12 ; $m++) {
											echo '<option value='.$m.'>'.$m.'月</option>';
										}
									?>
								</select>
							</span>
							<font><?php 
							if (isset($_POST["action_search"])) {
							echo $_POST["search_month"]; } ?>月份的行程

						</font>
						</label>
					</span>
				</div>
				<div class=row id="row_schedule">
					<span class="col-xs-4 col-sm-2 col-sm-offset-1">
						<!--<span class="has-feedback has-search">-->
							<label for="search_keypoint">
								<input type="text" name="search_keypoint" class="form-control" id="search_keypoint" placeholder="請輸入關鍵字">
							</label>
							<!--<span class="glyphicon glyphicon-search form-control-feedback"></span>-->
						<!--</span>-->
					</span>
					<span class="col-xs-6 col-sm-2">
							<label for="search_committee_member">
								<select class="form-control" name="search_committee_member" id="search_committee_member">
									<option value="">請選擇委員</option>
									<?php while($row_result_committee_member=$result_committee_member->fetch_assoc()){ ?>
									<option value=<?php echo $row_result_committee_member["c_name"]; ?> ><?php echo $row_result_committee_member["c_name"]; ?></option>
									<?php } ?>
								</select>
							</label>
							&nbsp;&emsp;
							<label for="search_assistant">
								<select class="form-control" name="search_assistant" id="search_assistant">
									<option value="">請選擇助理</option>
									<?php while($row_result_assistant=$result_assistant->fetch_assoc()){ ?>
									<option value=<?php echo $row_result_assistant["a_name"]; ?> ><?php echo $row_result_assistant["a_name"]; ?></option>
									<?php } ?>
								</select>
							</label>
					</span>
					<span class="col-xs-1 col-sm-1">
						
						<input  type="image"  name="submit_Btn"  id="submit_Btn"  img  src="image\WEB UI_img_07.png"  onClick="document.form1.submit()"  style="width:30% ; height:30">
						<input type="hidden" name="action_search" id="action_search" value="search">
					
					</span>
				</div>
			</form>
				<div class=row id="row_search">
					<div class="col-xs-10 col-sm-10 col-sm-offset-1">
						<?php if (!isset($_POST["action_search"])) {
							echo "評核時程表-依條件搜尋總家數：&nbsp;<span class='num_search' id='num_search' name='num_search'>".$a."</span>";
							echo ' &nbsp;(月份： '."<font style='color:#F48C9D'>本月</font>".')';
						} else {
							echo "評核時程表-依條件搜尋總家數：&nbsp;<span class='num_search' id='num_search' name='num_search'>".$b."</span> &nbsp;--->";
							if (!$_POST['search_month'] == null) {
								echo '(月份：'."<font style='color:#F48C9D'>".$_POST['search_month']."</font>月".') &nbsp;';
							}
							if (!$_POST['search_keypoint'] == null) {
								echo '(關鍵字：'."<font style='color:#F48C9D'>".$_POST['search_keypoint']."</font>".') &nbsp;';
							}
							if (!$_POST['search_committee_member'] == null) {
								echo '(委員：'."<font style='color:#F48C9D'>".$_POST['search_committee_member']."</font>".') &nbsp;';
							}
							if (!$_POST['search_assistant'] == null) {
								echo '(助理：'."<font style='color:#F48C9D'>".$_POST['search_assistant']."</font>".') &nbsp;';
							}		
						} ?>
					</div>
				</div>
				<div class="row" id="row_main">
					<div class="col-xs-10 col-sm-10 col-sm-offset-1">
						<table class="table table-striped table-hover" id="table" >
							<thead align="center" style="background-color:#76A5AF; color:#fff ; font-size:18px; font-family: '微軟正黑體'">
								<tr>
									<th style="border-top-left-radius:10px">案</th>
									<th>案號</th>
									<th>受評單位/聯絡人/地點</th>
									<th>評核日期</th>
									<th>評核時間</th>
									<th>A委員</th>
									<th>B委員</th>
									<th>助理</th>
									<th>簽名</th>
									<th style="border-top-right-radius:20px">備註</th>
								</tr>
							</thead>
							<tbody id="tbody">
								<?php if (!isset($_POST["action_search"])) {
								$i = 0; while ($result_search->fetch()) { ?>
								<tr>
									<td><?php $i = $i + 1; echo $i; ?></td>
									<td><?php echo $search_number; ?></td>
									<td><?php echo '<font style="color:#DD796C">'.$search_un.'</font>'; ?><br/>
										<?php echo $search_cpn."&nbsp;".$search_cpp; ?><br/>
										<?php echo '<a href="https://www.google.com.tw/maps/dir/24.135905264856316, 120.68771883107408/'.$search_ca.'"'.' target="_blank"><img src="image\WEB UI_img_04.png"></a>'; ?>
										<?php echo '<a href="https://www.google.com.tw/maps/dir//'.$search_ca.'"'.' target="_blank"><img src="image\WEB UI_img_05.png"></a>'; ?><br/>
										<?php echo $search_ca; ?><br/>
									</td>
									<td><?php echo $search_ed; ?>
										<?php
											$date_ed = strtotime($search_ed);
											if (date("N", $date_ed) == "1") {
												echo "(一)";
											}
											if (date("N", $date_ed) == "2") {
												echo "(二)";
											}
											if (date("N", $date_ed) == "3") {
												echo "(三)";
											}
											if (date("N", $date_ed) == "4") {
												echo "(四)";
											}
											if (date("N", $date_ed) == "5") {
												echo "(五)";
											}
											if (date("N", $date_ed) == "6") {
												echo "(六)";
											}
											if (date("N", $date_ed) == "7") {
												echo "(日)";
											}
										?>
									</td>
									<td><?php echo $search_et; ?></td>
									<td>
										<?php
											echo $search_cma."(".$search_cap.")"."<br/>";
											echo '<a href="https://www.google.com.tw/maps/dir/24.135905264856316, 120.68771883107408/'.$search_cca.'"'.' target="_blank"><img src="image\WEB UI_img_06.png"></a><br/>';
											echo $search_cca."<br/>";
											echo $search_ce."<br/>";
										?>
									</td>
									<td>
										<?php
											if ($search_cmb == null) {
												echo $search_tf."輔導"."<br/>";
											} else {
												echo $search_cmb."(".$search_cbp.")"."<br/>";
												echo '<a href="https://www.google.com.tw/maps/dir/24.135905264856316, 120.68771883107408/'.$search_cca.'"'.' target="_blank"><img src="image\WEB UI_img_06.png"></a><br/>';
												echo $search_cca."<br/>";
												echo $search_ce."<br/>";
											}
										?>
									</td>
									<td>
										<?php
											if ($search_ar == null) {
												echo $search_ar;
											} else {
												echo  $search_ar."<br/>";
												echo "(".$search_arp.")"."<br/>";
												echo $search_aa."<br/>";
												echo $search_ae."<br/>";
											}
										?>
									</td>
									<td><?php echo $search_as; ?></td>
									<td>
										<?php
											if ($search_tf == "第四次") {
												echo "<font style='color:#F48C9D'><img src='image\WEB UI_img_08.png'>&nbsp;最後一次</font>"."<br/>";
											} else {
												echo "<font style='color:#F48C9D'>".$search_tf."輔導</font><br/>";
											}
											if ($search_ccu == null && $search_ccp == null) {
												$date_ed = strtotime($search_ed);
												$date_now = strtotime("now");
												$days=round(($date_now-$date_ed)/3600/24);
												echo "未上傳： <font style='color:#F48C9D'>".$days."天</font><br/>";
												echo "未發文： <font style='color:#F48C9D'>".$days."天</font><br/>";
											} else {
												echo "上傳日： <font style='color:#F48C9D'>".date("Y-m-d", strtotime($search_ccu))."</font><br/>";
												echo "發文日： <font style='color:#F48C9D'>".date("Y-m-d", strtotime($search_ccp))."</font><br/>";
											}
										?>
									</td>
								</tr>
								<?php }; $result_search->free_result(); $result_search->close(); } elseif (isset($_POST["action_search"]) && (isset($_POST['search_month']) || isset($_POST['search_keypoint']) || isset($_POST['search_committee_member']) || isset($_POST['search_assistant']) )) {
								$j = 0; while ($result_search_k->fetch()) { ?>
								<tr>
									<td><?php $j = $j + 1; echo $j; ?></td>
									<td><?php echo $search_number; ?></td>
									<td><?php echo '<font style="color:#DD796C">'.$search_un.'</font>'; ?><br/>
										<?php echo $search_cpn."&nbsp;".$search_cpp; ?><br/>
										<?php echo '<a href="https://www.google.com.tw/maps/dir/24.135905264856316, 120.68771883107408/'.$search_ca.'"'.' target="_blank"><img src="image\WEB UI_img_04.png"></a>'; ?>
										<?php echo '<a href="https://www.google.com.tw/maps/dir//'.$search_ca.'"'.' target="_blank"><img src="image\WEB UI_img_05.png"></a>'; ?><br/>
										<?php echo $search_ca; ?><br/>
									</td>
									<td><?php echo $search_ed; ?>
										<?php
											$date_ed = strtotime($search_ed);
											if (date("N", $date_ed) == "1") {
											echo "(一)";
											}
											
											if (date("N", $date_ed) == "2") {
												echo "(二)";
											}
											if (date("N", $date_ed) == "3") {
												echo "(三)";
											}
											if (date("N", $date_ed) == "4") {
												echo "(四)";
											}
											if (date("N", $date_ed) == "5") {
												echo "(五)";
											}
											if (date("N", $date_ed) == "6") {
												echo "(六)";
											}
											if (date("N", $date_ed) == "7") {
												echo "(日)";
											}
										?>
									</td>
									<td><?php echo $search_et; ?></td>
									<td>
										<?php
											echo $search_cma."(".$search_cap.")"."<br/>";
											echo '<a href="https://www.google.com.tw/maps/dir/24.135905264856316, 120.68771883107408/'.$search_cca.'"'.' target="_blank"><img src="image\WEB UI_img_06.png"></a><br/>';
											echo $search_cca."<br/>";
											echo $search_ce."<br/>";
										?>
									</td>
									<td>
										<?php
											if ($search_cmb == null) {
												echo $search_tf."輔導"."<br/>";
											} else {
												echo $search_cmb."(".$search_cbp.")"."<br/>";
												echo '<a href="https://www.google.com.tw/maps/dir/24.135905264856316, 120.68771883107408/'.$search_cca.'"'.' target="_blank"><img src="image\WEB UI_img_06.png"></a><br/>';
												echo $search_cca."<br/>";
												echo $search_ce."<br/>";
											}
										?>
									</td>
									<td>
										<?php
											if ($search_ar == null) {
												echo $search_ar;
											} else {
												echo  $search_ar."<br/>";
												echo "(".$search_arp.")"."<br/>";
												echo $search_aa."<br/>";
												echo $search_ae."<br/>";
											}
										?>
									</td>
									<td><?php echo $search_as; ?></td>
									<td>
										<?php
											if ($search_tf == "第四次") {
											echo "<font style='color:#F48C9D'><img src='image\WEB UI_img_08.png'>&nbsp;最後一次</font><br/>";
											} else {
												echo "<font style='color:#F48C9D'>".$search_tf."輔導</font><br/>";
											}
											if ($search_ccu == null && $search_ccp == null) {
												$date_ed = strtotime($search_ed);
												$date_now = strtotime("now");
												$days=round(($date_now-$date_ed)/3600/24);
												echo "未上傳： <font style='color:#F48C9D'>".$days."天</font><br/>";
												echo "未發文： <font style='color:#F48C9D'>".$days."天</font><br/>";
											} else {
												echo "上傳日： <font style='color:#F48C9D'>".date("Y-m-d", strtotime($search_ccu))."</font><br/>";
												echo "發文日： <font style='color:#F48C9D'>".date("Y-m-d", strtotime($search_ccp))."</font><br/>";
											}
										?>
									</td>
								</tr>
								<?php }; $result_search_k->free_result(); $result_search_k->close(); } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php
				$db_link->close();
			?>
		</body>
	</html>