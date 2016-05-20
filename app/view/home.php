<?php  require_once("menu.php"); 


 ?>

<h1 style="text-align:center">Welcome To our Virtual Judge<small><br><h6>Designed by Managwy</h6><br><br>


<script type="text/javascript" src="http://onlinehtmltools.com/clocks/analog-clock/index_files/coolclock.js"></script>
<canvas style="width: 170px; height: 170px;" id="_coolclock_auto_id_44" class="CoolClock:Sun"></canvas><br />
<a href="http://onlinehtmltools.com/clocks/analog-clock/" title="Analog Clock For Websites" style="text-decoration:none;color:#606060;"></a>

<br><br>




</small></h1>





<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo $host.'/public/css/APlayer.min.css';?>>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .container {
            max-width: 32rem;
            margin-left: auto;
            margin-right: auto;
        }
        h1 {
            font-size: 54px;
            color: #333;
            margin: 30px 0 10px;
        }
        h2 {
            font-size: 22px;
            color: #555;
        }
        h3 {
            font-size: 24px;
            color: #555;
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
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        
       
        <div id="player1" class="aplayer"></div>
		<br><br><br><br>
    </div>
	<div style="text-align:center">
	<iframe width="560" height="315" src="https://www.youtube.com/embed/2PJCDaKoecM?rel=0" frameborder="0" allowfullscreen></iframe>
	</div>
    <script src=<?php echo $host.'/public/js/APlayer.min.js';?>></script>
    <script>
        var ap1 = new APlayer({
            element: document.getElementById('player1'),
            narrow: false,
            autoplay: false,
            showlrc: false,
            music: {
                title: 'Hall of Fame (Opening Ceremony, ACM ICPC 2013 World Finals)',
                author: '',
				url: 'http://s4.3lbh.com/s/95oE35Fm.mp3',
                pic: 'https://i.ytimg.com/vi/s0Qh-gy7ktA/maxresdefault.jpg'
            }
        });
        ap1.init();
        
       
    </script>
</body>
</html>






