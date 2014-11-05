<?php
/**
 * Created by PhpStorm.
 * User: haho
 * Date: 11/3/14
 * Time: 10:18 AM
 */

class phancong{
    public  $ngay = array();
    public function gan($thai,$tba,$ttu,$tnam,$tsau,$tbay,$cnhat){
        $this->ngay['hai'] = $thai;
        $this->ngay['ba'] = $tba;
        $this->ngay['tu'] = $ttu;
        $this->ngay['nam'] = $tnam;
        $this->ngay['sau'] = $tsau;
        $this->ngay['bay'] = $tbay;
        $this->ngay['cn'] = $cnhat;
    }
    public function tongyta(){
        $tong = 0;
        foreach($this->ngay as $value){
            $tong = $tong+$value;
        }
        return $tong;
    }

    public function demsolan($arr,$x){
        $dem = 0;
        for($i=0;$i<count($arr[$i]);$i++){
            if(in_array($x,$arr[$i])){
                $dem++;
            }
        }
        return $dem;
    }

    public function xuat(){
        $total = array();
        $yta = array();
        foreach ($this->ngay as $key => $value){
            for($i=0;$i<$value;$i++){
                $total[] = $key;
            }
        }
        shuffle($total);
        $avg_yta = array_sum($this->ngay)/7;
        foreach($this->ngay as $key=>$value){
            $i = 0;
            while($i<$value){
                if(isset($yta[$i])== false){
                    $dem_so_ngay_da_lam_viec = 0;
                }
                else{
                    $dem_so_ngay_da_lam_viec = count($yta[$i]);
                }
                if ($dem_so_ngay_da_lam_viec < $avg_yta) {
                    $yta[$i][]=$total[0] ;
                    array_shift($total);
                    unset($total[$i]);
                    $i++;

                } else {
                    $i++;
                    $value++;
                }
            }
        }
        echo "<pre>";
        //unset($total[3]);
        //array_shift($total);
        print_r($yta);
        echo "</pre>";
    }

    public function inketqua()
    {
        $yta = array();

        $avg_yta = array_sum($this->ngay)/7;
        foreach ($this->ngay as $key => $value) {
            $i = 0;
            if ($key != 'bay' && $key != 'cn') {
                while ($i < $value) {
                    if(isset($yta[$i])== false){
                        $dem_so_ngay_da_lam_viec = 0;
                    }
                    else{
                        $dem_so_ngay_da_lam_viec = count($yta[$i]);
                    }
                    if ($dem_so_ngay_da_lam_viec < $avg_yta) {
                        $yta[$i][] = $key;
                        $i++;

                    } else {
                        $i++;
                        $value++;
                    }

                }
            }
            else{
                while ($i < $value) {
                    if(isset($yta[$i])== false){
                        $dem_so_ngay_da_lam_viec = 0;
                        $co_lam_viec_thu7 = false;
                        $co_lam_viec_cn = false;
                    }
                    else{
                        $dem_so_ngay_da_lam_viec = count($yta[$i]);
                        $co_lam_viec_thu7 = in_array('bay',$yta[$i]);
                        $co_lam_viec_cn = in_array('cn',$yta[$i]);
                    }
                    if ($dem_so_ngay_da_lam_viec < $avg_yta&& !$co_lam_viec_thu7 && !$co_lam_viec_cn) {
                        $yta[$i][] = $key;
                        $i++;

                    } else {
                        $i++;
                        $value++;
                    }

                }
            }
            /*for ($i = 0; $i < $value; $i++) {
                if (count($yta[$i]) < $avg_yta) {
                    $yta[$i][] = $key;
                }
            }*/
        }
        return $yta;
    }

}
/*$pc = new phancong();
$pc->gan(5,5,8,2,6,3,4);
echo "<pre>";
print_r($pc->inketqua());
echo "</pre>";
$pc->xuat();
*/

if (isset($_POST['phancong'])) {
    $pc = new phancong();
    $pc->gan($_POST['hai'], $_POST['ba'], $_POST['tu'], $_POST['nam'], $_POST['sau'], $_POST['bay'], $_POST['cn']);
    echo "<pre>";
    print_r($pc->inketqua());
    echo "</pre>";

} else {
    echo "<form method = 'POST' >";
    echo "Thu 2 : <input type = 'text' name = 'hai'/> <br />";
    echo "Thu 3 : <input type = 'text' name = 'ba'/> <br />";
    echo "Thu 4 : <input type = 'text' name = 'tu'/> <br />";
    echo "Thu 5 : <input type = 'text' name = 'nam'/> <br />";
    echo "Thu 6 : <input type = 'text' name = 'sau'/> <br />";
    echo "Thu 7 : <input type = 'text' name = 'bay'/> <br />";
    echo "CN : <input type='' = 'text' name = 'cn'/> <br />";
    echo "<input type = submit name ='phancong'/>";
    echo "</form>";
}
