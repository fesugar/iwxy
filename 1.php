<?php echo '1'; exit; ?>


<!DOCTYPE html>
<html>
<head>
<title>??</title>
<meta name="Keywords" content="???">
<meta name="Description" content="????">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
<link rel="stylesheet" href="assets/css/main.css" />
<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
<noscript>
<link rel="stylesheet" href="assets/css/noscript.css" />
<link rel="icon" href="favicon.ico" />
</noscript>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            cursor:url('images/cur.cur'),auto;
            moz-user-select: -moz-none;
            -moz-user-select: none;
            -o-user-select:none;
            -khtml-user-select:none;
            -webkit-user-select:none;
            -ms-user-select:none;
            user-select:none;
        }
        .container {
            display: none;
            position: absolute;
            top: 25%;
            width: 88%;
            height: auto;
            padding: 10px;
            border: 1px solid orange;
            background-color: rgba(255, 255, 255, 0.71);
            z-index:1002;
            overflow: auto;
            left: 5%;
            letter-spacing: 0em;
        }
        hr {
            display: block;
            width: 7rem;
            height: 1px;
            margin: 2.5rem 0;
            background-color: #eee;
            border: 0;
        }

        a {
            color: #08c;
            text-decoration: none;
        }
        button {
            line-height: 0em;
        }
        .aplayer .aplayer-list {
            height: 6em !important;
        }
        .black_overlay{ 
            display: none; 
            position: absolute; 
            top: 0%; 
            left: 0%; 
            width: 80%; 
            height: auto; 
            background-color: black; 
            z-index:1001; 
            -moz-opacity: 0.8; 
            opacity:.80; 
            filter: alpha(opacity=88); 
        } 
        /*心跳*/
        .heart{
            
           animation: heartbeat 0.9s linear 0s infinite;
        }
        @keyframes heartbeat{
            0%{transform: rotate(0deg) scale(0.8,0.8); opacity: 1;}
            25%{transform: rotate(0deg) scale(1,1); opacity: 0.8;}
            100%{transform: rotate(0deg) scale(0.8,0.8); opacity: 1;}
        }
        /*字体*/
        @font-face { 
            font-family: 'hksl';
            src: url('assets/fonts/hksl.eot');
            src: url('assets/fonts/hksl.eot?#iefix') format('embedded-opentype'),
            url('assets/fonts/hksl.woff') format('woff'),
            url('assets/fonts/hksl.ttf') format('truetype'),
            url('assets/fonts/hksl.svg#NeuesBauenDemo') format('svg');
            font-weight: normal;
            font-style: normal;
        }  
    </style>
    <link rel="stylesheet" href="assets/css/style.css" media="screen" type="text/css" />
