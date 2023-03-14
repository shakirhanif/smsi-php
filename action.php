<?php
require "class/School.php";
$sch = new School();
//List classes
if(isset($_POST['action']) && $_POST['action']=='listClasses'){
    $sch->listClasses();
}
//Add classes
if(isset($_POST['action']) && $_POST['action']=='addClasses'){
    $sch->addClasses($_POST['name'],$_POST['section_id'],$_POST['teacher_id']);
}
//update classes
if(isset($_POST['action']) && $_POST['action']=='updateClasses'){
    $sch->updateClasses($_POST['class_id'],$_POST['name'],$_POST['section_id'],$_POST['teacher_id']);
}
//delete classes
if(isset($_POST['action']) && $_POST['action']=='deleteClasses'){
    $sch->deleteClasses($_POST['class_id']);
}
//List Students
if(isset($_POST['action']) && $_POST['action']=='listStudents'){
    $sch->listStudents();
}
//get student for form update
if(isset($_POST['action']) && $_POST['action']=='getStudentForm'){
    $sch->getStudentForm($_POST['student_id']);
}
//add Students
if(isset($_POST['action']) && $_POST['action']=='addStudents'){
    if (!$_FILES['photo']['name']=='') {
        $img=date('his').$_FILES['photo']['name'];
        $dir="upload/" . basename($img);
        move_uploaded_file($_FILES['photo']['tmp_name'],$dir);
    }else{
        $img='';
    }

    $sch->addStudents($_POST['regno'],$_POST['rollno'],$_POST['acayear'],$_POST['addate'],$_POST['class'],$_POST['section'],$_POST['name'],$img,$_POST['gender'],$_POST['email'],$_POST['mobile'],$_POST['address'],$_POST['fathername'],$_POST['mothername']);
}
//update student
if(isset($_POST['action']) && $_POST['action']=='updateStudent'){
    if (!$_FILES['photo']['name']=='') {
        $img=date('his').$_FILES['photo']['name'];
        $dir="upload/" . basename($img);
        move_uploaded_file($_FILES['photo']['tmp_name'],$dir);
    }else{
        $img='';
    }
    $sch->updateStudent($_POST['regno'],$_POST['rollno'],$_POST['acayear'],$_POST['addate'],$_POST['class'],$_POST['section'],$_POST['name'],$img,$_POST['gender'],$_POST['email'],$_POST['mobile'],$_POST['address'],$_POST['fathername'],$_POST['mothername'],$_POST['id']);
}
//delete student
if(isset($_POST['action']) && $_POST['action']=='deleteStudent'){
    $photo = $sch->getStudentPhoto($_POST['id']);
    unlink("upload/$photo");
    $sch->deleteStudent($_POST['id']);
}
//List StudentsForm
if(isset($_POST['action']) && $_POST['action']=='listStudentsForm'){
    $classId="";
    $secId="";
    if (isset($_POST['classId'])) {
        $classId=$_POST['classId'];
    }
    if (isset($_POST['secId'])) {
        $secId=$_POST['secId'];
    }
    $sch->listStudentsForm($classId,$secId);
}
//List Sections
if(isset($_POST['action']) && $_POST['action']=='listSections'){
    $sch->listSections();
}
//Add Sections
if(isset($_POST['action']) && $_POST['action']=='addSections'){
    // echo $_POST['name'];
    $sch->addSections($_POST['name']);
}
//update Section
if(isset($_POST['action']) && $_POST['action']=='updateSections'){
    $sch->updateSections($_POST['name'],$_POST['id']);
}
//delete sections
if(isset($_POST['action']) && $_POST['action']=='deleteSections'){
    $sch->deleteSections($_POST['id']);
}
//List Teachers
if(isset($_POST['action']) && $_POST['action']=='listTeachers'){
    $sch->listTeachers();
}
//Add Teachers
if(isset($_POST['action']) && $_POST['action']=='addTeachers'){
    // echo $_POST['name'];
    $sch->addTeachers($_POST['name'],$_POST['subject'],$_POST['class'],$_POST['section']);
}
//update Teachers
if(isset($_POST['action']) && $_POST['action']=='updateTeachers'){
    $sch->updateTeachers($_POST['name'],$_POST['subject'],$_POST['id']);
}
//delete Teachers
if(isset($_POST['action']) && $_POST['action']=='deleteTeachers'){
    $sch->deleteTeachers($_POST['id']);
}
//List Subjects
if(isset($_POST['action']) && $_POST['action']=='listSubjects'){
    $sch->listSubjects();
}
//Add Subjects
if(isset($_POST['action']) && $_POST['action']=='addSubjects'){
    // echo $_POST['name'];
    $sch->addSubjects($_POST['subject'],$_POST['type'],$_POST['code']);
}
//update subjects
if(isset($_POST['action']) && $_POST['action']=='updateSubjects'){
    $sch->updateSubjects($_POST['subject'],$_POST['type'],$_POST['code'],$_POST['id']);
}
//delete Subjects
if(isset($_POST['action']) && $_POST['action']=='deleteSubjects'){
    $sch->deleteSubjects($_POST['id']);
}
//search attendance
if(isset($_POST['action']) && $_POST['action']=='searchAttendance'){
    $sch->searchAttendance($_POST['class'],$_POST['section']);
}
//add attendance
if(isset($_POST['action']) && $_POST['action']=='addAttendance'){
    $myList=json_decode($_POST['attList'],true);
    $sch->addAttendance($myList);
}
//search attendance report
if(isset($_POST['action']) && $_POST['action']=='searchAttendanceReport'){
    $sch->searchAttendanceReport($_POST);
}
?>