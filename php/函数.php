<?php
function tableCreate($tableName,$rows,$cols){
    echo '<center>'.$tableName.'</center><br>';
    echo '<center><table>';
    for($i=0;$i<$rows;$i++) {
        echo '<tr>'.$i;

        for ($j = 0; $j < $cols; $j++) {
            echo '<td>'.($i*$j+$j).'</td>';
        }

        echo '</tr>';
    }
    echo '</table></center>';

}
tableCreate('test',10,10);