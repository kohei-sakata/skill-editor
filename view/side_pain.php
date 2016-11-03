<?php
/**
* session check.
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/skill_editor/gatekeeper.php');
//
require_once(full_path('models/html_handler.php'));
/**
* 
*/
function makeSideItems($proj_list, $current_proj_tbl_list = null) {
	global $URL;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
	<script src="<?=addFilemtime('js/side_menu.js')?>"></script>
	<link rel="stylesheet" type="text/css" href="<?=addFilemtime('css/common.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=addFilemtime('css/fonts.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=addFilemtime('css/side_menu.css')?>">
	<title>Editor on Browser</title>
</head>
<body>
	<header class="with-btns">
		<h2>Projects</h2>
		<ul>
			<a href="#" id="new-proj" class="btn"><li class="icon-database" title="新規作成"></li></a>
		</ul>
	</header>
    <ul class="side-menu" id="menu-list">
        <?php foreach ($proj_list as $proj_id => $proj_name) {
			$proj_id = HTMLHandler::specialchars($proj_id);
			$href = $URL.'?id='.$proj_id;
			echo '<li><div class="with-btns">';
			echo '<a href="'.$href.'" onclick="changeEditor('.$proj_id.');"><h2>'.HTMLHandler::specialchars($proj_name).'</h2></a>';
			echo '<ul>
			<li class="icon-folder-plus btn" title="テーブルの追加"></li>
			<li class="icon-bin btn" title="プロジェクトの削除"></li>
			</ul>';
			echo '</div>';
			if (isset($_GET['id']) && $_GET['id'] == $proj_id) {
				echo '<ul class="side-children">'.PHP_EOL;
				foreach ($current_proj_tbl_list as $tbl_num => $tbl_name) {
					echo '<li class="with-btns">
					<a href="'.$href.'#tab'.HTMLHandler::specialchars($tbl_num).'" onclick="changeTab(this);">'
					.HTMLHandler::specialchars($tbl_name).'</a>
					<ul>
					<li class="icon-bin btn" title="テーブルの削除"></li>
					</ul>
					</li>'.PHP_EOL;
				}
				echo '</ul>';
			}
			echo '</li>'.PHP_EOL;
		} ?>
        <!-- <li><input type="file" id="file_select" onchange="handleFileSelect(this)"></li>-->
    </ul>
</body>
</html>