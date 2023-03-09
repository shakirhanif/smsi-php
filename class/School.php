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
            $query=$conn->prepare("select classes.id as id,classes.name as name,sections.section as section,teachers.teacher as teacher from classes join sections on classes.section=sections.section_id join teachers on classes.teacher_id=teachers.teacher_id");
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
// get sections
        public function listSections(){
            $conn=$this->Conn;
            $query=$conn->prepare("select * from sections");
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
// get Teachers
        public function listTeachers(){
            $conn=$this->Conn;
            $query=$conn->prepare("select * from teachers");
            $query->execute();
            $rows=$query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
        }
    }
?>