<?php // controller.php

/**
 * controller The controller is the middle man between the model and the view
 *
 * controller controller.php is called in the view, which is called in index.php.
 * The controller contains mysql for ordering the tables
 * It interacts with model.php and view.php
 *
 * @version 2.0
 * @author Jamie Tudor
 */

class Controller
{
    /**
     * Summary of $studentsFormNames
     * The associative array of arrays holds the id of the POST
     * variable, mysql string, and value for the columns of the
     * students table in the students pane
     * @var mixed
     */
    private static $studentsFormNames = array(
        "Tab1studentID" => array("students.studentID", "Student ID"),
        "Tab1lastNam" => array("people.lastName", "Last Name"),
        "Tab1firstNam" => array("people.firstName", "First Name"),
        "Tab1MI" => array("people.middleI", "MI"),
        "Tab1email" => array("people.email", "Email"),
        "Tab1major" => array("students.major", "Major"),
        "Tab1expGrad" => array("students.gradDate", "Grad. Date"));


    /**
     * Summary of $coursesFormNames
     * The associative array of arrays holds the id of the POST
     * variable, mysql string, and value for the columns of the
     * courses table in the courses pane
     * @var mixed
     */
    private static $coursesFormNames = array(
        "Tab2dept" => array("courses.deptPrefix", "Dept."),
        "Tab2course" => array("courses.courseNumber", "Course"),
        "Tab2courseName" => array("courses.courseName", "Course Name"),
        "Tab2description" => array ("courses.courseDesc", "Description"));

        // this associative array holds variable names for the table header
    /**
     * Summary of $scbysFormNames
     * Summary of $coursesFormNames
     * The associative array of arrays holds the id of the POST
     * variable, mysql string, and value for the columns of the
     * student/course by student table in the SCbyS pane
     * @var mixed
     */
    private static $scbysFormNames = array(
        "Tab3lastNam" => array("people.lastName", "Last Name"),
        "Tab1firstNam" => array("people.firstName", "First Name"),
        "Tab1MI" => array ("classes.deptPrefix", "Dept."),
        "Tab1email" => array("classes.courseNumber", "Course"),
        "Tab1major" => array("classes.schoolYear", "Year"),
        "Tab1expGrad" => array("classes.semester", "Semester"),
        "Tab3grade" => array("grades.letterGrade", "Grade"));

        // this associative array holds variable names for the table header
    /**
     * Summary of $scbydFormNames
     * Summary of $scbysFormNames
     * Summary of $coursesFormNames
     * The associative array of arrays holds the id of the POST
     * variable, mysql string, and value for the columns of the
     * student/course by deptmartment table in the SCbyD pane
     * @var mixed
     */
    private static $scbydFormNames = array(
        "Tab1MI" => array ("classes.deptPrefix", "Dept."),
        "Tab1email" => array("classes.courseNumber", "Course"),
        "Tab1major" => array("classes.schoolYear", "Year"),
        "Tab1expGrad" => array("classes.semester", "Semester"),
        "Tab3lastNam" => array("people.lastName", "Last Name"),
        "Tab1firstNam" => array("people.firstName", "First Name"),
        "Tab3grade" => array("grades.letterGrade", "Grade"));

    /**
     * Summary of __construct
     * private constructor so class cannnot be instaniate
     */
    private function __construct() {}

    /**
     * Summary of connect
     * This public method connects to the database through model.
     * It is called by view
     */
    public static function connect() {

        require_once 'model.php';

        // Connect to the database through controller.php
        try{
            Model::connectDB();
        }
        catch (Exception $e) {
            echo "Failed to connect: " .  $e;
        }
    } // end method connect

    /**
     * Summary of createDB
     * This public method creates tables in the database by
     * calling a method in model that actually does all the
     * work.  this method is called by view
     */
    public static function createDB() {
        // create the tables for the database through controller.php
        try {
            Model::createDB();
        }
        catch (Exception $e) {
            echo "Failed to create tables" . $e;
        }
    } // end method createDB

    /**
        * Summary of checkCon
        * This function checks the connection to the database by calling a method from
        * model.php
        * It is called by view.php and then used by index.php
    */
    public static function checkCon() {

        if (Model::checkConn()) {
            echo "<p>You are connected to a higher database.</p>";
        }
        else {
            echo "<p>You lack faith my child.</p>";
        }

    } // end method checkConn

    /**
     * Summary of tabHead
     * This public method adds a " DESC" to the orderBy string if it
     * is the second time the column header has been clicked.  It is called
     * by the view
     * @param mixed $order
     * @param mixed $bool
     * @return mixed
     */
    public static function tabHead($order, $bool) {
        if ($bool) {
            return $order;
        }
        else {
            return $order . " DESC";
        }
    } // end method tabHead


    /**
     * Summary of getStudentsPane
     * This public method contains the default order for the
     * students table.  It sends information about the table
     * headers and functionality to the tableHeader function
     * in the view.  It calls the model to get the students
     * table data from the mysql database.
     * @return array
     */
    public static function getStudentsPane() {

        // creates a variable to send to the controller and then the model
        static $orderBy;
        // this is the default order for the mysql query
        $orderBy = "people.lastName";

        // Generate the table header and get the user's selected order
        $orderBy = tableHeader(self::$studentsFormNames, $orderBy);

        return Model::getStudentsPane($orderBy);
    } // end method getStudentsPane

    /**
     * Summary of getCoursesPane
     * This public method contains the default order for the
     * courses table.  It sends information about the table
     * headers and functionality to the tableHeader function
     * in the view.  It calls the model to get the courses
     * table data from the mysql database.
     * @return array
     */
    public static function getCoursesPane() {
        // creates a variable to send to the controller, and will then go to the model
        static $orderBy;
        // this is the default order for the mysql query
        $orderBy = "courses.deptPrefix, courses.courseNumber";

        // Generate the table header and get the user's selected order
        $orderBy = tableHeader(self::$coursesFormNames, $orderBy);

        return Model::getCoursesPane($orderBy);
    } // end method getCoursesPane

    /**
     * Summary of getSCbySPane
     * This public method contains the default order for the
     * SCbyS table.  It sends information about the table
     * headers and functionality to the tableHeader function
     * in the view.  It calls the model to get the SCbyS
     * table data from the mysql database.
     * @return array
     */
    public static function getSCbySPane() {

        // creates a variable to send to the controller, and then to the model
        static $orderBy;
        // this is the default order for the mysql query
        $orderBy = "people.lastName";

        // Generate the table header and get the user's selected order
        $orderBy = tableHeader(self::$scbysFormNames, $orderBy);

        return Model::getSCbySPane($orderBy);

    } // end method getSCbySPane

    /**
     * Summary of getSCbyDPane
     * This public method contains the default order for the
     * SCbyD table.  It sends information about the table
     * headers and functionality to the tableHeader function
     * in the view.  It calls the model to get the SCbyD
     * table data from the mysql database.
     * @return array
     */
    public static function getSCbyDPane() {

        // creates a variable to send to the controller and then to the model
        static $orderBy;
        // this is the default order for the mysql query
        $orderBy = "classes.deptPrefix, classes.courseNumber";

        // Generate the table header and get the user's selected order
        $orderBy = tableHeader(self::$scbydFormNames, $orderBy);

        return Model::getSCbyDPane($orderBy);
    } // end method getSCbyDPane

} // end class Controller