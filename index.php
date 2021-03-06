<?php
require_once './config.php';
require_once './app.php';
require_once './db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo APP_TITLE; ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <link href="css/pace.css" rel="stylesheet">
        <script data-pace-options='{"restartOnRequestAfter": 200}' src="js/pace.min.js"></script>

        <!-- MetisMenu CSS -->
        <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="css/plugins/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- APP CSS -->
        <link href="css/app.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="login">

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">
                <div class="col-xs-4 navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="logo col-xs-4">
                    <img src="/img/logo.jpg" />
                </div>
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right col-xs-4">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#" id="logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a class="active ajax" href="#/main/home"><i class="fa fa-dashboard fa-fw"></i> Início</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-group fa-fw"></i> Grupos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a class="ajax" href="#/grupo/listar" rel="/grupo/listar.php">Listar</a>
                                    </li>
                                    <li>
                                        <a class="ajax" href="#/grupo/cadastrar" rel="/grupo/cadastrar.php">Cadastrar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-book fa-fw"></i> Aulas<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a class="ajax" href="#/aula/listar" rel="/aula/listar.php">Listar</a>
                                    </li>
                                    <li>
                                        <a class="ajax" href="#/aula/cadastrar" rel="/aula/cadastrar.php">Cadastrar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube-play fa-fw"></i> Videos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a class="ajax" href="#/videos/listar">Listar</a>
                                    </li>
                                    <li>
                                        <a class="ajax" href="#/videos/cadastrar">Cadastrar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-image fa-fw"></i> Slides<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a class="ajax" href="#/slides/listar">Listar</a>
                                    </li>
                                    <li>
                                        <a class="ajax" href="#/slides/cadastrar">Cadastrar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-list fa-fw"></i> Questionários<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a class="ajax" href="#/questionario/listar">Listar</a>
                                    </li>
                                    <li>
                                        <a class="ajax" href="#/questionario/cadastrar">Cadastrar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-question-circle fa-fw"></i> Quiz<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a class="ajax" href="#/quiz/listar">Listar</a>
                                    </li>
                                    <li>
                                        <a class="ajax" href="#/quiz/cadastrar">Cadastrar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div class="row logo-login">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <img src="../../img/logo-teach.jpg" />
                </div>
            </div>
            <div id="page-wrapper">
                <!-- /.row -->
                <div class="row">
                    <div id="content" class="col-lg-12"></div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery-1.11.0.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <!--<script src="js/plugins/morris/raphael.min.js"></script>-->
        <!--<script src="js/plugins/morris/morris.min.js"></script>-->
        <!--<script src="js/plugins/morris/morris-data.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>
        <script src="js/app.js"></script>

    </body>

</html>
