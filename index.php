<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Homepage</title>
<style>
body{
	padding:0;
	margin:0;
}
.container{
	width:468px;
	height:294px;
	background:linear-gradient(rgba(0,51,255,1),rgba(0,0,0,1));
	border:1px solid rgb(0,0,0);
	box-shadow:rgba(0,0,0,0.5) 0.5px 0.5px 1px 4px;
	padding-bottom:0px;
	padding-left:10px;
	padding-right:10px;
	padding-top:10px;
	margin-left:438px;
	margin-top:-192px;
	margin-bottom:-50px;
	min-width:400px;
	}
.btn{
	height:10px;
	width:20px;
	border-radius:40px;
	padding-left:5px;
	padding-right:5px;
	padding-top:10px;
	padding-bottom:10px;
	background:linear-gradient(rgba(0,0,255,0.5) 10%,rgba(0%,60%,100%,1)90%);
	/*box-shadow:rgba(0,0,0,0.4) 0.5px 0.5px 2px 7px;*/
	border:rgba(0,0,0,0.5) 1px solid;
	margin-left:465px;
	margin-bottom:10px;
	color:rgb(102,255,0);
	cursor:pointer;
	}
.btn:hover{
	background:rgb(0,0,0);
	color:rgb(255,255,0);
	font-size:100%;
	cursor:pointer;
	box-shadow:rgba(0,255,255,0.3) 0.5px 0.5px 2px 7px;
	font:Georgia, "Times New Roman", Times, serif;
}
body{
	background-size:cover;
}
.fr{
	font-size:40px;
	font:"Bleeding Cowboys";
	}
.rr{
	font-size:17px;
}
p{
	margin-top:-10px;
}
#outerbox{
	background:rgba(255,255,255,0.5);
	width:479px;
	overflow:hidden;
	margin-left:-10px;
	margin-right:20px;
	margin-top:-10px;
}
#sliderbox{
	position:relative;
	width:2500px;
	animation: slide  15s infinite;
}
#sliderbox img{
	
}
@keyframes slide{
	0%
	{
		left:0px;
	}
	20%
	{
		left:-0px;
	}
	25%
	{
		left:-490px;
	}
	45%
	{
		left:-580px;
	}
	50%{
		left:-660px;
	}
	70%{
		left:-760px;
	}
	75%{
		left:-860px;
	}
	95%{
		left:-940px;
	}
	100%{
		left:-1480px;
	}}
	@media(max-width:100%) and (min-width: 520px){
@viewport{
	width:640px;
}
	}
.img{
	-webkit-animation: anim 10s infinite linear;
	animation: anim 10s infinite linear;
	-moz-animation: anim 10s infinite linear;
	margin-left:100px;
	margin-top:90px;
}
@-moz-keyframes anim{
	from{-moz-transform:rotateY(0deg);}
	to{-moz-transform:rotateY(360deg);}
}
@-webkit-keyframes anim{
	from{-webkit-transform:rotateY(0deg);}
	to{-webkit-transform:rotateY(360deg);}
}
@keyframes anim{
	from{transform:rotateY(0deg);}
	to{transform:rotateY(360deg);}
	}	
</style>
<link rel="stylesheet" href="3D-Cover-Flow-Style-Image-Carousel-Plugin-with-jQuery-Cloud-9-Carousel/css/main.css">
<link href="../SoftwareEngineering/jctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="slideshow-master/slideshow.css">
</head>

<body background="images/apple_mac-1280x800.jpg">

<noscript>
<h1 align="center" style="color:rgb(255,0,0); height:200px; width:300px;">Please enable javascript to continue or use a browser that supports javascript</h1>
<style>
.container{display:none;
}
.h{display:none;
}
img{display:none;
}
.f{display:none;
}
body{
	background:rgb(255,255,255);
	}
</style>
</noscript>

<h1 class="h" align="center" style="color:rgb(255,255,255);">VALLEY VIEW MEDIA CENTRE MANAGEMENT SYSTEM</h1>

<img src="images/306124_541498592537628_1801543291_n.png.jpg" width="120" height="120" class="img">
<div class="container">
<div id="showcase" class="noselect" style="position: relative; overflow-x: hidden; overflow-y: hidden; visibility: visible; "> 

<img src="images/french_musicians_daft_punk-1280x800.jpg" width="239.5" height="149" class="cloud9-item"><img src="images/iata-care-este-singurul-radio-din-romania-invitat-.jpg" width="239.5" height="149" class="cloud9-item"><img src="images/mac_apple-1280x800.jpg" height="149" class="cloud9-item">

<img src="images/satellite-soyuz-spaceship-space-station-41006.jpg" width="239.5" height="149" class="cloud9-item">

</div>


<form action="login.php">
<input type="image" src="images/arrow-r.jpg"  class="btn" title="login">
</form>


<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div align="center">
<div style="background:rgba(255,255,255,0.5); width:90%; height:10%;" class="f">
Copyright &copy; SOFTWARE ENGINEERING GROUP2,2017
</div>
</div>
</div>

 <script src="slideshow-master/slideshow.js"></script>
<script src="../jquery-2.2.3.min.js"></script> 
<script src="3D-Cover-Flow-Style-Image-Carousel-Plugin-with-jQuery-Cloud-9-Carousel/jquery.reflection.js"></script> 
<script src="3D-Cover-Flow-Style-Image-Carousel-Plugin-with-jQuery-Cloud-9-Carousel/jquery.cloud9carousel.js"></script> 
<script>
    $(function() {
      var showcase = $("#showcase")

      showcase.Cloud9Carousel( {
        yPos: 42,
        yRadius: 48,
        mirrorOptions: {
          gap: 12,
          height: 0.2
        },
        buttonLeft: $(".nav > .left"),
        buttonRight: $(".nav > .right"),
        autoPlay: true,
        bringToFront: true,
        onRendered: showcaseUpdated,
        onLoaded: function() {
          showcase.css( 'visibility', 'visible' )
          showcase.css( 'display', 'none' )
          showcase.fadeIn( 1500 )
        }
      } )

      function showcaseUpdated( showcase ) {
        var title = $('#item-title').html(
          $(showcase.nearestItem()).attr( 'alt' )
        )

        var c = Math.cos((showcase.floatIndex() % 1) * 2 * Math.PI)
        title.css('opacity', 0.5 + (0.5 * c))
      }

      // Simulate physical button click effect
      $('.nav > button').click( function( e ) {
        var b = $(e.target).addClass( 'down' )
        setTimeout( function() { b.removeClass( 'down' ) }, 80 )
      } )

      $(document).keydown( function( e ) {
        //
        // More codes: http://www.javascripter.net/faq/keycodes.htm
        //
        switch( e.keyCode ) {
          /* left arrow */
          case 37:
            $('.nav > .left').click()
            break

          /* right arrow */
          case 39:
            $('.nav > .right').click()
        }
      } )
    })
  </script> 
</body>
</html>