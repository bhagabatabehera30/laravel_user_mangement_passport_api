<?php 
class Employee {

    public $age;
    public $name;
    private $dob;

    function __construct($name, $age, $dob) {
        $this->name=$name;
        $this->age=$name;
        $this->dob=$name;
    }

    public function getEmpleeDetails() 
     {

        $resAr=[
            'name'=>$this->name,
            'age'=>$this->age,
            'dob'=>$this->dob,
        ];

        return json_encode($resAr);
    
    }


}

$objEmp=new Employee('Bhagabat',32,'08-04-1900');
print_r($objEmp->getEmpleeDetails());
?>