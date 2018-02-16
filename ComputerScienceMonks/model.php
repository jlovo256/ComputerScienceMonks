<?php // model.php

/**
 * model This class interacts with the database that the website will use to
 * display information.  This class is final.
 *
 * model This class has a private constructor so it cannot be instantiated.
 * It contains static strings holding mysqlqueries.  It interacts with createdb to create
 * tables in the database and insert usable data into them.  It is used by the 
 * controller.  All methods are static.
 *
 * @version 2.0
 * @author Jamie Tudor
 */
final class Model
{
    // will hold the connection to the database
    private static $conn;

    /**
     * Summary of $studentQuery
     * This is most of the query for the students pane.  It uses information
     * from the students and people databases.  The ORDER BY will be completed
     * in the accessor method.
     * @var mixed
     */
    private static $studentQuery =
"SELECT students.studentID, people.lastName, people.firstName, people.middleI, people.email, students.major, students.gradDate
FROM students INNER JOIN people
ON students.studentID = people.ID
ORDER BY ";

    /**
     * Summary of $courseQuery
     * This is most of the query for the courses pane.  It uses information
     * from the courses databases.  The ORDER BY will be completed
     * in the accessor method.
     * @var mixed
     */
    private static $courseQuery =
"select * FROM courses
ORDER BY  ";

    /**
     * Summary of $SCbySQuery
     * This is most of the query for the SCbyS pane.  It uses information
     * from the people, classes, and grades databases.  The ORDER BY will be completed
     * in the accessor method
     * @var mixed
     */
    private static $SCbySQuery =
"SELECT people.lastName, people.firstName, classes.deptPrefix,
	classes.courseNumber, classes.schoolYear, classes.semester, grades.letterGrade
FROM people INNER JOIN classes INNER JOIN grades
ON people.ID = grades.studentID AND classes.classSection = grades.classSection
ORDER BY ";

    /**
     * Summary of $SCbyDQuery
     * This is most of the query for the SCbyD pane.  It uses information
     * from the people, classes, and grades databases.  The ORDER BY will be completed
     * in the accessor method
     * @var mixed
     */
    private static $SCbyDQuery =
"SELECT classes.deptPrefix, classes.courseNumber, classes.schoolYear,
	classes.semester, people.lastName, people.firstName, grades.letterGrade
FROM people INNER JOIN classes INNER JOIN grades
ON people.ID = grades.studentID AND classes.classSection = grades.classSection
ORDER BY ";


    /**
     * Summary of __construct
     * The constructor is made private so this class cannot be instantiated.
     */
    private function __construct() {}


    /**
     * Summary of connectDB
     * This public method connects to the database.  It requires a file with
     * login information.  controller.php uses this method.
     */
    public static function connectDB() {
        require_once '/home/ubuntu/.login/login.php';
            // PDO connection
            self::$conn = new PDO($device, $user, $password);
    } // end function connectDB

    /**
     * Summary of createDB
     * This public method calls a private method to create the tables.
     * It is used by controller.php
     */
    public static function createDB() {
        self::createTables();
    } // end function createTables

    /**
     * Summary of checkConn
     * This public method will verify the connection with the database.
     * @return bool
     */
    public static function checkConn () {
        if (self::$conn->query('SELECT 1')) {
            return true;
        }
        else {
            return false;
        }
    } // end function checkConn

    /**
     * Summary of createTables
     * This private mehtod creates all the creates in the database
     * and inserts data into them.  It requires createdb.php
     */
    private static function createTables() {
        require_once 'createdb.php';

        // these functions create the tables by executing heredocs in createdb.php
        self::$conn->exec(createdb::getDeptTable());
        self::$conn->exec(createdb::getCourseTable());
        self::$conn->exec(createdb::getPeopleTable());
        self::$conn->exec(createdb::getMajorsTable());
        self::$conn->exec(createdb::getStudentsTable());
        self::$conn->exec(createdb::getFacultyTable());
        self::$conn->exec(createdb::getClassesTable());
        self::$conn->exec(createdb::getGradesTable());

        // This prepares a mysql statement which is then used to insert data in the departments table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO departments (deptPrefix, deptName) VALUES (? , ?)");
        foreach (createdb::getDepts() as $dept) {
            $stmt->execute($dept);
        }

        // This prepares a mysql statement which is then used to insert data in the courses table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO courses (deptPrefix, courseNumber, courseName, courseDesc)
            VALUES (? , ?, ?, ?)");
        foreach (createdb::getCourses() as $course) {
            $stmt->execute($course);
        }

        // This prepares a mysql statement which is then used to insert data in the people table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO people (ID, firstName, middleI, lastName,
            email, password) VALUES (?, ?, ?, ?, ?, ?)");
        for ($i = 0; $i < count(createdb::getPeople()); $i++) {
            $stmt->execute(array(createdb::getPeople()[$i][0], createdb::getPeople()[$i][1], createdb::getPeople()[$i][2],
                createdb::getPeople()[$i][3], createdb::getPeople()[$i][4], sha1(createdb::getPeople()[$i][5])));
        }

