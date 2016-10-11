<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>
          ubexchange - profile
          &middot; 
          @section('title') 
          @show 
    </title>
    <link rel="icon" type="image/png" href="#">
    <!-- CSS  -->
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/bootstrap.css" media="screen">
    <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/roboto.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/material.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/ripples.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/css/mystyle.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('assets')}}/pagedown/demo.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!--<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>-->
    <script src="{{URL::to('assets')}}/pagedown/Markdown.Converter.js"></script>
    <script src="{{URL::to('assets')}}/pagedown/Markdown.Sanitizer.js"></script>
    <script src="{{URL::to('assets')}}/pagedown/Markdown.Editor.js"></script>
    <!--
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
    </script>
    -->

</head>
<body>
<div class="navbar navbar-fixed navbar-defualt">
    <div class="container">
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}">ubexchange</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            {{Form::open(array('url'=>'search', 'method'=>'get', 'class'=>'navbar-form navbar-right'))}}
                <input type="text" class="form-control col-lg-8" name="search" placeholder="Search">
            {{Form::close()}}
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check()==NULL)
                    <li><a href="{{URL::to('register')}}">sign up</a></li>
                    <li><a href="{{URL::to('login')}}">log in</a></li>
                @endif
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{Auth::user()->name}}
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::to('profile')}}"><i class="fa fa-gear"></i>&nbsp;&nbsp;settings</a></li>
                        <li class="divider"></li>
                        <li><a href="{{URL::to('logout')}}"> <i class="fa fa-sign-out"></i>&nbsp;&nbsp;logout</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

    <!-- Site Content -->
<div class="container">

    @yield('content')


</div> <hr>

<div class="container">
    <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>
            <!--<a href="{{URL::to('contact_us')}}">tour</a>&nbsp;&nbsp;
            <a href="{{URL::to('contact_us')}}">help</a>&nbsp;&nbsp;
            <a href="{{URL::to('contact_us')}}">legal</a>&nbsp;&nbsp;
            <a href="{{URl::to('privacy_policy')}}">privacy policy</a>&nbsp;&nbsp;
            <a href="{{URL::to('contact_us')}}">contact us</a>&nbsp;&nbsp;
            <a href="{{URL::to('contact_us')}}">feedback</a>&nbsp;&nbsp;
            <a href=""></a>&nbsp;&nbsp;
            <br>-->
            &copy; {{date('Y')}} ubexchange Powered by <a href="http://nuketeck.com" target="_blank">Nuketeck.com</a>
            </p>
           

          </div>
        </div>
    </footer>
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

            $('#menu > ul.nav-tabs li').click(function(e) {
                $('.nav li.active').removeClass('active');
                var $this = $(this);
                $this.addClass('active');
                e.preventDefault();
            });
        </script>
        <script type="text/javascript">
            (function () {
                var converter2 = new Markdown.Converter();

                converter2.hooks.chain("preConversion", function (text) {
                    return text.replace(/\b(a\w*)/gi, "*$1*");
                });

                converter2.hooks.chain("plainLinkText", function (url) {
                    return "This is a link to " + url.replace(/^https?:\/\//, "");
                });
                
                var help = function () { alert("Do you need help?"); }
                var options = {
                    helpButton: { handler: help },
                    strings: { quoteexample: "whatever you're quoting, put it right here" }
                };
                var editor2 = new Markdown.Editor(converter2, "-second", options);
                
                editor2.run();
            })();
        </script>

</body>
</html>
