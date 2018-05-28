<!DOCTYPE html>
<html lang="es">

<head>
    <title>Taxi-Tec</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/Lv2.ico">
    <!-- Estílos -->
    <link rel="stylesheet" href="includes/styles.css">
    <!-- Normalize -->
    <link rel="stylesheet" href="includes/normalize.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Signika+Negative' rel='stylesheet' type='text/css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Metas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/parallax.js"></script>
</head>

<body>

    <!-- Portada -->
    <section>
	    <div class="cover">
	        <div class="content">
	            <div class="content">
	            	<h1>Bienvenido</h1>
	                
	            </div>
	            <a href="#bienvenida" , class="icon fa fa-arrow-down"></a>
	        </div>
	    </div>
    </section>
    <!-- Bienvenida -->
    <section class="info">
        <h2 id="bienvenida">Taxi-Tec</h2>
	</section>

    <script type="text/javascript">
        $('a').click(function(e){               
        e.preventDefault();     //evitar el eventos del enlace normal
        var strAncla=$(this).attr('href'); //id del ancla
            $('body,html').stop(true,true).animate({                
                scrollTop: $(strAncla).offset().top
            },1000);
        
    });
    </script>
</body>

</html>
