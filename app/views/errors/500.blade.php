<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>error</title>
    <link rel="icon" type="image/png" href="#">
    <!-- CSS  -->
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/bootstrap.css" media="screen">
    <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/roboto.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/material.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/ripples.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/mystyle.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/error.css" rel="stylesheet">

</head>
<body id="five-o-o">
    <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>
          <h1>(x_x)</h1>
          <h3>Sorry! our servers seem to be dormant, we are fixing</h3>
          <a href="http://ubex.nuketeck.com/" class="btn btn-large btn-primary">back to home</a>
        </p>
      </div>
    </div>

    <!--  Scripts-->
    <script src="{{URL::to('assets')}}/js/jquery.js"></script>
    <script src="{{URL::to('assets')}}/js/bootstrap.js"></script>

    <script src="{{URL::to('assets')}}/js/ripples.min.js"></script>
    <script src="{{URL::to('assets')}}/js/material.min.js"></script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

</body>
</html>
