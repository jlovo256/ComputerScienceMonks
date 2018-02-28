<?php // nav.php
namespace csmonks;

function nav()
{

    $html = <<<HTML

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
    </div>
HTML;

    echo $html;
}
