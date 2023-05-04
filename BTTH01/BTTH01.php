// Khai báo lớp Student
class Student {
  private $id;
  private $name;
  private $age;
  
  public function __construct($id, $name, $age) {
    $this->id = $id;
    $this->name = $name;
    $this->age = $age;
  }
  
  public function getId() {
    return $this->id;
  }
  
  public function getName() {
    return $this->name;
  }
  
  public function getAge() {
    return $this->age;
  }
}

// Khai báo lớp ListOfStudent
class ListOfStudent {
  private $students;
  
  public function __construct() {
    $this->students = array();
  }
  
  public function addStudent($id, $name, $age) {
    $student = new Student($id, $name, $age);
    array_push($this->students, $student);
  }
  
  public function getStudents() {
    return $this->students;
  }
}