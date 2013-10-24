<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>Cancer Report</title> 
 
	<!-- Application Version:1.5.1.5267  --> 
 
	<meta name="description" content="Car dealership, expose your auto inventory on hundreds of websites through our car advertising network, local and worldwide broadcasting of your entire inventory, call now 866-926-7265"/> 
	<meta name="keywords" content="car dealership online marketing, auto dealer marketing, car dealership advertising, auto dealer advertising, Internet advertising car dealers"/>
  <style>
    body{
      text-align: center; 
      margin: 0px; 
      background: #fff; 
      font-family: arial; 
      font-size: 15px; 
      width: 100%;
    }
    h2{
      margin: 0px;
    }
    img{
    	border: none;
    }
    #header{
      padding: 10px; background: #3a0000; height: 100px; position: relative;
    }
    #searchBar{
      bottom: 0px; text-align: right; float: right; color: #fff;
    }
    #addressContainer{
      float: left;
    }
    #breadcrumbs a:link, #breadcrumbs a:visited{
      color: #fff;
      font-size: 13px;
      border-right: 1px #fff solid;
      padding-right: 10px;
    }
    #nav{
      padding: 10px;
      height: 25px;
      background: #000;
    }
    #contents{
    	text-align: left;
    	width: 923px;
    }
  </style>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/dist/jquery.jqplot.min.js"></script>
  <script type="text/javascript" src="js/dist/plugins/jqplot.dateAxisRenderer.min.js"></script>
  <link rel="stylesheet" href="js/dist/jquery.jqplot.min.css"></script>
  <script>
  $(document).ready(function(){
	  	var test = Array();
		$('#carImages img').each(function(i){
			test[i] = $(this);
			checkImage(test[i]);
		})
		function checkImage(test){
			var imgTesting = new Image();

			function CreateDelegate(contextObject, delegateMethod)
			{
			    return function()
			    {
			        return delegateMethod.apply(contextObject, arguments);
			    }
			}

			function imgTesting_onload(){
				
			}

			function PushError(imgTesting){
				test.attr('src', 'images/noPhoto.jpg');
			}

			imgTesting.onload = CreateDelegate(imgTesting, imgTesting_onload);
			setTimeout(function(){ if(imgTesting.width ==0){ imgTesting.src = 'images/nophoto.jpg'; test.attr('src', 'images/nophoto.jpg') } }, 5000);
			imgTesting.src = test.attr('src');
		}
  });
</script>
  
</head>
<html>
  <body>
    <div style="height: 90px; background: url(images/top_background.jpg);">
    	<div style="text-align: left; width: 921px; margin: 0px auto;"><img src="images/cancer_logo.jpg" /></div>
    </div>
    <div style="margin: 0px auto; width: 971px;" id="contents"><?php echo $contents->contents; ?></div></div>
    <?php include('footer.php'); ?>
    <?php if(DEBUG == 1){ ?>
    <div><?php echo $contents->debug; ?></div>
    <div style="clear: both;"></div>
    <?php } ?>
  </body>
</html>