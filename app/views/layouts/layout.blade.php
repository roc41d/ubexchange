<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="google-signin-client_id" content="1055839816416-t7c1qgi5t28nl53hl49lms891fkf43vp.apps.googleusercontent.com">
    <title>
          ubexchange
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
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="{{URL::to('assets')}}/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({selector:'#question'});</script>
    <script>tinymce.init({selector:'#comment'});</script>

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
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5644f2e2fdc6d289" async="async"></script>

<div class="navbar navbar-default ">
    <div class="container">
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text-muted" href="{{URL::to('/')}}">ubexchange</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check()==NULL)
                <li><a href="{{URL::to('register')}}">sign up</a></li>
                <li><a href="{{URL::to('login')}}">log in</a></li>
                <!--<li><a href="#" data-toggle="modal" data-target="#complete-dialog">log in</a></li>

                <div id="complete-dialog" class="modal fade" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Dialog</h4>
                      </div>
                      <div class="modal-body">
                        <p>Fore aut non quem incididunt, varias reprehenderit deserunt quem offendit,
                          cillum proident ne reprehenderit, quem ad laborum, quo possumus praetermissum,
                          si ne illustriora, hic appellat coniunctione, do labore aliqua quo probant. In
                          probant voluptatibus quo mentitum est laboris. Quorum mandaremus graviterque.
                          Mentitum id velit, dolor aut litteris, ea varias illustriora, ita commodo ita
                          ingeniis, iis nulla appellat incurreret, aut irure amet summis pariatur ita ubi
                          quis dolore veniam proident, consequat sed ingeniis.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Dismiss</button>
                      </div>
                    </div>
                  </div>
                </div>-->
                @endif

                @if(Auth::check())
                <li class="dropdown">
                    <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::to('profile')}}"><i class="fa fa-gear"></i>&nbsp;&nbsp;settings</a></li>
                        <li class="divider"></li>
                        <li><a href="{{URL::to('logout')}}"> <i class="fa fa-sign-out"></i>&nbsp;&nbsp;logout</a></li>
                    </ul>
                </li>
                @endif
                {{Form::open(array('url'=>'search', 'method'=>'get', 'class'=>'navbar-form navbar-right'))}}
                    <input type="text" class="form-control col-lg-8" name="search" placeholder="Search">
                {{Form::close()}}
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
            <br> -->
            &copy; {{date('Y')}} ubexchange Powered by <a href="http://nuketeck.com" target="_blank">Nuketeck.com</a><br>
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
    <script id="dsq-count-scr" src="//ubexchange.disqus.com/count.js" async></script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

        <script>
            $('.carousel').carousel({
                interval: 3000
            })
        </script>
        <script>
        $(document).ready(function(){
            $("#hide").click(function(){
                $("#comment").hide('slow');
            });
            $("#show").click(function(){
                $("#comment").show('slow');
            });
        });
        </script>


</body>
</html>
