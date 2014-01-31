<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>visualCaptcha Demo</title>

        <link href="/css/visualcaptcha.css" media="all" rel="stylesheet" type="text/css" />

        <script src="/js/jquery.min.js"></script>
        <script src="/js/visualcaptcha.jquery.js"></script>
        <script src="/js/main.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Fill in the form and submit it</h1>

            <form name="frm-sample" id="frm-sample" action="/try" method="post">
                <input type="text" class="form-control" placeholder="Name" />

                <div class="captcha"></div>

                <button type="submit" name="submit-bt" class="submit">Submit form</button>
            </form>
        </div>
    </body>
</html>