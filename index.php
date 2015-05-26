<?php 
header("Content-Type: text/html; charset=utf-8");
class Decoding{

    public $code;
    public $len;
    public $str;

    public function __construct($value)
{
        $this->code = $value;
        $this->len = 4;
        $this->start();
}

    public function start()
{
     $work = array(0,1,2,3,4,5,6,7,8,9);

    for($i = 97; $i <= 122; $i++)
    {
        $work[] = chr($i);
    }
    for($i = 65; $i <= 90; $i++)
    {
        $work[] = chr($i);
    }
    $min_length = 1;
    $max_length = $this->len;
    $min = $this->str_to_dec(str_repeat($work[sizeof($work)- 1], $min_length-1), $work)+1;
    $max = $this->str_to_dec(str_repeat($work[sizeof($work)- 1], $max_length), $work);
    $size = $max - $min +1;
    $result = array();
    for($i = $min; $i <= $max; $i++ )
    {
        $this->comparison($this->dec_to_str($i, $work));
    }
}

    function str_to_dec($s, $sys)
{
    $sys = array_flip($sys);
     
    $j = -1;
    $result = 0;
    for($i = strlen($s)-1; $i >= 0; $i--)
    {
        $j++;
        $result += ($sys[$s[$j]]+1) * pow(sizeof($sys), $i);
    }
    return $result;
}

function dec_to_str($i, $work)
{
    $r = sizeof($work);
    $w = '';
    while($i > 0)
    {
        $t = $i % $r;
        if($t == 0){
            $w .= $work[$r-1];
            $i = $i / $r -1;
        } else {
            $w .= $work[$t-1];
            $i = ($i - $t) / $r;
        }
    }
    return strrev($w);
}

function comparison($string){
	if(md5($string)===$this->code){
		echo $string;
		return;
	}
}
}

$obj = new Decoding('aedec944fea8d666e777c53c0b69cf48');

     


