        // This prepares a mysql statement which is then used to insert data in the majors table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO majors (major, deptPrefix) VALUES (? , ?)");
        foreach (createdb::getMajors() as $major) {
            $stmt->execute($major);
        }

        // This prepares a mysql statement which is then used to insert data in the students table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO students (studentID, major, enrollDate, gradDate)
            VALUES (? , ?, ?, ?)");
        foreach (createdb::getStudents() as $student) {
            $stmt->execute($student);
        }

        // This prepares a mysql statement which is then used to insert data in the faculty table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO faculty (facultyID, deptPrefix, hireDate)
            VALUES (?, ?, ?)");
        for ($i = 0; $i < count(createdb::getFaculty()); $i++) {
            $stmt->execute(array(createdb::getFaculty()[$i][0], createdb::getFaculty()[$i][1],
                date(createdb::getFaculty()[$i][2])));
        }

        // This prepares a mysql statement which is then used to insert data in the classes table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO classes (classSection, deptPrefix, courseNumber,
            semester, schoolYear, facultyID) VALUES (?, ?, ?, ?, ?, ?)");
        foreach (createdb::getClasses() as $class) {
            $stmt->execute($class);
        }


        // This prepares a mysql statement which is then used to insert data in the grades table
        // uses arrays from createdb.php
        $stmt = self::$conn->prepare("INSERT INTO grades (classSection, studentID, grade, letterGrade)
            VALUES (?, ?, ?, ?)");
        foreach (createdb::getGrades() as $grade) {
            $stmt->execute($grade);
        }

    } // end function createTables


    /**
     * Summary of getStudentsPane
     * This public method sends a query to the database to get data
     * to fill a table in the students pane.  It uses a string sent
     * from controller.php to order the query.
     * It is used by controller.php
     * @param mixed $orderBy
     * @return array
     */
    public static function getStudentsPane($orderBy) {

        $stmt = self::$conn->query(self::$studentQuery . $orderBy);
        return $stmt->fetchAll();

    } // end function getStudentsPane

    /**
     * Summary of getCoursesPane
     * This public method sends a query to the database to get data
     * to fill a table in the courses pane.  It uses a string sent
     * from controller.php to order the query.
     * It is used by controller.php
     * @param mixed $orderBy
     * @return array
     */
    public static function getCoursesPane($orderBy) {

        $stmt = self::$conn->query(self::$courseQuery . $orderBy);
        return $stmt->fetchAll();

    } // end function getCoursesPanel

    /**
     * Summary of getSCbySPane
     * This public method sends a query to the database to get data
     * to fill a table in the SCbyS pane.  It uses a string sent
     * from controller.php to order the query.
     * It is used by controller.php
     * @param mixed $orderBy
     * @return array
     */
    public static function getSCbySPane($orderBy) {

        $stmt = self::$conn->query(self::$SCbySQuery . $orderBy);
        return $stmt->fetchAll();

    } // end function getSCbySPanel

    /**
     * Summary of getSCbyDPane
     * This public method sends a query to the database to get data
     * to fill a table in the SCbyD pane.  It uses a string sent
     * from controller.php to order the query.
     * It is used by controller.php
     * @param mixed $orderBy
     * @return array
     */
    public static function getSCbyDPane($orderBy) {

        $stmt = self::$conn->query(self::$SCbyDQuery . $orderBy);
        return $stmt->fetchAll();

    } // end function getCoursesPanel
} // end class Model
