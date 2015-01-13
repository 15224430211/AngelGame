<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')天使游戏网 - Shift</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="bookmark" href="/favicon.ico"/>
    <!-- site css -->
    <link rel="stylesheet" href="/assets/bootflat/css/site.min.css">
    <link rel="stylesheet" href="/assets/styles/global.css">
    <!--[if lt IE 9]>
    <script src="/assets/bootflat/js/html5shiv.js"></script>
    <script src="/assets/bootflat/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/assets/bootflat/js/site.min.js"></script>
    @yield('head-assets')
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-5">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Shift</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5">
                    <ul class="nav navbar-nav">
                        <li><a href="/comment"><span class="glyphicon glyphicon-comment"></span> 评论</a></li>
                        <li><a href="/message"><span class="glyphicon glyphicon-envelope"></span> 短信</a></li>
                        <!--<li><a href="/follow"><span class="glyphicon glyphicon-user"></span> 好友</a></li>-->
                        <li><a href="/setting"><span class="glyphicon glyphicon-cog"></span> 设置</a></li>
                        <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>
                        <li><a href="#">Link</a></li>
                        <!-- <li class="disabled"><a href="#">Link</a></li> -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Setting</li>
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="active"><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li class="disabled"><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-search search-only">
                            <i class="search-icon glyphicon glyphicon-search"></i>
                            <input type="text" class="form-control search-query">
                        </div>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
</div>

<div class="content">
    @yield('content')
</div>

<footer class="content-info" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <h6>Shift
                    <small> A little gang</small>
                </h6>
                <p>我们是一群来自东北的苦孩子 <br>
                    +86 139-3661-5515 - admin@doudousong.com</p>
            </div>
        </div>
        <div class="sotto-footer text-right">
            <p class="copyright"><a href="http://blog.doudousong.com/">Copyright © 2014 北京兜兜送科技有限公司</a> - © 2014 Shift
                Design</p>
        </div>
    </div>
</footer>
@yield('foot-assets')
<script src="/assets/scripts/Site/global.js" type="text/javascript"></script>
<div style="display: none;">
    <script type="text/javascript">
//var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
//document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F0aec8e6005edfbd1c801d8c4a0f139e1' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
</body>
</html>
