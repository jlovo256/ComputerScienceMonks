<?php

function about()
{
    $html = <<<HTML

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


HTML;

    echo $html;
}
