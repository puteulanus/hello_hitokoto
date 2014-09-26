<?php
/*
Plugin Name: Hello Hitokoto
Plugin URI: http://www.puteulanus.com/archives/598
Description: 在Wordpress后台显示一言的一句话。
Author: Puteulanus
Version: 1.0
Author URI: http://www.puteulanus.com
*/
// 随机获取一言的一句话
function get_lyric_rand() {
$str = file_get_contents('http://api.hitokoto.us/rand');
$pattern = '/'.preg_quote('"hitokoto":"','/').'(.*?)'.preg_quote('",','/').'/i';
preg_match ($pattern,$str, $result);
return wptexturize($result[1]);
}

// 输出一句话
function hello_hitokoto() {
  $lyric = get_lyric_rand();
  echo "<p id='hitokoto'>$lyric</p>";
}

// 绑定操作
add_action( 'admin_notices', 'hello_hitokoto' );

// 使用css
function hitokoto_css() {
// 判定是否为从左向右
$x = is_rtl() ? 'left' : 'right';

echo "
<style type='text/css'>
#hitokoto {
  float: $x;
  padding-$x: 15px;
  padding-top: 5px;    
  margin: 0;
    font-size: 11px;
  }
  </style>
  ";
}

add_action( 'admin_head', 'hitokoto_css' );

?>
