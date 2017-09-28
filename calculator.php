<?php
include 'classes/Calculator.php';
include 'dumpr.php';

$c = new Calculator($_POST);

dumpr($_POST);
dumpr($c->calculatorObject, 0, 0, 0);

?>

<form name="" action="" method="post">

    <table border="1">

        <tr>

            <td>
                <input name="factor1" type="number" step="any" value="<?php echo $c->calculatorObject->factor1 ?>" />
            </td>

            <td>
                <select name="operator">
                    <option value="add"         <?='' == 'add'      ? 'selected' : '' ?>>&#43;</option><!-- + -->
                    <option value="subtract"    <?='' == 'subtract' ? 'selected' : '' ?>>&#45;</option><!-- - -->
                    <option value="divide"      <?='' == 'divide'   ? 'selected' : '' ?>>&#47;</option><!-- / -->
                    <option value="multiply"    <?='' == 'multiply' ? 'selected' : '' ?>>x</option>
                </select>
            </td>

            <td>
                <input name="factor2" type="number" step="any" value="<?php echo $c->calculatorObject->factor2 ?>" />
            </td>

            <td>    
                <input name="" type="submit" value="=" />
            </td>

            <td>        
                <input name="" type="" value="<?php echo $c->calculatorObject->total ?>" disabled />
            </td>

        </tr>

    </table>

    <p><a href="<?=$_SERVER['PHP_SELF'] ?>">Reset</a></p>

    <input type="hidden" name="frm" value="calculate" />

</form>
