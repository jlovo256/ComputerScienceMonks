<?php

function mainview()
{

    $html = <<<HTML

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

                            <!--students-->
HTML;
    echo $html;
    require_once('ComputerScienceMonks/view.php');
    // this function from view will generate the students pane
    studentsPane();

    $html = <<<HTML
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

                            <!--courses-->
HTML;
    echo $html;
    require_once 'ComputerScienceMonks/view.php';
    // this function from view will generate the courses pane
    coursesPane();

    $html = <<<HTML
                        </table>
                    </div>

                </div><!--END ROW-->

            </div><!--END PANE COURSES-->
            <!--BEGIN PANE SCBYS-->
            <div class="tab-pane fade" id="SCbyS" role="tabpanel" aria-labelledby="SCbyS-tab">

                <!--BEGIN ROW-->
                <div class="row">
                    <h4 class="col">Student/Course Information by Student</h4>
                </div><!--END ROW-->
                <!--BEGIN ROW-->
                <div class="row">

                    <div class="col">
                        <table class="table table-hover table-responsive">

                            <!--student/course information by student-->
HTML;
    echo $html;
    require_once 'ComputerScienceMonks/view.php';
    // this function from view will generate the SCbyS pane
    bystudPane();

    $html = <<<HTML
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

                            <!--student/course information by department-->
HTML;
    echo $html;
    require_once 'ComputerScienceMonks/view.php';
    // this function from view will generate the SCbyD pane
    bydeptPane();

    $html = <<<HTML
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
            <img src="./public/img/Normans_Bayeux.jpg" class="img-fluid" alt="Bayeux Trapestry" />
        </div>

    </div><!-- END ROW-->

</main><!--END MAIN-->

HTML;

    echo $html;
}