</head>
<body class="is-loading" oncontextmenu="self.event.returnValue=false" onselectstart="return false" >
<script type="text/javascript">     
$(document).ready(function() {          
    var canvas = document.getElementById("c");
    var ctx = canvas.getContext("2d");
    var c = $("#c");
    var w,h;
    var pi = Math.PI;
    var all_attribute = {
        num:100,                         // 个数
        start_probability:0.1,           // 如果数量小于num，有这些几率添加一个新的                
        radius_min:1,                    // 初始半径最小值
        radius_max:2,                    // 初始半径最大值
        radius_add_min:.3,               // 半径增加最小值
        radius_add_max:.5,               // 半径增加最大值
        opacity_min:0.3,                 // 初始透明度最小值
        opacity_max:0.5,                 // 初始透明度最大值
        opacity_prev_min:.003,            // 透明度递减值最小值
        opacity_prev_max:.005,            // 透明度递减值最大值
        light_min:40,                 // 颜色亮度最小值
        light_max:70,                 // 颜色亮度最大值
    };
    var style_color = find_random(0,360);  
    var all_element =[];
    window_resize();
    function start(){
        window.requestAnimationFrame(start);
        style_color+=.1;
        ctx.fillStyle = 'hsl('+style_color+',100%,97%)';
        ctx.fillRect(0, 0, w, h);
        if (all_element.length < all_attribute.num && Math.random() < all_attribute.start_probability){
            all_element.push(new ready_run);
        }
        all_element.map(function(line) {
            line.to_step();
        })
    }
    function ready_run(){
        this.to_reset();
    }
    ready_run.prototype = {
        to_reset:function(){
            var t = this;
            t.x = find_random(0,w);
            t.y = find_random(0,h);
            t.radius = find_random(all_attribute.radius_min,all_attribute.radius_max);
            t.radius_change = find_random(all_attribute.radius_add_min,all_attribute.radius_add_max);
            t.opacity = find_random(all_attribute.opacity_min,all_attribute.opacity_max);
            t.opacity_change = find_random(all_attribute.opacity_prev_min,all_attribute.opacity_prev_max);
            t.light = find_random(all_attribute.light_min,all_attribute.light_max);
            t.color = 'hsl('+style_color+',100%,'+t.light+'%)';
        },
        to_step:function(){
            var t = this;
            t.opacity -= t.opacity_change;
            t.radius += t.radius_change;
            if(t.opacity <= 0){
                t.to_reset();
                return false;
            }
            ctx.fillStyle = t.color;
            ctx.globalAlpha = t.opacity;
            ctx.beginPath();
            ctx.arc(t.x,t.y,t.radius,0,2*pi,true);
            ctx.closePath();
            ctx.fill();
            ctx.globalAlpha = 1;
        }
    }
    function window_resize(){
        //w = window.innerWidth;
        //h = window.innerHeight;
        //解决页面有滚动条的全页背景效果
        w = document.body.scrollWidth;
        h = document.body.scrollHeight;
        canvas.width = w;
        canvas.height = h;
    }
    $(window).resize(function(){
        window_resize();
    });
    function find_random(num_one,num_two){
        return Math.random()*(num_two-num_one)+num_one;
    }
    (function() {
        var lastTime = 0;
        var vendors = ['webkit', 'moz'];
        for(var xx = 0; xx < vendors.length && !window.requestAnimationFrame; ++xx) {
            window.requestAnimationFrame = window[vendors[xx] + 'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[xx] + 'CancelAnimationFrame'] ||
                                          window[vendors[xx] + 'CancelRequestAnimationFrame'];
        }
    
        if (!window.requestAnimationFrame) {
            window.requestAnimationFrame = function(callback, element) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max(0, 16.7 - (currTime - lastTime));
                var id = window.setTimeout(function() {
                    callback(currTime + timeToCall);
                }, timeToCall);
                lastTime = currTime + timeToCall;
                return id;
            };
        }
        if (!window.cancelAnimationFrame) {
            window.cancelAnimationFrame = function(id) {
                clearTimeout(id);
            };
        }
    }());
    start();
});
</script>
<canvas id="c" width="auto" height="auto" style="position:absolute; z-index:-1; opacity: 0.5; "></canvas>
<!-- Wrapper -->
<div id="wrapper" >
<!-- Main -->
<section id="main">
  <header>
    <div style="position:absolute; z-index:3; width: 100%; height: 100%; top: 0%;">
      <h3>ʕु•̫͡•ʔु ✧域名不转让，勿扰，谢谢！</h3>
    </div>
    <div  style="font-family:arial,hksl; padding:20px; border:20px; position:absolute; z-index:3; width: 100%; height: 100%; top: 0%;"> 
      <div style="color:#7297bd">
        <h2><strong>烧香拜佛·心明如镜</strong></h2>
        _ 不忘初心，方得始终！
        <div style="color:green" class="loader font2"> <span>刚</span> <span class="span2">🍀</span> <span class="span3">好</span> <span class="span4">🍀</span> <span class="span5">遇</span> <span class="span6">🍀</span> <span class="span7">见</span> <span class="span8">🍀</span> <span class="span9">你</span> </div>
      </div>
      <br/>by: 糖~ <div style="color:rgba(245, 159, 0, 0.97)" id="runtime_span"></div>
      <div id="days_span" style="font-size: 150%;color: rgba(223, 22, 22, 0.86);font-style: oblique;">
