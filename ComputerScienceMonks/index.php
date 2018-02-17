<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Jeffersonian Order</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=MedievalSharp" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=UnifrakturMaguntia" rel="stylesheet" />

    <!-- Custom Style Sheet -->
    <link href="monkstyles.css" rel="stylesheet" />

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body>

    <!-- BEGIN HEADER -->
    <header class="container" role="banner">
        <!-- BEGIN ROW-->
        <div class="row justify-content-end">
            <div class="col col-md-6">
                <!-- BEGIN ROW-->
                <div class="row">
                    <div class="col-12">
                        <h1 id="oldeUni">The University of Virginia</h1>
                    </div>
                </div><!-- END ROW-->
                <!-- BEGIN ROW-->
                <div class="row">
                    <div class="col-12">
                        <h3>The Jeffersonian Order of Engineering and Applied Science</h3>
                    </div>
                </div><!-- END ROW-->
            </div>
            <div class="col-md-4 d-none d-md-block d-print-none">
                <img src="img/medievalmonks.jpg" class="img-fluid" alt="Medieval Monks" />
            </div>
        </div><!-- END ROW-->
    </header><!--END HEADER-->


    <!--BEGIN NAVBAR-->
    <div class="container navColor">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <a class="navbar-brand" href="#">Information on Students and Course</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#information" aria-controls="information" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="information">
                <ul class="nav navbar-nav mr-auto" id="nav-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Students-tab" data-toggle="tab" href="#Students" role="tab" aria-controls="Students" aria-selected="true">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Courses-tab" data-toggle="tab" href="#Courses" role="tab" aria-controls="Courses" aria-selected="false">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="SCbyS-tab" data-toggle="tab" href="#SCbyS" role="tab" aria-controls="SCbyS" aria-selected="false">Students/Courses by Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="SCbyD-tab" data-toggle="tab" href="#SCbyD" role="tab" aria-controls="SCbyD" aria-selected="false">Students/Courses by Department</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div><!--END NAVBAR-->


    <!--BEGIN MAIN-->
    <main class="container" role="main">

        <!-- BEGIN ROW-->
        <div class="row">

            <!--BEGIN BAR CONTENT-->
            <div class="col col-md-10 offset-md-1 tab-content py-3">

                <!--BEGIN PANE STUDENTS-->
                <div class="tab-pane fade" id="Students" role="tabpanel" aria-labelledby="Students-tab">

                    <!--BEGIN ROW-->
                    <div class="row">
                        <h4 class="col">Information on Novices (Students)</h4>
                    </div><!--END ROW-->
                    <!--BEGIN ROW-->
                    <div class="row">

                        <div class="col">
                            <table class="table table-hover table-responsive">

                                <!--students--><?php
                                require_once 'view.php';
                                // this function from view will generate the students pane
                                studentsPane();
                                               ?>
                            </table>
                        </div>

                    </div><!--END ROW-->

                </div><!--END PANE STUDENTS-->
                <!--BEGIN PANE COURSES-->
                <div class="tab-pane fade" id="Courses" role="tabpanel" aria-labelledby="Courses-tab">

                    <!--BEGIN ROW-->
                    <div class="row">
                        <h4 class="col">Information on Courses</h4>
                    </div><!--END ROW-->
                    <!--BEGIN ROW-->
                    <div class="row">

                        <div class="col">
                            <table class="table table-hover table-responsive">

                                <!--courses--><?php
                                require_once 'view.php';
                                // this function from view will generate the courses pane
                                coursesPane();
                                              ?>

                            </table>
                        </div>

                    </div><!--END ROW-->

                </div><!--END PANE COURSES-->
                <!--BEGIN PANE SCBYS-->
                <div class="tab-pane fade" id="SCbyS" role="tabpanel" aria-labelledby="SCbyS-tab" >

                    <!--BEGIN ROW-->
                    <div class="row">
                        <h4 class="col">Student/Course Information by Student</h4>
                    </div><!--END ROW-->
                    <!--BEGIN ROW-->
                    <div class="row">

                        <div class="col">
                            <table class="table table-hover table-responsive">

                                <!--student/course information by student--><?php
                                require_once 'view.php';
                                // this function from view will generate the SCbyS pane
                                bystudPane();
                                                                            ?>

                            </table>
                        </div>

                    </div><!--END ROW-->

                </div><!--END SCBYS COURSES-->
                <!--BEGIN PANE SCbyD-->
                <div class="tab-pane fade" id="SCbyD" role="tabpanel" aria-labelledby="SCbyD-tab">

                    <!--BEGIN ROW-->
                    <div class="row">
                        <h4 class="col">Student/Course Information by Department</h4>
                    </div><!--END ROW-->
                    <!--BEGIN ROW-->
                    <div class="row">

                        <div class="col">
                            <table class="table table-hover table-responsive">

                                <!--student/course information by department--><?php
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

        <!-- END ROW -->
        <!-- BEGIN ROW-->
        <div class="row">

            <div class="col d-none d-md-block d-print-none col-md-7 offset-md-2 py-2">
                <img src="img/Normans_Bayeux.jpg" class="img-fluid" alt="Bayeux Trapestry" />
            </div>

        </div><!-- END ROW-->

    </main><!--END MAIN-->


    <!--BEGIN FOOTER-->
    <footer class="container">

        <!-- BEGIN ROW-->
        <div class="row align-items-center">

            <div class="col-3 offset-1 d-none d-md-block d-print-none p-md-3">
                <img src="img/monksdifferentorders1.jpg" class="img-fluid" alt="Orders of monks" id="difformonks" />
            </div>

            <div class="col col-md-7 py-3">
                <!-- BEGIN ROW-->
                <div class="row">
                    <div class="col">
                        <p>
                            At the University of Virginia, men and women devote their lives to answering the call of science, engineering,
                            and mathematics.  In quiet contemplation, they seek a deep spiritual bond with the applied sciences.
                            Through a hidden life of silence, prayer, study, and penance, they witness the reality of the laws of science.
                        </p>
                    </div>
                </div><!-- END ROW-->
                <!-- BEGIN ROW-->
                <div class="row">
                    <div class="col">
                        <h4>Founded by Saint Thomas Jefferson</h4>
                    </div>
                </div><!-- END ROW-->
            </div>

        </div><!-- END ROW-->

    </footer><!--END FOOTER-->
</body>
</html>
