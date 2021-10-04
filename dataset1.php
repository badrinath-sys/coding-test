<?php
$dataset1 = <<<DS1
NAME,LEG_LENGTH,DIET
Hadrosaurus,1.2,herbivore
Struthiomimus,0.92,omnivore
Velociraptor,1.0,carnivore
Euoplocephalus,1.6,herbivore
Stegosaurus,1.40,herbivore
Tyrannosaurus Rex,2.5,carnivore
DS1;

$dataset2 = <<<DS2
NAME,STRIDE_LENGTH,STANCE
Euoplocephalus,1.87,quadrupedal
Stegosaurus,1.90,quadrupedal
Tyrannosaurus Rex,5.76,bipedal
Hadrosaurus,1.4,bipedal
Struthiomimus,1.34,bipedal
Velociraptor,2.72,bipedal
DS2;

$array1 = preg_split("/\r\n|\n|\r/", $dataset1);
$array2 = preg_split("/\r\n|\n|\r/", $dataset2);
$array_set1=[];
$array_set2=[];
$array_set=[];


for($num=1;$num<count($array1); $num++)
{
$str1=explode(',',$array1[$num]);  
$str2=explode(',',$array2[$num]);  
$array_set1[$num-1]['name']=$str1[0];
$array_set2[$num-1]['name']=$str2[0];
$array_set1[$num-1]['leg_length']=$str1[1];
$array_set2[$num-1]['stride_length']=$str2[1];
$array_set1[$num-1]['diet']=$str1[2];
$array_set2[$num-1]['stance']=$str2[2];
}
asort($array_set1);
asort($array_set2);
$num=0;
foreach($array_set1 as $data)
{
    $array_set[$num]['name']=$data['name'];
    $array_set[$num]['leg_length']=$data['leg_length'];
    $array_set[$num]['diet']=$data['diet'];
    $num++;
}
$num=0;
foreach($array_set2 as $data)
{
    $array_set[$num]['stride_length']=$data['stride_length'];
    $array_set[$num]['stance']=$data['stance'];
    $array_set[$num]['speed']=(($array_set[$num]['stride_length'] / $array_set[$num]['leg_length']) - 1) * SQRT($array_set[$num]['leg_length'] * 9.8);
    $num++;
}
$stance='bipedal';



$result=[];
foreach($array_set as $data)
{
    if ($data['stance']== $stance) {
        $result[]= $data;
    }
}

function DescSort($item1,$item2)
{
    return ($item1['speed'] < $item2['speed']);
}
usort($result, 'DescSort');

$names = array_column($result, 'speed');
echo implode("<br>", $names);

?>
