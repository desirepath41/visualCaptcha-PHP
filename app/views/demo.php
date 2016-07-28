<!DOCTYPE html>
<html>
    <head>
        <title>visualCaptcha PHP and jQuery Demo - The best captcha alternative</title>
        <meta charset="utf-8">

        <meta name="keywords" content="visualcaptcha, captcha, jquery, php, turing test, mobile-friendly, accessible, accessibility, retina-friendly, better captcha, fancy captcha, captcha alternative, demo">
        <meta name="description" content="A cool visual captcha jQuery plugin. Mobile-friendly. Retina-ready. Accessible.">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- favicon.ico and apple-touch-icon.png  -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
        
        <!-- CSS -->
        <link href="css/demo.css" media="all" rel="stylesheet">
        <link href="http://emotionloop.github.io/visualCaptcha-frontend-core/dist/visualcaptcha.css" media="all" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="wrap">
            <a href="/" target="_blank" class="logo"><img src="img/logo.png" alt="visualCaptcha"></a>
            <div class="pre-captcha-wrapper">
                <div class="captcha-wrapper">
                    <h1>Fill in the form and submit it</h1>
                    <form name="frm-sample" class="frm-sample" action="try" method="post">
                        <input type="text" class="form-control" placeholder="Name">
                        <div id="status-message"></div>
                        <div id="sample-captcha"></div>
                        <a id="check-is-filled" class='info-btn'>Check if visualCaptcha is filled</a>
                        <button type="submit" name="submit-bt" class="submit">Submit form</button>
                    </form>
                </div>
            </div> 
            <div class="links">
                <p class="txt-center">
                    <a href="/" target="_blank"><b>visualCaptcha</b></a> by <a href="http://emotionloop.com/" target="_blank"><b>emotionLoop</b></a>
                    <br />
                    View other demos:
                    <br />
                    <a href="https://github.com/emotionLoop/visualCaptcha-node"><strong>Node.js</strong></a> |
                    <a href="https://github.com/emotionLoop/visualCaptcha-ruby"><strong>Ruby</strong></a> |
                    <a href="https://github.com/emotionLoop/visualCaptcha-django"><strong>Django</strong></a> |
                    <a href="http://multiple.demo.visualcaptcha.net/"><strong>Multiple</strong></a>
                    <br />
                    You can get it (and more languages) at <a href="https://github.com/emotionLoop/visualCaptcha" target="_blank"><b>GitHub</b></a>
                </p>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="http://emotionloop.github.io/visualCaptcha-frontend-core/dist/visualcaptcha.jquery.js"></script>
        <script src="js/main.js"></script>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-43214420-4', 'visualcaptcha.net');
		ga('send', 'pageview');

	</script>

    </body>
</html>

