<?php
parse_str($_POST["userdata"], $userdata);
$basket = $_POST["basket"];
$sum = htmlspecialchars($_POST["sum"]);

$role = htmlspecialchars($userdata['role']);
$name = htmlspecialchars($userdata['name']);
$location = htmlspecialchars($userdata['location']);
$mail = htmlspecialchars($userdata['mail']);
$comments = htmlspecialchars($userdata['comments']);
$phone = htmlspecialchars($userdata['phone']);

if (!empty($phone)) {

	$to = 'khripunovpp@gmail.com';
	$subject = 'LAB';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; utf-8' . "\r\n";
	$headers .= 'From: LAB <clinic@valident.ru>' . "\r\n";
	$message = '
	<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; width:100%;-webkit-text-size-adjust:none;">
				<tr>
						<td style="padding:15px">
								<center style="max-width: 600px; width: 100%; margin: 0 auto;">
										<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0;font-family: Arial, Helvetica, sans-serif; width:100%;">
												<tr>
														<td align="center" style="padding:15px 0"><img src="http://ovz1.prestigedent.1y8yz.vps.myjino.ru/img/logo.jpg" alt="" border="0"></td>
												</tr>
												<tr>
														<td align="center" bgcolor="#3a5ca4" style="padding:15px 0;color:#ffffff;font-size: 18px;font-weight:800"><span>Новый заказ</span></td>
												</tr>
												<tr>
														<td style="padding:35px 15px;border:1px solid #3a5ca4">';

	$message .= '
															<span style="color: #666666; font: 14px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;margin:15px 0 0 0">Тип плательщика:</span>
															<span style="color: #333333; font: 20px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;font-weight:800">'.$role.'</span>';

	$message .= '
															<span style="color: #666666; font: 14px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;margin:15px 0 0 0">ФИО:</span>
															<span style="color: #333333; font: 20px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;font-weight:800">'.$name.'</span>';

	$message .= '
															<span style="color: #666666; font: 14px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;margin:15px 0 0 0">Город:</span>
															<span style="color: #333333; font: 20px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;font-weight:800">'.$location.'</span>';

	$message .= '
															<span style="color: #666666; font: 14px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;margin:15px 0 0 0">Телефон:</span>
															<span style="color: #333333; font: 20px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;font-weight:800">'.$phone.'</span>';

	$message .= '
															<span style="color: #666666; font: 14px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;margin:15px 0 0 0">Email:</span>
															<span style="color: #333333; font: 20px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;font-weight:800">'.$mail.'</span>';

	$message .= '								<hr style="margin:30px 0">
															<span style="color: #222222; font: 18px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;margin:15px 0 0 0;text-align: center">Товары в заказе</span>
															<hr style="margin:30px 0">';

	foreach ($basket as &$item) {
		$message .= '
															<span style="color: #5583bc; font: 20px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;margin:15px 0 0 0">'.$item['name'].'</span>
															<span style="color: #727273; font: 16px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;">Тип цены: <b style="color:#333333">'.$item['costType'].'</b></span>
															<span style="color: #727273; font: 16px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;">Колличество: <b style="color:#333333">'.$item['quantity'].' шт.</b></span>
															<span style="color: #727273; font: 16px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;">Цена: <b style="color:#333333">'.$item['price'].' руб./шт.</b></span>
															<hr style="margin:30px 0">';
	}

	$message .= '
															<span style="color: #666666; font: 14px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;text-align:center">Общая сумма</span>
															<span style="color: #333333; font: 35px Arial, sans-serif; line-height: 30px; -webkit-text-size-adjust:none; display: block;font-weight:800;text-align:center">'.$sum.' руб.</span>';

	$message .= '							</td>
											</tr>
									</table>
							</center>
					</td>
			</tr>
	</table>';
				
	mail($to, $subject, $message, $headers);

	$jsonout = '{"status": "success"}';

} else {

	$jsonout = '{"status": "error"}';
	
}

echo $jsonout;

?>