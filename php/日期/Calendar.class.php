<?php
class Calendar {
    private $year;
    private $month;
    private $start_weekday;
    private $day;

    public function __construct(){
        $this->year = $_GET['year']??date('Y');
        $this->month = $_GET['month']??date('m');
        $this->start_weekday = date('W',mktime(0,0,0,$this->month,1,$this->year));
        $this->days = date('t',mktime(0,0,0,$this->month,1,$this->year));
    }

    public function __toString(){
        $out = "<table align='center'>";
//        $url = __DIR__.'/日历类.php';
        $out .= $this->chageDate();
        $out .= $this->weekList();
        $out .= $this->dayList();
        $out .= '</table>';

        return $out;
    }

    private function weekList(){
        $week = array('日','一','二','三','四','五','六');

        $out = '<tr class="fontb">';
        for($i=0;$i<count($week);$i++){
            $out .= '<th class="fontb">'.$week[$i].'</th>';
        }

        $out .= '</tr>';
        return $out;
    }

    private function dayList(){
        $out = '<tr>';

        for($i=0;$i<$this->start_weekday;$i++)
            $out .= '<td>&nbsp;</td>';

        for($k=1;$k<=$this->days;$k++){
            $i++;
            if($k == date('d')){
                $out .= '<td class="fontb">'.$k.'</td>';
            }else{
                $out .= '<td>'.$k.'</td>';
            }

            if($i % 7 ==0)
                $out .= '</tr><tr>';
        }

        while($i % 7!== 0){
            $out .= '<td>&nbsp;</td>';
            $i++;
        }

        $out .= '</tr>';
        return $out;
    }

    private function prevYear($year,$month){
        $year -- ;
        if($year < 1970)
            $year =1970;
        return "year={$year}&month={$month}";
    }

    private function prevMonth($year,$month){
        if($month==1){
            $year = $year-1;
            if($year < 1970)
                $year = 1970;

            $month = 12;
        }else{
            $month--;
        }

        return "year={$year}&month={$month}";
    }

    private function nextYear($year,$month){
        $year ++;
        if($year>2038)
            $year = 2038;

        return "year={$year}&month={$month}";
    }

    private function nextMonth($year,$month){
        if($month == 12){
            $year = $year+1;
            if($year>2038)
                $year = 2038;

            $month = 1;
        }else{
            $month ++;
        }

        return "year={$year}&month={$month}";
    }

    private function chageDate($url = '日历类.php'){
        $out = '<tr>';
        $out .= '<td><a href="'.$url.'?'.$this->prevYear($this->year,$this->month).'">'.'<<'.'</a></td>';
        $out .= '<td><a href="'.$url.'?'.$this->prevMonth($this->year,$this->month).'">'.'<'.'</a></td>';

        $out .= '<td colspan="3"></td>';
        $out .= '<form>';
        $out .= '<select name="year" onchange="window.location = \''.$url.'?year=\'+this.options[selectedIndex].value+\'&month='.
            $this->month.'\'">';
        for($sy = 1970;$sy <= 2038;$sy++){
            $selected = ($sy==$this->year)?'selected':'';
            $out .= '<option '.$selected.' value="'.$sy.'">'.$sy.'</option>';

        }

        $out .= '</select>';
        $out .= '<select name="month" onchange="window.location = \''.$url.'?year=\'+this.options[selectedIndex].value">';
        for($sm = 1;$sm <= 12;$sm++){
            $selected1 = ($sm==$this->month)?'selected':'';
            $out .= '<option '.$selected1.' value="'.$sm.'">'.$sm.'</option>';

        }

        $out .= '</select>';
        $out .= '</form>';
        $out .= '</td>';

        $out .= '<td><a href="'.$url.'?'.$this->nextYear($this->year,$this->month).'">'.'>>'.'</a></td>';
        $out .= '<td><a href="'.$url.'?'.$this->nextMonth($this->year,$this->month).'">'.'>'.'</a></td>';

        $out .= '</tr>';

        return $out;

    }
}