<!-- <?php
$startdate=strtotime("2016-05-01");
$enddate=strtotime(date('Y-m-d'));
$days=round(($enddate-$startdate)/3600/24) ;
echo "<br/>♥ ".$days." ♥~ Days<br/>"; //days为得到的天数;
?> --> 

      </div>
      <div style="font-size: 115%; font-style: italic; text-align: center;margin-left: -10%;">
        <p>Forever friends: <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
        <img class="heart" style="width: 100%;height: 100%;" src="images/i.svg"  alt="I love you"></a></p>
      </div>
    </div>
  </header>
  <!--<footer>
      <ul class="icons">
        <li><a href="#" class="fa-twitter">Twitter</a></li>
        <li><a href="#" class="fa-instagram">Instagram</a></li>
        <li><a href="#" class="fa-facebook">Facebook</a></li>
      </ul>
    </footer>-->
</section>
<!-- Footer -->
<footer id="footer">
  <div style="text-align: center; font-size: 150%; font-style: italic;">
    <ul class="copyright">
      <li>&copy; 2017-2027</li>
    </ul>
  </div>
</footer>
<!-- // -->
<div id="light" class="container">
    <div style="color: chocolate; font-size: 80%; font-weight: bold;">喜欢的音乐</div>
    <div id="player5" class="aplayer"></div>
    <!-- <iframe width="100%" height="250" src="//music.163.com/outchain/player?type=0&amp;id=?&amp;auto=0&amp;height=250" border="10"></iframe> -->
    <div id="fade" class="black_overlay"></div>
    <p style="margin-bottom: 0px;">Forever friends: <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">如此,安好! [✘]</a></p>
</div>
</div>
<script src="assets/js/APlayer.min.js"></script>
<script src="list.js1.php"></script>
<!-- // -->
<!-- Scripts -->
<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
<script>
    if ('addEventListener' in window) {
        window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
        document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
    }
	<!-- 随机背景图 -->
    var randomBgIndex =  parseInt(4*Math.random());
            document.write('<style> body{ background-image: url("assets/css/images/overlay.png"), -moz-linear-gradient(60deg, rgba(255, 165, 150, 0.5) 5%, rgba(0, 228, 255, 0.35)), url("images/'+ randomBgIndex +'41668c5902b791e538eb063f3352b39.svg"); background-image: url("assets/css/images/overlay.png"), -webkit-linear-gradient(60deg, rgba(255, 165, 150, 0.5) 5%, rgba(0, 228, 255, 0.35)), url("images/'+ randomBgIndex +'41668c5902b791e538eb063f3352b39.svg"); background-image: url("assets/css/images/overlay.png"), -ms-linear-gradient(60deg, rgba(255, 165, 150, 0.5) 5%, rgba(0, 228, 255, 0.35)), url("images/'+ randomBgIndex +'41668c5902b791e538eb063f3352b39.svg"); background-image: url("assets/css/images/overlay.png"), linear-gradient(60deg, rgba(255, 165, 150, 0.5) 5%, rgba(0, 228, 255, 0.35)), url("images/'+ randomBgIndex +'41668c5902b791e538eb063f3352b39.svg");  }</style>'
    );
</script>
<!-- 运行时间 -->
<script type = "text/javascript" >
function show_runtime() {
        window.setTimeout("show_runtime()", 15000);
        X = new Date("9/10/2017 00:00:00");
        Y = new Date($.ajax({url:"/?"+Math.random(),async: false}).getResponseHeader("Date"));
        T = (Y.getTime() - X.getTime());
        M = 24 * 60 * 60 * 1000;
        a = T / M;
        A = Math.floor(a);
        b = (a - A) * 24;
        B = Math.floor(b);
        c = (b - B) * 60;
        C = Math.floor((b - B) * 60);
        D = Math.floor((c - C) * 60);
        day=A+497;
        runtime_span.innerHTML = "稳定运行" + A + "天" + B + "时" + C + "分" //+ D + "秒"
        days_span.innerHTML = "<br/>♥ "+day+" ♥~ Days<br/>";
}
show_runtime(); 
</script>
<!-- 处理js广告 劫持 -->
<script>
(function () {
    var createElement = document.createElement;
    document.createElement = function (tag) {
        switch (tag) {
            case 'script':
                console.log('禁用动态添加脚本，防止广告加载');
                break;
            default:
                return createElement.apply(this, arguments);
        }
    }
})();
</script>

</body>
</html>
