<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Jeffersonian Order</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=MedievalSharp" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=UnifrakturMaguntia" rel="stylesheet" />

    <!-- Custom Style Sheet -->
    <link href="monkstyles.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- BEGIN OUTER CONTAINER -->
<div class="container" id="wrapper">

    <!-- BEGIN ROW-->
    <div class="row">
        <header class="header panel-header col-md-12">

            <!-- BEGIN ROW-->
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2">
                    <!-- BEGIN ROW-->
                    <div class="row">
                        <h1 id="oldeUni" class="h1 col-md-12">The University of Virginia</h1>
                    </div><!-- END ROW-->
                    <!-- BEGIN ROW-->
                    <div class="row">
                        <h3 class="h3 col-md-12">The Jeffersonian Order of Engineering and Applied Science</h3>
                    </div><!-- END ROW-->
                </div>

                <img src="Assets/medievalmonks.jpg" class="hidden-xs hidden-sm col-md-4 col-lg-4 hidden-print" alt="Medieval Monks" />

            </div><!-- END ROW-->
        </header>
    </div><!-- END ROW-->
    <!-- BEGIN ROW-->
    <div class="row">

        <!-- BEGIN INNER WRAPPER -->
        <div class="col-md-12" id="innerwrapper">

            <!-- BEGIN ROW-->
            <div class="row">

                <!-- BEGIN NAVBAR -->
                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <!--FOR MOBILE currently does not behave properly-->
                        <div class="navbar-header">

                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#information" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Information on Students and Courses</a>
                        </div><!--END FOR MOBILE-->

                        <ul class="nav navbar-nav" id="information">

                            <li class="active">
                                <a data-toggle="tab" href="#Students">Students<span class="sr-only">(current)</span></a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#Courses">Courses</a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Student/Course<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a data-toggle="tab" href="#SCbyS">By Student</a></li>
                                    <li><a data-toggle="tab" href="#SCbyD">By Department</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div><!-- /.container-fluid -->
                </nav>

            </div><!-- END ROW-->
            <!-- BEGIN ROW-->
            <div class="row">

                <!--BEGIN BAR CONTENT-->
                <div class="col-md-10 col-md-offset-1 tab-content">

                    <!--BEGIN PANE STUDENTS-->
                    <div class="tab-pane fade in" id="Students">

                        <!--BEGIN ROW-->
                        <div class="row">
                            <h4 class="col-md-12">Information on Novices (Students)</h4>
                        </div><!--END ROW-->
                        <!--BEGIN ROW-->
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-hover table-responsive">

                                    <!--students-->
                                    <?php
                                    require_once 'view.php';
                                        // this function from view will generate the students pane
                                        studentsPane();
                                    ?>
                                </table>
                            </div>

                        </div><!--END ROW-->

                    </div><!--END PANE STUDENTS-->
                    <!--BEGIN PANE COURSES-->
                    <div class="tab-pane fade in" id="Courses">

                        <!--BEGIN ROW-->
                        <div class="row">
                            <h4 class="col-md-12">Information on Courses</h4>
                        </div><!--END ROW-->
                        <!--BEGIN ROW-->
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-hover table-responsive">

                                    <!--courses-->
                                    <?php
                                    require_once 'view.php';
                                        // this function from view will generate the courses pane
                                        coursesPane();
                                    ?>

                                </table>
                            </div>

                        </div><!--END ROW-->

                    </div><!--END PANE COURSES-->
                    <!--BEGIN PANE SCBYS-->
                    <div class="tab-pane fade in" id="SCbyS">

                        <!--BEGIN ROW-->
                        <div class="row">
                            <h4 class="col-md-12">Student/Course Information by Student</h4>
                        </div><!--END ROW-->
                        <!--BEGIN ROW-->
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-hover table-responsive">

                                    <!--student/course information by student-->
                                    <?php
                                    require_once 'view.php';
                                        // this function from view will generate the SCbyS pane
                                        bystudPane();
                                    ?>

                                </table>
                            </div>

                        </div><!--END ROW-->

                    </div><!--END SCBYS COURSES-->
                    <!--BEGIN PANE SCbyD-->
                    <div class="tab-pane fade in" id="SCbyD">

                        <!--BEGIN ROW-->
                        <div class="row">
                            <h4 class="col-md-12">Student/Course Information by Department</h4>
                        </div><!--END ROW-->
                        <!--BEGIN ROW-->
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-hover table-responsive">

                                    <!--student/course information by department-->
                                    <?php
                                    require_once 'view.php';
                                        // this function from view will generate the SCbyD pane
                                        bydeptPane();
                                    ?>

                                </table>
                            </div>

                        </div><!--END ROW-->

                    </div><!--END PANE SCbyD-->

                </div><!--END BAR CONTENT-->

            </div><!-- END ROW-->
            <!-- BEGIN ROW -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <!--test connection-->
                    <?php
                    require_once 'view.php';
                        // this function from view will check the connection to the database
                        checkConn();
                    ?>
                </div>
            </div>
            <!-- END ROW -->

            <!-- BEGIN ROW-->
            <div class="row">

                <div class="hidden-xs hidden-sm col-md-offset-2 col-md-7 col-lg-offset-2 col-lg-7 topPad bottomPad">
                    <img src="Assets/Normans_Bayeux.jpg" alt="Bayeux Trapestry" />
                </div>

            </div><!-- END ROW-->

        </div><!-- END INNER WRAPPER -->
    </div><!-- END ROW-->
    <!-- BEGIN ROW-->
    <div class="row">
        <footer class="footer col-md-12">

            <!-- BEGIN ROW-->
            <div class="row">

                <div class="hidden-xs hidden-sm col-md-3 col-lg-3 hidden-print allPad">
                    <img src="Assets/monksdifferentorders1.jpg" class="img-rounded" alt="Different orders of monks" id="difformonks" />
                </div>

                <div class="col-md-7 allPad" id="bottomInfo">
                    <!-- BEGIN ROW-->
                    <div class="row">
                        <p class="p">
                            At the University of Virginia, men and women devote their lives to answering the call of science, engineering,
                            and mathematics.  In quiet contemplation, they seek a deep spiritual bond with the applied sciences.
                            Through a hidden life of silence, prayer, study, and penance, they witness the reality of the laws of science.
                        </p>
                    </div><!-- END ROW-->
                    <!-- BEGIN ROW-->
                    <div class="row">
                        <h4 class="h4">Founded by Saint Thomas Jefferson</h4>
                    </div><!-- END ROW-->
                </div>

            </div><!-- END ROW-->

        </footer>
    </div><!-- END ROW-->

</div> <!-- END OUTER CONTAINER -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
