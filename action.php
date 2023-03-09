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
//List Sections
if(isset($_POST['action']) && $_POST['action']=='listSections'){
    $sch->listSections();
}
//List Teachers
if(isset($_POST['action']) && $_POST['action']=='listTeachers'){
    $sch->listTeachers();
}

?>