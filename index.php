*พัฒนาโดย Kate_gg สามารถในไปใช้ได้ฟรี
FACEBOOK phairoh kwaigno
กรุณากรอกเลขที่อ้างอิง
<form name="topup" action="" method="post">
<input type="text" class="form-control" name="tw_id" placeholder="เลขที่อ้างอิง" required />
<input type="submit" name="submit" value="topup" class="btn btn-success btn-lg" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if (isset($_REQUEST['tw_id'])){
	require 'wallet.php';
$aa = new Wallet();
$aa->setUsername('');// EMAIL WALLET
$aa->setPassword(''); // PASSWORD WALLET
$Data = json_decode($aa->GetTransaction()); // เรียกข้อมูล
$idlist = 0; //ไม่ต้องแก้
$success = 0;//ไม่ต้องแก้
foreach($Data->data->activities as $Reports){
	if($Reports->text3En == 'creditor'){
		
		$TransactionData = json_decode($aa->GetTransactionInfo($Reports->reportID));
		$tranid = $TransactionData->data->section4->column2->cell1->value;
		if($tranid == $_POST['tw_id']) {
			$success += 1; //เมื่อเลขที่อ้างอิงตรงกับที่อยู่ใน wallet
		}
		$idlist += 1;
if ($idlist == 10) { //10 คือจำนวน LIMITข้อมูล
			break;
		}
if ($success > 0) { //เมื่อทำรายการสำเร็จ
 ?><script> swal("Good job!", "You clicked the button!", "success");</script>
 <?php break;
} else { //เมื่อทำรายการไม่สำเร็จ ?> 
<script> swal("Good job!", "You clicked the button!", "error");</script>
		<?php	}
	}	
}
}

?>
