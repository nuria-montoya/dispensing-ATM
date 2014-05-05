<?php

include_once 'controller/LogicAtm.class.php';
echo "\n";
echo "\n";
echo '*********ATM Simulator************';

echo "\n";
echo "\n";
try {
	
	$note20 = (int)($argv[1]);
	$note50 = (int)($argv[2]);

   $atm = new LogicAtm($note20, $note50);
   
   $amount = (int)($argv[3]);
   
   $rest = $atm->getNotes();
   
   echo '> Data Before a cash dispensing.........';
   echo "\n";
   echo 'Notes $20 inici: '.$rest['notes20'];
   echo "\n";
   echo 'Notes $50 inici: '.$rest['notes50'];
   echo "\n";
   echo 'Total: $'.$rest['total'];
   
   echo "\n";
   echo 'Amount to dispense: $'.$amount;
   echo "\n";
   echo "\n";
   
   echo '> Data After a cash dispensing.........';
   echo "\n";
   
   $quant = $atm->combinations($amount);
   
   echo 'Result notes $20: '.$quant['notes20'];
   echo "\n";
   echo 'Result notes $50: '.$quant['notes50'];
   echo "\n";
   
   echo "\n";
   $rest = $atm->getNotes();
   
   echo 'How many $20 notes on ATM: '.$rest['notes20'];
   
   echo "\n";
   echo 'How many $50 notes on ATM: '.$rest['notes50'];
   echo "\n";
   
   echo 'Total cash: $'.$rest['total'];
   
   echo "\n";
   echo "\n";
   
   
} catch (Exception $e) {
	//if there are errors
   echo '<!!> ';
   echo $e->getMessage();
   echo "\n";
   echo "\n";
   echo '**********************************';
   echo "\n";
   
   exit();
}
echo '**********************************';
echo "\n";
echo "\n";
