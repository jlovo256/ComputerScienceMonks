<?php // view.php
namespace csmonks;

/**
 * view The view generates html for index.php, using data retrieved through
 * controller.php
 *
 * view view.php generates html for the panes, which display tables, in index.php
 * It interacts with controller.php and index.php
 *
 * @version 2.0
 * @author Jamie Tudor
 */

require_once 'controller.php';


/*
 * The view calls two static functions in the controller to connect to the database,
 * and then create the tables inside the database.
 */
Controller::connect();
Controller::createDB();

/*
 * This function calls a method in the controller.  The function will be used by
 * index.php to check the connection to the database.
 */
function checkConn() {
    Controller::checkCon();
} // end function checkConn

/**
 * Summary of tableHeader
 * This function creates the headers for the tables in the pane.  The column headers will arrange
 * the data when clicked in alphabetical order.  They will arrange in descending order when clicked
 * again.
 * It uses an array (param $formNames) from the controller class to generate the names for the form
 * values.
 * It uses a string (param $orderBy) from the controller class to create a default value
 * It calles the tabHead method from the controller to decide whether to add a DESC or not
 * @param mixed $formNames
 * @param mixed $orderBy
 * @return mixed
 */
function tableHeader($formNames, $orderBy) {
    echo "<tr>";

    // this is stupid
    // This foreach thing makes forms that have if statements which change
    // the value depending on what is in POST
    foreach ($formNames as $formName => $orderName)
    {
        echo "<th>
                <form action=\"index.php\" method=\"post\">
                    <input type=\"hidden\" name=\"$formName\"";
        // it needs to check isset first or it will die
        if (!isset($_POST[$formName]) || $_POST[$formName] == "") {
            echo " value=\"click1\""; // wasn't clicked
        }
        else if ($_POST[$formName] == "click1") {
            echo " value=\"click2\""; // clicked once
            $orderBy = Controller::tabHead($orderName[0], true); // set a POST variable
        }
        else if ($_POST[$formName] == "click2") {
            echo " value=\"click1\""; // clicked twice
            $orderBy = Controller::tabHead($orderName[0], false); // set a POST variable
        }

        echo "/>
                <input type=\"submit\" value=\"$orderName[1]\" />
            </form>
        </th>";

    } // end foreach

    echo "</tr>";

    return $orderBy;

} // end function tableHeader

/**
 * Summary of studentsPane
 * The studentsPane function generates the html for the students pane
 * It calls the tableHeader function to generate the table header for
 * the students data table.  It calls the getStudentsPane method from the
 * controller to get the data from the mysql database. It is called
 * by index.php
 */
function studentsPane() {

    // get a 2D array of the data for the table
    $students = Controller::getStudentsPane();

    // print the array
    for ($i = 0; $i < count($students); $i++)
    {
        echo "<tr>";
        for ($j = 0; $j < 7 ; $j++)
        {
            echo "<td>" .  $students[$i][$j] . "</td>";
        }
        echo "</tr>";
    }


} // end function studentsPane

/**
 * Summary of coursesPane
 * The coursesPane function generates the html for the courses pane
 * It calls the tableHeader function to generate the table header for
 * the courses data table.  It calls the getCoursesPane method from the
 * controller to get the data from the mysql database. It is called
 * by index.php
 */
function coursesPane() {

    // get a 2D array of the data for the table
    $courses = Controller::getCoursesPane();

    // print the array
    for ($i = 0; $i < count($courses); $i++)
    {
        echo "<tr>";
        for ($j = 0; $j < 4; $j++)
        {
            echo "<td>" . $courses[$i][$j] . "</td>";
        }
        echo "</tr>";
    }

} // end function coursesPane

/**
 * Summary of bystudPane
 * The bystudPane function generates the html for the SCbyS pane
 * It calls the tableHeader function to generate the table header for
 * the SCbyS data table.  It calls the getSCbySPane method from the
 * controller to get the data from the mysql database. It is called
 * by index.php
 */
function bystudPane() {

    // get a 2D array of the data for the table
    $bys = Controller::getSCbySPane();

    // print the array
    for ($i = 0; $i < count($bys); $i++)
    {
        echo "<tr>";
        for ($j = 0; $j < 7; $j++)
        {
            echo "<td>" . $bys[$i][$j] . "</td>";
        }
        echo "</tr>";
    }

} // end function bystudPane

/**
 * Summary of bydeptPane
 * The bydeptPane function generates the html for the SCbyD pane
 * It calls the tableHeader function to generate the table header for
 * the SCbyD data table.  It calls the getSCbyD method from the
 * controller to get the data from the mysql database.  It is called
 * by index.php
 */
function bydeptPane() {

    // get a 2D array of the data for the table
    $byd = Controller::getSCbyDPane();

    // print the array
    for ($i = 0; $i < count($byd); $i++)
    {
        echo "<tr>";
        for ($j = 0; $j < 7; $j++)
        {
            echo "<td>" . $byd[$i][$j] . "</td>";
        }
        echo "</tr>";
    }

} // end function bydeptPane

