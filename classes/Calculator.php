 <?php
 
class Calculator {
    
    /**
     * @var type 
     */
    public $calculatorObject;
  
    /**
     * The Constructor magic method is called on instantiation
     * of the Class
     */
    function __construct(){

        if(isset($_POST['frm']) && $_POST['frm'] == 'calculate'){

            $this->calculatorObject = $this->calculate();

        } else {

            $this->calculatorObject = $this->createDefaultObject();

        }

    }
    
    public function createDefaultObject()
    {
        $calculatorObject = new stdClass;
        
        $calculatorObject->factor1 = 0;
        $calculatorObject->factor2 = 0;
        $calculatorObject->operator = "add";
        $calculatorObject->total = 0;
        
        return $calculatorObject;
       
    }



    /**
     * 
     * @return \StdClass
     */
    function calculate()
    {
               
        $factor1  = (float)$_POST['factor1'];
        $factor2  = (float)$_POST['factor2'];
        $operator =        $_POST['operator'];  // this is the 'value' from the <option> element

        switch($operator){
        
            case 'add':
                $result = ($factor1 + $factor2);
                break;

            case 'subtract':
                $result = ($factor1 - $factor2);
                break;

            case 'divide':
                $result = ($factor1 / $factor2);
                break;

            case 'multiply':
                $result = ($factor1 * $factor2);
                break;
            
            default:
                $result = '';

        }
        
        $calculatorObject->factor1 = $factor1;
        $calculatorObject->factor2 = $factor2;
        $calculatorObject->operator = $operator;
        $calculatorObject->total = $result;
        
        return $calculatorObject;
    }
    
} 