<?php
	//画像フォルダの指定
	$directory = "./images";
	
	//*.jpgのファイルを取得
	$files = glob($directory."/*.jpg");
	
	$finfo = finfo_open();
	//画像ファイルデータの取得
	foreach($files as $imgPath){
		
		$mine_type = finfo_file($finfo, $imgPath,FILEINFO_MIME_TYPE);
			//echo("{$imgPath}/");
			//echo("{$mine_type}</br>");
			
			if($mine_type ==='image/jpeg'){
				$imges[] = $imgPath;
			}
	}
	//print_r($imges);
	finfo_close($finfo);
	
?>
	<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>ギャラリー</title>
		<link rel="stylesheet" href="./index.css" />
	</head>
	<body>
		<p class="attention">画像をクリックすると拡大されます</p>
		<div class="gallery">
			<ul class="gallery-items">
				<?php
					// 表示するサムネイルのサイズ
					$thumbsize = 200;
					// 1ページあたりの表示数
					$perPage = 6;

					// 現在のページ
					$currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
					if (!$currentPage) {
						$currentPage = 1;
					}
				
					//画像の総数
					$imgCount = count($imges);
				
					// 現在のページで最初に表示する画像の番号
					$start = ($currentPage - 1) * $perPage;
					
					// 現在のページで最後に表示する画像の番号
					$end = $start + $perPage - 1;
				
				
					//配列にあるだけの画像を表示
					$count = count($imges)-1;
					for($i=$start; $i<=$end && $i<$imgCount; $i++){
						//$imgSize[幅,高さ]
						$imgSize = getimagesize($imges[$i]);
						if($imgSize[0]>$imgSize[1]){
							//元のデータ画像の辺の比
							$ratio = $imgSize[0] / $thumbsize;
						
							$imgWidth = $imgSize[0] / $ratio;
							$imgHeight = $imgSize[1] / $ratio;
						}else if($imgSize[0]<$imgSize[1]){
							$ratio = $imgSize[1] / $thumbsize;						
						
							$imgWidth = $imgSize[0] / $ratio;
							$imgHeight = $imgSize[1] / $ratio;
							
						}
						
						echo("<li class=gallery-item ><img id=\"gallery{$i}\" src=\"$imges[$i]\" alt='' width=\"$imgWidth\" height=\"$imgHeight\"></li>");
					}
				?>
				
			</ul>
	
			<nav>
				<ol id="pagenaition">
					<?php 
						//ページネーション
						
						//ページネーションのリンクの最大ページ数を計算
						$totalPage = ceil($count / $perPage);
						//最初のページのリンク、１ページ目は表示しない
						if($currentPage != 1) {
							echo("<li><a href=\"./index.php?page=1\">≪ first</a></li>");
						}
						//ページ番号の一覧表示
						for($page = 1; $page <= $totalPage; $page++) {
							if($page == $currentPage) {
								//現在のページの場合
								echo("<li><span class=current>$page</span></li>");
							}else {
								//それ以外は通常のリンク(aタグ)を出力
								echo("<li><a href=\"./index.php?page=$page\">$page</a></li>");
							}
						}
						//最後のページに飛ぶリンク、最後のページは表示しない
						if($currentPage != $totalPage) {
							echo("<li><a href=\"./index.php?page=$totalPage\">last ≫</a></li>");
						}
					?>
				</ol>
			</nav>
		</div>
		
		<div class = "slideShow" id ="slideShow">
			<div class = "slideShow__area">
				<img id = "slideShow__img" src="" width="" height="" alt="クリック画像">
				<div class = slideShow__button>
					<input id="closeButton" type="button" value="閉じる">
				</div>
			</div>
		</div>
		
		<script src="./jquery.js"></script>
		<script src="./index.js"></script>
	</body>
</html>
