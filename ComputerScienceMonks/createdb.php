<?php // createdb.php
namespace csmonks;

/**
 * createdb This class creates tables on an already created data
 * and fills them with data.  This class is final so its methods cannot
 * be altered by an inhertited class.
 *
 * createdb This class creates the tables departments, courses, people,
 * majors, students, faculty, classes, and grades.  They must be load in the order
 * that they are listed.  Otherwise their will be errors.  This database is intended to
 * create the information that will last be displayed on a webpage.  The class does
 * not interact directly with the website, only a mysql database.
 *
 * @version 2.0
 * @author Jamie Tudor
 */

final class createdb
{
    private $conn;  // This is the variable for the connection to the database

    /**
     * Summary of $deptTable
     * This variable will hold the mysql statement to create the department
     * table.  The table will hold the department prefix and the department
     * name.  The primary key is deptPrefix.
     * @var mixed
     */
    private static $deptTable = <<<MYSQL
CREATE TABLE departments(
    deptPrefix VARCHAR(5) NOT NULL,
    deptName VARCHAR(40) NOT NULL,
    PRIMARY KEY (deptPrefix)
 ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of $coursesTable
     * The variable will hold a static mysql string which will create a
     * course table.  The course table will list the deptPrefix, course number, course name,
     * and course description for each course.  The private key will be the deptPrefix and courseNumber.
     * A foreign key will connect deptPrefix to departments.
     * @var mixed
     */
    private static $coursesTable = <<<MYSQL
CREATE TABLE courses(
    deptPrefix VARCHAR(5) NOT NULL,
    courseNumber SMALLINT(4) UNSIGNED NOT NULL,
    courseName VARCHAR(80) NOT NULL,
    courseDesc VARCHAR(255) NOT NULL,
    PRIMARY KEY (deptPrefix, courseNumber),
    FOREIGN KEY (deptPrefix) REFERENCES departments(deptPrefix) ON DELETE CASCADE
 ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of $peopleTable
     * This static variable will hold the mysql statement to create a people table.
     * The people table is intended to hold information that would be common to both
     * students and faculty.  This table holds first name, middle initial, last name,
     * email, password, and ID.  The primary key is ID.
     * The intent was to create a relationship where student and faculty inherit from
     * people.  However, it does not work quite the way as intended.  As a result, faculty is
     * not currently used.
     *
     * @var mixed
     */
    private static $peopleTable = <<<MYSQL
CREATE TABLE people(
    ID VARCHAR(12) NOT NULL,
    firstName VARCHAR(40) NOT NULL,
    middleI char(1),
    lastName VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    password CHAR(40) NOT NULL,
    PRIMARY KEY (ID),
    UNIQUE (email)
  ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of $majorsTable
     * This static variable holds the information to create a majors tables.
     * The majors table holds possible majors for students.  The primary key
     * is the major itself.  The deptPrefix is the foreign key, so the majors
     * are associated with departments.
     * @var mixed
     */
    private static $majorsTable = <<<MYSQL
CREATE TABLE majors(
    major VARCHAR(40) NOT NULL,
    deptPrefix VARCHAR(5) NOT NULL,
    PRIMARY KEY (major),
    FOREIGN KEY (deptPrefix) REFERENCES departments(deptPrefix) ON DELETE CASCADE
  ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of studentsTable
     * This static variable holds the mysql statement to create a student table.
     * The student table has a foreign key (ID) with the people table.  The people table
     * holds general generic information like last name.  The student table holds information
     * that would be unique to students like major and graduation date.  studentID is the
     * student's ID.  major is the student's major.  enrollDate is the student's date of enrollment.
     * gradDate is the student's expected graduation data.
     * The graduation date could be made to be calculated from enrollDate.
     * @var mixed
     */
    private static $studentsTable = <<<MYSQL
CREATE TABLE students (
    studentID VARCHAR(12) NOT NULL,
    major VARCHAR(40),
    enrollDate DATE NOT NULL,
    gradDate DATE NOT NULL,
    PRIMARY KEY(studentID),
    FOREIGN KEY (studentID) REFERENCES people (ID) ON DELETE CASCADE,
    FOREIGN KEY (major) REFERENCES majors (major)
  ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of $facultyTable
     * This static heredoc holds information about faculty.  Faculty was intended
     * to have an inheritance relation with people.  People holds general information
     * that would be common the students and faculty, like last names.  They are connected
     * by the facultyID and ID from the people table.  The faculty table holds fields
     * unique to faculty, like hireDate.  deptPrefix holds the department that the faculty
     * member is associated with.  hireDate holds the hire date of the faculty member.
     * The primary key is facultyID.
     * @var mixed
     */
    private static $facultyTable = <<<MYSQL
CREATE TABLE faculty(
    facultyID VARCHAR(12) NOT NULL,
    deptPrefix VARCHAR(5) NOT NULL,
    hireDate DATE NOT NULL,
    PRIMARY KEY(facultyID),
    FOREIGN KEY (deptPrefix) REFERENCES departments(deptPrefix) ON DELETE CASCADE,
    FOREIGN KEY (facultyID) REFERENCES people(ID) ON DELETE CASCADE
  ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of $classesTable
     * This table stores classes, which are instances of courses, in this project
     * A class is linked to courses through courseNumber, there are many classes for one course
     * Classes also have semesters, years, and faculty.
     * The primary key is the classSection and schoolYear.
     * @var mixed
    */
    private static $classesTable = <<<MYSQL
CREATE TABLE classes(
    classSection MEDIUMINT(5) UNSIGNED NOT NULL,
    deptPrefix VARCHAR(5) NOT NULL,
    courseNumber SMALLINT(4) UNSIGNED NOT NULL,
    semester VARCHAR(6) NOT NULL,
    schoolYear YEAR(4) NOT NULL,
    facultyID VARCHAR(12),
    PRIMARY KEY (classSection, schoolYear),
    FOREIGN KEY (deptPrefix, courseNumber) REFERENCES courses(deptPrefix, courseNumber) ON DELETE CASCADE,
    FOREIGN KEY (deptPrefix) REFERENCES departments(deptPrefix) ON DELETE CASCADE,
    FOREIGN KEY (facultyID) REFERENCES faculty(facultyID)
  ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of $gradesTable
     * The grades table holds final grades for students in classes.  classSection holds the
     * classSection that the grade was recorded for.  studentID holds the ID of the student
     * that the grade belongs to.  grade holds a decimal grade.  letterGrade holds a letter
     * representation of the grade.
     * The primary key is the classSection and the studentID
     * @var mixed
     */
    private static $gradesTable = <<<MYSQL
CREATE TABLE grades(
    classSection MEDIUMINT(5) UNSIGNED NOT NULL,
    studentID VARCHAR(12) NOT NULL,
    grade DECIMAL(3,2) UNSIGNED NOT NULL,
    letterGrade char(1) NOT NULL,
    PRIMARY KEY (classSection, studentID),
    FOREIGN KEY (classSection) REFERENCES classes (classSection) ON DELETE CASCADE,
    FOREIGN KEY (studentID) REFERENCES students (studentID) ON DELETE CASCADE
  ) ENGINE InnoDB;
MYSQL;

    /**
     * Summary of $dept
     * This array holds arrays listing deptments prefixes and department names.
     * This information will be inserted into the department table.
     * @var mixed
     */
    private static $depts = array(
        array('CS', 'Computer Science'),
        array('CPE', 'Computer Engineering'),
        array('MATH', 'Mathematics'),
        array('BME', 'Biomedical Engineering'),
        array('ECE', 'Electrical and Computer Engineering'),
        array('CE', 'Civil and Environmental Engineering'),
        array('CHE', 'Chemical Engineering')
      );

    /**
     * Summary of $courses
     * This array of arrays contains information which will be inserted
     * into the courses table.
     * @var mixed
     */
    private static $courses = array(
        array('CS', '1110', 'Introduction to Programming', 'bools, strings, and things'),
        array('CS', '2102', 'Discrete Mathematics', 'If the sky is purple, then voltron is ready'),
        array('CS', '2110', 'Software Development Methods', 'It is only an object, it does not mean what you think.'),
        array('CS', '2150', 'Program and Data Representation', 'Trees and maps'),
        array('CS', '3102', 'Theory in Computation', 'You complete me.'),
        array('ECE', '2330', 'Digital Logic Design', 'Ohms law probably.'),
        array('ECE', '2630', 'ECE Fundamentals I', 'Electricity and stuff.'),
        array('ECE', '3103', 'Solid State Device', 'I have no idea what this means, but it sounds fast.'),
        array('MATH', '1310', 'Calculus I', 'The real limit that you are finding is your own.'),
        array('MATH', '1320', 'Calculus II', 'Oh crap math is hard.'),
        array('MATH', '2310', 'Calculus III', 'Shapes and pretty colors.  Math is beautiful.'),
        array('MATH', '3250', 'Differential Equations', 'So beautiful.'),
        array('BME', '2101', 'Physiology I for Engineers', 'Eugenics I assume'),
        array('BME', '2315', 'Computational Biomedical Engineering', 'ten bucks says this just intro to programming'),
        array('BME', '3080', 'Biomedical Engineering Integrated Design and Experimental Analysis', 'Where they create what should have never been'),
        array('CPE', '6890', 'Industrial Applications', 'Building the machine.'),
        array('CPE', '7993', 'Independent Study', 'Gordan Clark wants to build a computer.'),
        array('CPE', '7995', 'Supervised Project Research', 'Someone needs to make sure Cameron builds the bios.'),
        array('CHE', '2215', 'Material and Engery Balances', 'Where they learn to be mad scientists'),
        array('CHE', '3316', 'Chemical Thermodynamics and Staged Unit Operations', 'Hopefully learning to make better CPUs.'),
        array('CHE', '4448', 'Bioseparations Engineering', 'Probably where they team up with biomedical engineers to make unholy abominations.'),
        array('CE', '2010', 'Civil Engineering Techniques', 'autocad use and email avoidance'),
        array('CE', '2300', 'Statics', 'First semester physics.'),
        array('CE', '3100', 'Water for the World', 'nice thought')
      );

    /**
     * Summary of $people
     * This array of arrays contains information to be inserted into the people table.
     * @var mixed
     */
    private static $people = array(
        array('5463-56-8742', 'Cadfael', 'M', 'ap Dafydd', 'cd234@virginia.edu', 'fsefgre'),
        array('8531-29-4662','Stephen', 'R', 'Bois', 'sb345@virginia.edu', 'greeras34'),
        array('5268-67-5831', 'Maude', 'E', 'Normandy', 'mn8438@virginia.edu', 'sdfrertyj'),
        array('9734-64-2574', 'Richildis', 'A', 'Bonel', 'rb6294@virginia.edu', 'sefdhtr'),
        array('3567-84-3586', 'Olivier', 'D', 'Bretagne', 'ob1037@virginia.edu' , 'wefrer'),
        array('2478-25-9734', 'Hugh', 'I', 'Beringar', 'hb673@virginia.edu', 'erferger'),
        array('3586-43-6981', 'Abbot', 'W', 'Heribert', 'ah9275@virginia.edu', 'erfref'),
        array('1368-24-8742', 'Abbot', 'K', 'Radulfus', 'ar3195@virginia.edu', 'erferfw'),
        array('1457-34-6632', 'Sister', 'E', 'Magdalen', 'sm1946@virginia.edu', 'wefwqf'),
        array('2356-37-8612', 'Brother', 'Q', 'Oswin', 'b03518@virginia.edu', 'uytjfyh'),
        array('3552-35-8741', 'Brother', 'M', 'Jerome', 'bj9470@virginia.edu', 'trhgsed'),
        array('2557-24-7631', 'Prior', 'S', 'Robert', 'pr1430@virginia.edu', 'rgwrtstwaf'),
        array('1245-45-1345', 'Taran', 'C', 'Wanderer', 'tw7630@virginia.edu', 'erfweewr'),
        array('3432-35-7862', 'Eilonwy', 'R', 'Llyr', 'el9716@virginia.edu', 'eqfeaef'),
        array('1234-39-8731', 'Fflewddur', 'F', 'Fflam', 'ff5294@virginia.edu', 'erfwerwq'),
        array('2674-13-5588', 'Dallben', 'C', 'Swynwr', 'ds1385@virginia.edu', 'refregres'),
        array('4696-94-3561', 'Gurgi', 'E', 'Creadur', 'gc14935@virginia.edu', 'ergesa'),
        array('2378-33-9861', 'Gwydion', 'S', 'Don', 'gd2355@virginia.edu', 'regweqwe'),
        array('8717-11-6872', 'Arawn', 'H', 'Death-Lord', 'ad4635@virginia.edu', 'rgwrefre'),
        array('2359-83-4558', 'Math', 'A', 'Mathonwy', 'mm5261@virginia.edu', 'rgrefreg')
      );

    /**
     * Summary of $majors
     * This array of arrays contains information to be inserted into the majors table.
     * @var mixed
     */
    private static $majors = array(
        array('Computer Science', 'CS'),
        array('Computer Engineering', 'CPE'),
        array('Mathematics', 'MATH'),
        array('Biomedical Engineering','BME'),
        array('Electrical Engineering', 'ECE'),
        array('Civil Engineering', 'CE'),
        array('Environmental Engineering', 'CE'),
        array('Chemical Engineering', 'CHE'),
      );

    /**
     * Summary of $students
     * This array of arrays contains information to be inserted into the students table.
     * @var mixed
     */
    private static $students = array(
        array('8531-29-4662', 'Civil Engineering','2012-08-20', '2016-05-10'),
        array('9734-64-2574', 'Biomedical Engineering', '2012-08-20', '2016-05-10'),
        array('3567-84-3586', 'Chemical Engineering', '2012-08-20', '2016-05-10'),
        array('2478-25-9734', 'Computer Science', '2012-08-20', '2016-05-10'),
        array('2356-37-8612', 'Mathematics', '2012-08-20', '2016-05-10'),
        array('3552-35-8741', 'Electrical Engineering', '2012-08-20', '2016-05-10'),
        array('1245-45-1345', 'Environmental Engineering', '2012-08-20', '2016-05-10'),
        array('3432-35-7862', 'Computer Engineering', '2012-08-20', '2016-05-10'),
        array('1234-39-8731', 'Computer Science', '2012-08-20', '2016-05-10'),
        array('2674-13-5588', 'Mathematics', '2012-08-20', '2016-05-10'),
        array('4696-94-3561', 'Computer Engineering', '2012-08-20', '2016-05-10')
      );

    /**
     * Summary of $faculty
     * This array of arrays contains information to be inserted into the faculty table.
     * @var mixed
     */
    private static $faculty = array(
        array('5463-56-8742', 'CHE', 'Y\-m\-d'),
        array('1457-34-6632', 'CS', 'Y\-m\-d'),
        array('2378-33-9861', 'CPE', 'Y\-m\-d'),
        array('2557-24-7631', 'ECE', 'Y\-m\-d'),
        array('8717-11-6872', 'MATH', 'Y\-m\-d'),
        array('5268-67-5831', 'CE', 'Y\-m\-d'),
        array('2359-83-4558', 'CS', 'Y\-m\-d'),
        array('1368-24-8742', 'MATH', 'Y\-m\-d'),
        array('3586-43-6981', 'BME', 'Y\-m\-d')
      );

    /**
     * Summary of $classes
     * This array of arrays contains information to be inserted into the classes table.
     * @var mixed
     */
    private static $classes = array(
        array('35651','CS','1110','Fall','2016','1457-34-6632'),
        array('86433','CS','2102','Fall','2015','2359-83-4558'),
        array('12464','CS','2110','Spring','2016','1457-34-6632'),
        array('35742','CPE','6890','Fall','2015','2378-33-9861'),
        array('35574','CPE','7993','Fall','2016','2378-33-9861'),
        array('34686','CPE','7995','Summer','2014','2378-33-9861'),
        array('32385','BME','2101','Fall','2016','3586-43-6981'),
        array('35724','BME','2315','Spring','2012','3586-43-6981'),
        array('13780','BME','3080','Spring','2012','3586-43-6981'),
        array('23574','CHE','2215','Spring','2015','5463-56-8742'),
        array('24673','CHE','3316','Fall','2016','5463-56-8742'),
        array('13563','CHE','4448','Spring','2016','5463-56-8742'),
        array('24575','MATH','1310','Fall','2014','8717-11-6872'),
        array('35753','MATH','1320','Fall','2016','1368-24-8742'),
        array('36753','MATH','2310','Spring','2016','1368-24-8742'),
        array('52074','CE','2010','Fall','2016','5268-67-5831'),
        array('35764','CE','2300','Summer','2015','5268-67-5831'),
        array('83562','CE','3100','Fall','2016','5268-67-5831'),
        array('35864','ECE','2330','Spring','2016','2557-24-7631'),
        array('37975','ECE','2630','Fall','2015','2557-24-7631'),
        array('37964','ECE','3103','Fall','2016','2557-24-7631'),
      );

    /**
     * Summary of $grades
     * This array of arrays contains information to be inserted into
     * the grades table.
     * @var mixed
     */
    private static $grades = array(
        array('35651', '8531-29-4662', '3.00', 'B'),
        array('35651', '9734-64-2574', '2.00', 'C'),
        array('35651', '3567-84-3586', '4.00', 'A'),
        array('35651', '1245-45-1345', '3.00', 'B'),
        array('86433', '2478-25-9734', '3.00', 'B'),
        array('86433', '2674-13-5588', '4.00', 'A'),
        array('86433', '4696-94-3561', '3.00', 'B'),
        array('12464', '2478-25-9734', '4.00', 'A'),
        array('12464', '3432-35-7862', '3.00', 'B'),
        array('12464', '1234-39-8731', '2.00', 'C'),
        array('35742', '2478-25-9734', '3.00', 'B'),
        array('35742', '2478-25-9734', '2.00', 'C'),
        array('35742', '3552-35-8741', '1.00', 'D'),
        array('35742', '1234-39-8731', '2.00', 'C'),
        array('35742', '2674-13-5588', '3.00', 'B'),
        array('35742', '9734-64-2574', '4.00', 'A'),
        array('35574', '3432-35-7862', '4.00', 'A'),
        array('34686', '4696-94-3561', '3.00', 'B'),
        array('32385', '4696-94-3561', '3.00', 'B'),
        array('32385', '9734-64-2574', '4.00', 'A'),
        array('35724', '9734-64-2574', '3.00', 'B'),
        array('13780', '9734-64-2574', '3.00', 'B'),
        array('23574', '9734-64-2574', '2.00', 'C'),
        array('23574', '3567-84-3586', '3.00', 'B'),
        array('24673', '3567-84-3586', '4.00', 'A'),
        array('24673', '1245-45-1345', '3.00', 'B'),
        array('13563', '3567-84-3586', '3.00', 'B'),
        array('24575', '8531-29-4662', '2.00', 'C'),
        array('24575', '9734-64-2574', '2.00', 'C'),
        array('24575', '4696-94-3561', '1.00', 'D'),
        array('24575', '1245-45-1345', '2.00', 'C'),
        array('24575', '2478-25-9734', '3.00', 'B'),
        array('35753', '3567-84-3586', '3.00', 'B'),
        array('35753', '2356-37-8612', '2.00', 'C'),
        array('35753', '3552-35-8741', '3.00', 'B'),
        array('35753', '3432-35-7862', '4.00', 'A'),
        array('36753', '1234-39-8731', '4.00', 'A'),
        array('36753', '1234-39-8731', '4.00', 'A'),
        array('52074', '8531-29-4662', '2.00', 'C'),
        array('52074', '1245-45-1345', '3.00', 'B'),
        array('35764', '8531-29-4662', '3.00', 'B'),
        array('35764', '1245-45-1345', '1.00', 'D'),
        array('83562', '8531-29-4662', '0.00', 'F'),
        array('83562', '1245-45-1345', '3.00', 'B'),
        array('35864', '2478-25-9734', '2.00', 'C'),
        array('35864', '3552-35-8741', '3.00', 'B'),
        array('35864', '3432-35-7862', '2.00', 'C'),
        array('35864', '1234-39-8731', '4.00', 'A'),
        array('35864', '4696-94-3561', '4.00', 'A'),
        array('37975', '3552-35-8741', '3.00', 'B'),
        array('37975', '3432-35-7862', '2.00', 'C'),
        array('37975', '1234-39-8731', '1.00', 'D'),
        array('37964', '3552-35-8741', '4.00', 'A'),
        array('37964', '4696-94-3561', '3.00', 'B')
      );

    /**
     * Summary of getDeptTable
     * This public method returns the private heredoc which will create the
     * department table.  Used by the model.
     * @return mixed
     */
    public static function getDeptTable() {
        return self::$deptTable;
    } // end method getDeptTable

    /**
     * Summary of getCourseTable
     * This public method returns the private heredoc which will create the
     * course table.  Used by the model.
     * @return mixed
     */
    public static function getCourseTable() {
        return self::$coursesTable;
    } // end method getCourseTable

    /**
     * Summary of getPeopleTable
     * This public method returns the private heredoc which will create the
     * people table.  Used by the model.
     * @return mixed
     */
    public static function getPeopleTable() {
        return self::$peopleTable;
    } // end method getPeopleTable

    /**
     * Summary of getMajorsTable
     * This public method returns the private heredc which will create the
     * majors table.  Used by the model.
     * @return mixed
     */
    public static function getMajorsTable() {
        return self::$majorsTable;
    } // end method getMajorsTable

    /**
     * Summary of getStudentTable
     * This public method returns the private heredoc which will create the
     * students table.  Used by the model.
     * @return mixed
     */
    public static function getStudentsTable() {
        return self::$studentsTable;
    } // end method getStudentsTable

    /**
     * Summary of getFacultyTable
     * This public method returns the private heredoc which will create the
     * faculty table.  Used by the model.
     * @return mixed
     */
    public static function getFacultyTable() {
        return self::$facultyTable;
    } // end method getFacultyTable

    /**
     * Summary of getClassesTable
     * This public method returns the private heredoc which will create the
     * classes table.  Used by the model.
     * @return mixed
     */
    public static function getClassesTable() {
        return self::$classesTable;
    } // end method getClassesTable

    /**
     * Summary of getGradesTable
     * This public method returns the private heredoc which will create the
     * grades table.  Used by the model.
     * @return mixed
     */
    public static function getGradesTable() {
        return self::$gradesTable;
    } // end method getGradesTable

    /**
     * Summary of getDepts
     * This public method returns the private string which will insert data
     * into the departments table.  Used by the model.
     * @return mixed
     */
    public static function getDepts() {
        return self::$depts;
    } // end method getDepts

    /**
     * Summary of getCourses
     * This public method returns the private string which will insert data
     * into the courses table.  Used by the model.
     * @return mixed
     */
    public static function getCourses() {
        return self::$courses;
    } // end method getCourses

    /**
     * Summary of getPeople
     * This public method returns the private string which will insert data
     * into the people table.  Used by the model.
     * @return mixed
     */
    public static function getPeople() {
        return self::$people;
    } // end method getPeople

    /**
     * Summary of getMajors
     * This public method returns the private string which will insert data
     * into the majors table.  Used by the model.
     * @return mixed
     */
    public static function getMajors() {
        return self::$majors;
    } // end method getMajors

    /**
     * Summary of getStudents
     * This public method returns the private string which will insert data
     * into the students table.  Used by the model.
     * Summary of getStudents
     * @return mixed
     */
    public static function getStudents() {
        return self::$students;
    } // end method getStudents

    /**
     * Summary of getFaculty
     * This public method returns the private string which will insert data
     * into the faculty table.  Used by the model.
     * @return mixed
     */
    public static function getFaculty() {
        return self::$faculty;
    } // end method getFaculty

    /**
     * Summary of getClasses
     * This public function returns the private string which will insert data
     * into the classes table.  Used by the model.
     * @return mixed
     */
    public static function getClasses() {
        return self::$classes;
    } // end method getClasses

    /**
     * Summary of getGrades
     * This public method returns the private string which will insert data
     * into the grades table.  Used by the model.
     * @return mixed
     */
    public static function getGrades() {
        return self::$grades;
    } // end method getGrades
} // end class createdb
