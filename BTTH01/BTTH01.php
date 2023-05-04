// Khai báo lớp Student
class Student {
  private $masv;
  private $hoten;
  private $gioitinh;
  private $ngaysinh;
  private $diachi;
  
  public function __construct($masv, $hoten, $gioitinh, $ngaysinh, $diachi) {
    $this->masv = $masv;
    $this->hoten = $hoten;
    $this->gioitinh = $gioitinh;
    $this->ngaysinh = $ngaysinh;
    $this->diachi = $diachi;
  }
  
  public function getMasv() {
    return $this->masv;
  }
  
  public function getHoten() {
    return $this->hoten;
  }
  
  public function getGioitinh() {
    return $this->gioitinh;
  }
  
  public function getNgaysinh() {
    return $this->ngaysinh;
  }
  
  public function getDiachi() {
    return $this->diachi;
  }
}

// Khai báo lớp ListOfStudent
class ListOfStudent {
  private $students;
  
  public function __construct() {
    $this->students = array();
  }
  
  public function addStudent($masv, $hoten, $gioitinh, $ngaysinh, $diachi) {
    $student = new Student($masv, $hoten, $gioitinh, $ngaysinh, $diachi);
    array_push($this->students, $student);
  }
  
  public function getStudents() {
    return $this->students;
  }
}