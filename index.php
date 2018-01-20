<?php 
//DB定義
const DB = "";
const DB_ID = "";
const DB_PW = "";
const DB_NAME = "";

//PDOでデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost;dbname=gsblog_db;charset=utf8','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文（最新順番3つ取得）
$query = "SELECT * FROM gsblog_table ORDER BY time DESC LIMIT 3";
//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($query);
$flag = $stmt->execute();

if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/sanitize.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<!--header-->
<div class="header">
	<h1 class="site-title">Tatsuya Kosuge Portfolio Web</h1>
</div>
<!--//header-->
	
<!--navigation-->
<div class="navigation">
	<div class="wrapper">
		<ul class="nav-list">
			<li class="nav-item">
				<a href="#about">About</a>
			</li>
			<li class="nav-item">
				<a href="#history">History</a>
			</li>
			<li class="nav-item">
				<a href="#works">Contact</a>
			</li>
		</ul>		
	</div>
</div>
<!--// navigation-->

<!--about me-->
<div class="section section__about" id="about">
	<div class="text-center">
		<h2 class="content-title">About Me</h2>
		<p class="profile-thumb"><img src="images/profile.png" alt="コスゲタツヤの顔写真"></p>
		<p class="profile-name">コスゲタツヤ</p>
        <p class="profile-text">埼玉県出身。Webサイトなどの制作業だけでなく、デジタルハリウッドSTUDIOでのトレーナーや、
	デジタルハリウッドが運営するエンジニア養成スクール「G’sAcademy（ジーズアカデミー）」での
	トレーナーとしての現場指導や、映像教材の開発・出演、Schoo WebCampus「Google Apps Script
	入門講座」の講師を担当するなど、教育業に深く関わることが多い。最近は個人のブログ「Arrown（アロウン）」を中心にしたライティング活動も積極的に行っている。</p>	
	</div>
</div>
<!--// about me-->
	
<!--History-->
<div class="section section__history" id="history">
	<h2 class="content-title content-title__history">History</h2>
	<div class="history-outer">
		<ul class="history-list">
			<li class="history-item">1982年　埼玉県に生まれる。</li>
			<li class="history-item">2003年　車にひかれて前歯損傷。</li>
			<li class="history-item">2012年　Web勉強始める。</li>
		</ul>
	</div>
</div>
<!--// History-->
	
<!--Works-->
<div class="section section__work" id="work">
	<h2 class="content-title">Works</h2>	
	<div class="wrapper">
		<ul class="work-list">
		<?php
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo '<li class="work-item">';
			echo '<div class="work-thumb">';
			echo '<img src="https://placehold.jp/300x200.png" alt="オリジナルイラスト年賀状の画像">';
			echo '</div>';
			echo '<h3 class="work-title">' . $result["title"]. '</h3>';
			echo '<p>' . $result["detail"]. '</p>';
			echo '</li>';
		}
		?>
		</ul>
		
	</div>
	<a href="#" class="btn-more">作品集をもっと見る</a>
</div>
<!--// Works-->

<!--footer-->
<div class="footer">
	<p class="copyrights">copyrights 2017 Tatsuya Kosuge All Rights Reserved.</p>
</div>
<!--// footer-->

</body>
</html>

<?php 
}