<?php
// Start YOURLS engine
require_once( dirname(__FILE__).'/includes/load-yourls.php' );

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DZ.GG 短网址</title>
<link rel="stylesheet" href="<?php yourls_site_url(); ?>/css/style.css?v=<?php echo YOURLS_VERSION; ?>" type="text/css" media="screen" />

<style>

</style>
<link rel="stylesheet" href="<?php echo YOURLS_SITE; ?>/css/share.css?v=<?php echo YOURLS_VERSION; ?>" type="text/css" media="screen" />
<script src="<?php echo YOURLS_SITE; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="<?php yourls_site_url(); ?>/js/share.js?v=<?php echo YOURLS_VERSION; ?>" type="text/javascript"></script>
		<script src="<?php yourls_site_url(); ?>/js/jquery.zclip.min.js?v=<?php echo YOURLS_VERSION; ?>" type="text/javascript"></script>
</head>

<body class="index desktop">
<center>
<a href="<?php yourls_site_url(); ?>">
	<img src="<?php yourls_site_url(); ?>/images/yourls-logo.png" alt="DZ.gg 免费短网址" title="DZ.gg 免费短网址" border="0" style="border: 0px;margin:50px;" />
</a>
</center>

<?php

function show_form()
{
	echo <<<FORM
		<div id="wrap"  style="width:830px">
		<br />
		<form method="post" action="">
		<p><label><b>输入要缩短的长网址：</b> <input type="text" id="add-url" name="url" value="http://" size="80" /></label></p>
		<p><label><b>自定义短网址(可选)：</b> <input type="text" id="add-keyword" name="keyword" size="10" /></label> http://dz.gg/<b>xxx</b> 可输入字母和数字，留空则随机生成 </p>
		<center><input type="submit" id="add-button" name="add-button" class="button" style="font-size:15px" value="立即生成" /></center>
		</form>
FORM;
}
function show_msg($message)
{
	echo <<<MSG
	<hr style="border:1px solid #2a85b3">
	<p><b>$message</b></p>
MSG;
}
// Part to be executed if FORM has been submitted
if ( isset($_REQUEST['url']) )
{

	$url = $_REQUEST['url'];
	$keyword = isset( $_REQUEST['keyword'] ) ? $_REQUEST['keyword'] : '' ;
	$return = yourls_add_new_link( $url, $keyword, $title );

	if($return['code']!=='error:flood')
	{
		show_form();
	}
	$shorturl = $return['shorturl'];
	$message = $return['message'];
	$title   = $return['title'];
	show_msg($message);

	// Include the Copy box and the Quick Share box
	if(isset($shorturl))
		yourls_share_box( $url, $shorturl, $title );
	else
		echo "访问 <a href='".YOURLS_SITE."/$keyword' target='_blank'>".YOURLS_SITE."/$keyword</a>";
// Part to be executed when no form has been submitted
}
else
{
	show_form();
}

?>
</div>
<p style="width:830px">
<!-- 广告位：首页，底部-->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<div id="footer">
<p style="width: 830px;"><span style="color: #595441;"><a style="color: #595441;" href="./about.html">关于我们</a> | <a style="color: #595441;" title="服务协议" href="./services.html">服务协议</a> | <a style="color: #595441;" title="dz.gg" href="http://www.weixiaoduo.com/dzgg" target="_blank">源码下载</a> | <a style="color: #595441;" title="域名出售" href="http://www.chuangyimi.com" target="_blank">域名出售</a> | <a style="color: #595441;" title="汉中微网" href="http://www.091616.com" target="_blank">汉中微网</a>  | <a style="color: #595441;" title="版权声明" href="http://www.weixiaoduo.com/license" target="_blank">版权声明</a> | <a style="color: #595441;" title="dz.gg" href="./feedback.html">违规处理</a></span></p>
<p style="width: 830px;">Copyright © <span style="color: #595441;"><a style="color: #595441;" href="http://www.weixiaoduo.com" target="_blank"> Weixiadouo.com</a></span> | All Rights Reserved.</p>
</body>
</html>
