<?php
    session_start();
    require "config.php";
    class School extends Config{
        private $Conn=false;
        public function __construct(){
            if (!$this->Conn) {
                $this->dbConfig();
                try {
                    $this->Conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;",$this->user,$this->pass);
                    $this->Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (\PDOException $th) {
                    echo $th->getMessage();
                }
            }
        }


        public function adminLoginstatus(){
            if (!isset($_SESSION['email'])) {
                header("location: login.php");
            }
        }

        public function isLoggedIn(){
            if (isset($_SESSION['email'])) {
                return true;
            }else{
                return false;
            }
        }

        public function adminLogin(){
            if (isset($_POST['submit'])) {
                if ($_POST['email']=='' OR $_POST['password']=='') {
                  echo 'no field should be empty';
                }else{
                  $email=$_POST['email'];
                  $pass=$_POST['password'];
                  $login = $this->Conn->prepare("select * from users where email='$email'");
                  $login->execute();
                  $row = $login->FETCH(PDO::FETCH_ASSOC);
                  if ($login->rowCount()>0) {
                      if (password_verify($pass,$row['password'])) {
                      $_SESSION['email']=$row['email'];
                      $_SESSION['first_name'] = $row['first_name']; 
                      $_SESSION['last_name'] = $row['last_name']; 
                      header("location: index.php");
                    } 
                  }
                }
              }
        }
//List classes
        public function listClasses(){
            $conn=$this->Conn;
            $query=$conn->prepare("select classes.id as id,classes.name as name,sections.section as section,teachers.teacher as teacher from classes left join sections on classes.section=sections.section_id left join teachers on classes.teacher_id=teachers.teacher_id");
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
//add classes
        public function addClasses($name,$sectionId,$teacherId){
            $conn=$this->Conn;
            $query=$conn->prepare("insert into classes (name,section,teacher_id) values(:name,:section,:teacher_id)");
            $query->execute([
                ':name'=>$name,
                ':section'=>$sectionId,
                ':teacher_id'=>$teacherId,
            ]);
            $id=$conn->lastInsertId();
            echo $id;
        }
//update classes
        public function updateClasses($id,$name,$sectionId,$teacherId){
            $conn=$this->Conn;
            $query=$conn->prepare("update classes set name=:name,section=:section,teacher_id=:teacher_id where id=:id");
            $query->execute([
                ':name'=>$name,
                ':section'=>$sectionId,
                ':teacher_id'=>$teacherId,
                ':id'=>$id,
            ]);
            echo "success";
        }
//delete classes
        public function deleteClasses($id){
            $conn=$this->Conn;
            $query=$conn->prepare("delete from classes where id=:id");
            $query->execute([
                ':id'=>$id,
            ]);
            echo "success";
        }
// List Students
        public function listStudents(){
            $conn=$this->Conn;
            $query=$conn->prepare("select students.id as id,students.name as name,students.admission_no,students.roll_no,students.photo,sections.section as section,classes.name as class from students join sections on students.section=sections.section_id join classes on students.class=classes.id");
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
// List Students for update form
        public function getStudentForm($id){
            $conn=$this->Conn;
            $query=$conn->prepare("select admission_no as regno,roll_no as rollno,academic_year,admission_date,class,section,name,photo,gender,email,mobile,current_address as address,father_name,mother_name from students where id=$id");
            $query->execute();
            $row=$query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($row);
        }
// List Students for attendance form
        public function listStudentsForm($classId,$secId){
            $query="select name,id from students";
            if ($classId!=="" AND $secId!=="") {
                $query="select name,id from students where class=$classId AND section=$secId";
            }else if($classId!==""){
                $query="select name,id from students where class=$classId";
            }else if($secId!==""){
                $query="select name,id from students where section=$secId";
            }
            $conn=$this->Conn;
            $query=$conn->prepare($query);
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
// get Student photo for delete
        public function getStudentPhoto($id){
            $conn=$this->Conn;
            $query=$conn->prepare("select photo from students where id=$id");
            $query->execute();
            $row=$query->fetch(PDO::FETCH_ASSOC);
            return $row['photo'];
        }
//add students
        public function addStudents($regno,$rollno,$acayear,$addate,$class,$section,$name,$photo,$gender,$email,$mobile,$address,$fatherName,$motherName){
            // echo "reg". $regno . "rol" . $rollno .'acayer' . $acayear . "adate". $addate . "clas" . $class . "sec" . $section . "name" . $name . "photo" . $photo . "genfer" . $gender . "email" . $email . "mobile" . $mobile . "address" . $address . "father" . $fatherName . "mother" . $motherName ;
            $conn=$this->Conn;
            $query=$conn->prepare("insert into students (name,gender,photo,mobile,email,current_address,father_name,mother_name,admission_no,roll_no,class,section,academic_year,admission_date) values(:name,:gender,:photo,:mobile,:email,:address,:father_name,:mother_name,:regno,:rollno,:class,:section,:acayear,:addate)");
            $query->execute([
                ':name'=>$name,
                ':gender'=>$gender,
                ':photo'=>$photo,
                ':mobile'=>$mobile,
                ':email'=>$email,
                ':address'=>$address,
                ':father_name'=>$fatherName,
                ':mother_name'=>$motherName,
                ':regno'=>$regno,
                ':rollno'=>$rollno,
                ':class'=>$class,
                ':section'=>$section,
                ':acayear'=>$acayear,
                ':addate'=>$addate,
            ]);
            $id=$conn->lastInsertId();
            echo $id;
        }
//update students
        public function updateStudent($regno,$rollno,$acayear,$addate,$class,$section,$name,$photo,$gender,$email,$mobile,$address,$fatherName,$motherName,$id){
            // echo "reg". $regno . "rol" . $rollno .'acayer' . $acayear . "adate". $addate . "clas" . $class . "sec" . $section . "name" . $name . "photo" . $photo . "genfer" . $gender . "email" . $email . "mobile" . $mobile . "address" . $address . "father" . $fatherName . "mother" . $motherName ."---id---".$id;
            $conn=$this->Conn;
            $query=$conn->prepare("update students set name=:name,gender=:gender,photo=:photo,mobile=:mobile,email=:email,current_address=:address,father_name=:father_name,mother_name=:mother_name,admission_no=:regno,roll_no=:rollno,class=:class,section=:section,academic_year=:acayear,admission_date=:addate where id=:id");
            $query->execute([
                ':name'=>$name,
                ':gender'=>$gender,
                ':photo'=>$photo,
                ':mobile'=>$mobile,
                ':email'=>$email,
                ':address'=>$address,
                ':father_name'=>$fatherName,
                ':mother_name'=>$motherName,
                ':regno'=>$regno,
                ':rollno'=>$rollno,
                ':class'=>$class,
                ':section'=>$section,
                ':acayear'=>$acayear,
                ':addate'=>$addate,
                ':id'=>$id,
            ]);
        }
//delete students
public function deleteStudent($id){
    $conn=$this->Conn;
    $query=$conn->prepare("delete from students where id=:id");
    $query->execute([
        ':id'=>$id,
    ]);
    echo "success";
}
// get sections
        public function listSections(){
            $conn=$this->Conn;
            $query=$conn->prepare("select * from sections");
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
//add sections
        public function addSections($section){
            $conn=$this->Conn;
            $query=$conn->prepare("insert into sections (section) values(:section)");
            $query->execute([
                ':section'=>$section,
            ]);
            $id=$conn->lastInsertId();
            echo $id;
        }
//update Sections
public function updateSections($name,$id){
    $conn=$this->Conn;
    $query=$conn->prepare("update sections set section=:name where section_id=:id");
    $query->execute([
        ':name'=>$name,
        ':id'=>$id,
    ]);
    echo "success";
}
//delete sections
        public function deleteSections($id){
            $conn=$this->Conn;
            $query=$conn->prepare("delete from sections where section_id=:id");
            $query->execute([
                ':id'=>$id,
            ]);
            echo "success";
        }
// get Teachers
        public function listTeachers(){
            $conn=$this->Conn;
            $query=$conn->prepare("select teachers.teacher,teachers.teacher_id,subjects.subject,subjects.subject_id,classes.name as className,classes.id as class_id,sections.section,sections.section_id from teachers left join subjects on subjects.subject_id=teachers.subject_id left join classes on teachers.teacher_id=classes.teacher_id left join sections on sections.section_id=classes.section ");
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
//add teachers
        public function addTeachers($name,$subject,$class,$section){
            $conn=$this->Conn;
            $query=$conn->prepare("insert into teachers (teacher,subject_id) values(:teacher,:subject_id)");
            $query->execute([
                ':teacher'=>$name,
                ':subject_id'=>$subject,
            ]);
            $teacher_id=$conn->lastInsertId();
            $classInsert = $conn->prepare("update classes set teacher_id=:teacher_id, section=:section where id=:class_id");
            $classInsert->execute([
                ':teacher_id'=>$teacher_id,
                ':section'=>$section,
                ':class_id'=>$class,
            ]);
        }
//update Teachers
        public function updateTeachers($name,$subject,$id){
            $conn=$this->Conn;
            $query=$conn->prepare("update teachers set teacher=:name,subject_id=:subject where teacher_id=:id");
            $query->execute([
                ':name'=>$name,
                ':subject'=>$subject,
                ':id'=>$id,
            ]);
            // $queryClass=$conn->prepare("update classes set section=:section,teacher_id=:teacher_id where id=:class");
            // $queryClass->execute([
            //     ':section'=>$section,
            //     ':class'=>$class,
            //     ':teacher_id'=>$id,
            // ]);
            echo "success";
        }
//delete teachers
        public function deleteTeachers($id){
            $conn=$this->Conn;
            $query=$conn->prepare("delete from teachers where teacher_id=:id");
            $query->execute([
                ':id'=>$id,
            ]);
            echo "success";
        }
// List Subjects
        public function listSubjects(){
            $conn=$this->Conn;
            $query=$conn->prepare("select * from subjects");
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
//add subjects
        public function addSubjects($subject,$type,$code){
            $conn=$this->Conn;
            $query=$conn->prepare("insert into subjects (subject,type,code) values(:subject,:type,:code)");
            $query->execute([
                ':subject'=>$subject,
                ':type'=>$type,
                ':code'=>$code,
            ]);
            $id=$conn->lastInsertId();
            echo $id;
        }
//update Sections
        public function updateSubjects($subject,$type,$code,$id){
            $conn=$this->Conn;
            $query=$conn->prepare("update subjects set subject=:subject,type=:type,code=:code where subject_id=:id");
            $query->execute([
                ':subject'=>$subject,
                ':type'=>$type,
                ':code'=>$code,
                ':id'=>$id,
            ]);
            echo "success";
    }
//delete subjects
        public function deleteSubjects($id){
            $conn=$this->Conn;
            $query=$conn->prepare("delete from subjects where subject_id=:id");
            $query->execute([
                ':id'=>$id,
            ]);
            echo "success";
        }
// search attendance
        public function searchAttendance($class,$section){
            $conn=$this->Conn;
            $query=$conn->prepare("select students.id,students.admission_no as regno,students.roll_no as rollno,students.name from students where class=:class and section=:section;");
            $query->execute([
                ':class'=>$class,
                ':section'=>$section,
            ]);
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
// add attendance
        public function addAttendance($list){
            $conn=$this->Conn;
            $checkQuery=$conn->prepare("select if(exists(select * from attendance where class_id=:classId and section_id=:sectionId and attendance_date=:attendanceDate),'true','false') as result;");
            $chkClass=$list[0]['class_id'];
            $chkSection=$list[0]['section_id'];
            $chkDate=$list[0]['attendance_date'];
            $checkQuery->execute([
                ':classId'=>$chkClass,
                ':sectionId'=>$chkSection,
                ':attendanceDate'=>$chkDate,
            ]);
            $exists=$checkQuery->fetch(PDO::FETCH_ASSOC);
            if (!($exists['result']==='true')) {
                $query=$conn->prepare("insert into attendance (student_id,class_id,section_id,attendance_status,attendance_date) values(:student_id,:class_id,:section_id,:attendance_status,:attendance_date)");
                for ($i=0; $i < count($list) ; $i++) { 
                    $attendanceObj=$list[$i];
                    $studentId=$attendanceObj['student_id'];
                    $classId=$attendanceObj['class_id'];
                    $sectionId=$attendanceObj['section_id'];
                    $attendanceStatus=$attendanceObj['attendance_status'];
                    $attendanceDate=$attendanceObj['attendance_date'];
                    $query->execute([
                        ':student_id'=>$studentId,
                        ':class_id'=>$classId,
                        ':section_id'=>$sectionId,
                        ':attendance_status'=>$attendanceStatus,
                        ':attendance_date'=>$attendanceDate,
                    ]);
                }
                echo "successfully saved";
            }else{
                echo "attendance already taken";
            }
        }
// search attendance Report
        public function searchAttendanceReport($post){
            $query="select students.name as name,students.roll_no as rollno,classes.name as class, sections.section,attendance_status.name as status_name,attendance_status.status as status_class,attendance.attendance_date as date from attendance 
            left join students on attendance.student_id=students.id left join classes on attendance.class_id=classes.id left join sections on attendance.section_id=sections.section_id left join attendance_status on attendance.attendance_status=attendance_status.id";
            $cond=true;
            $keyArray=["class"=>"classes.id","section"=>"sections.section_id","date"=>"attendance.attendance_date","student"=>"students.id"];
            foreach ($post as $key => $value) {
                if ($value!=="select" AND $value!=="" AND $key!=="action") {
                    if ($cond) {
                        $cond=false;
                        $query.=" where $keyArray[$key]='$value'";
                    } else {
                        $query.=" AND $keyArray[$key]='$value'";
                    }
                }
            }
            // $query="select students.name as name,students.roll_no as rollno,classes.name as class, sections.section,attendance_status.name as status_name,attendance_status.status as status_class,attendance.attendance_date as date from attendance 
            // left join students on attendance.student_id=students.id left join classes on attendance.class_id=classes.id left join sections on attendance.section_id=sections.section_id left join attendance_status on attendance.attendance_status=attendance_status.id";
            // if ($student!=="select" AND $date!=="") {
            //     $query .= " where students.id=$student AND attendance.attendance_date='$date'";
            //     // echo $query;
            // }else if($student!=="select"){
            //     $query .= " where students.id=$student";
            //     // echo $query;
            // }else if($date!==""){
            //     $query .= " where attendance.attendance_date="."'$date'";
            // }
            $conn=$this->Conn;
            $search=$conn->prepare($query);
            $search->execute();
            $rows=$search->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
    //attendance values
        public function attendanceValues($dateFirst,$dateLast){
            $conn=$this->Conn;
            $query=$conn->prepare("SELECT attendance_date,attendance_status FROM attendance where attendance_date <= :dateLast and attendance_date > :dateFirst and attendance_status=1;");
            $query->execute([
                ':dateFirst'=>$dateFirst,
                ':dateLast'=>$dateLast,
            ]);
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
    }
?>