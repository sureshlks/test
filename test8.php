<html>
    <body>
<form method="post">
<textarea name="query"></textarea>
    <input value='submit' type="submit" />
</form>
<?php

require_once '../app/Mage.php';
ini_set('set_time_limit', '0');
ini_set('display_errors', 1);
Mage::app()->setCurrentStore(0);
echo "<pre>";
$read = Mage::getSingleton('core/resource')->getConnection('core_read');
$configs    = ($read->getConfig());
print_r($configs);
$configs['host']='in3dbc-1.cluster-coiwhcgqtihv.ap-south-1.rds.amazonaws.com';
$configs['username']='in3boonboxpilot';
$configs['password']='in3boonboxpilot';        
$write = Mage::getSingleton('core/resource')->createConnection('reports', 'pdo_mysql', $configs);
			
$res=   $write->fetchRpw("SELECT * FROM `rpt_flat_order_status` LIMIT 1");
print_r($res);
exit;
$_POST['query'];
if($_POST['query']!=''){
    $query   = $_POST['query'];
   $res = $read->fetchAll($query);
    //echo $query;
    foreach($res as $k=>$val)
    {
        $insqury    =  "INSERT INTO rpt_flat_order_status SET ";
        foreach($val as $k=>$v)
        {
            if($k=="last_name"){
                $insqury.=$k."='".$v."'";
            }else{
                 $insqury.=$k."='".$v."',";
            }            
        }
        
        echo $insqury."<br>";
    }
   
}


?>
        </body>
</html>