<html>
<head></head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<table style="border-collapse:collapse; margin:0;padding:0;width:100%;background-color:#f2f2f2; mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" bgcolor="#f2f2f2" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>
		<td valign="top" align="center" height="30" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
	</tr>
	<tr>
		<td style="margin:0;padding:0;width:100%;border-top:0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="left" style="text-align:left; padding: 18px 40px 15px 40px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #dddddd;">
						<a href="https://theplayculture.com/grt" style="display: inline-block; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" target="_blank">
							<img src="https://theplayculture.com/grt/images/logo.png" alt="" style="width: 120px;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" width="120">
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="margin:0;padding:0;width:100%;border-top:0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="center" style="text-align:left; padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 0px solid #dddddd; position: relative; background: url(https://theplayculture.com/grt/images/donor-bg.jpg) no-repeat center center; background-size: cover;  height: 300px; object-fit:cover; min-height: 200px;">
						<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:28px; line-height:32px; color:#ffffff; text-align:left; padding:0px 40px; margin:100px 0px  0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; position: absolute; left: 0px; top:50%; width:100%; max-width: 175px;">
							Thank you for saving lives.
							<span  style="float: left;font-size:10px; line-height:10px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width:100%; border-top: 2px solid #ffffff; margin-top: 3px;"></span>
						</h2>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="margin:0;padding:0;width:100%;border-top:0; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; padding: 0 40px;">
						<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
							<tr>
								<td valign="top" align="center" height="40" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							@php 
							$total = 0;
							@endphp
							@foreach($cart_data as $row)
							@php
							$total += ($row['quantity']*$row['amount']);
							@endphp
							@endforeach 
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:24px; line-height:30px; color:#222222; text-align:left; padding:0px 0 25px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Dear {{$order['name']}} {{$order['lastname']}},</h2>
									<p style="font-family:Arial, Helvetica, sans-serif;font-size:24px; line-height:30px; color:#222222; text-align:left; padding:0px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Thank you for donating &#163;{{$total + $admincost}} on {{date("j F Y")}}. <!-- Your donation reference is 123454678. -->
									</p>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" height="40" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" height="15" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-top: 1px solid #DDDDDD;">&nbsp;</td>
							</tr>
							
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<table style="border-collapse: collapse; width: 100%; border: 0px; margin-bottom: 0px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
								      
								      <tr>
								        <td style="font-size: 14px; line-height: 18px; color: #AAAAAA; text-transform: uppercase; border: 0px;font-weight: 700; text-align: left; padding: 5px 0px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 50%;">Project</td>
								        <td style="font-size: 14px; line-height: 18px; color: #AAAAAA; text-transform: uppercase; border: 0px;font-weight: 700; text-align: left; padding: 5px 10px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Type</td>
								        <td style="font-size: 14px; line-height: 18px; color: #AAAAAA; text-transform: uppercase; border: 0px;font-weight: 700; text-align: right; padding: 5px 0px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Amount</td>
								      </tr>
										@php 
										$total = 0;
										foreach($cart_data as $row) { 
										$total += ($row['quantity']*$row['amount']); 
										@endphp
								      <tr>
								        <td style="font-size: 16px; line-height: 20px; border: 0px; color: #222222; text-align: left; padding:5px 0px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;width: 50%;">{{$row['title']}}
								        </td>
								        <td style="font-size: 16px; line-height: 20px; border: 0px; color: #222222; text-align: left; padding:5px 10px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">{{$row['paymenttype']}}
								        	
								        </td>
								        <td style="font-size: 16px; line-height: 20px; border: 0px; color: #222222; text-align: right; padding:5px 0px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
								        	<span style="float: left; width: 100%; font-size: 16px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&#163;{{$row['amount']}}</span>
								        </td>
								      </tr>
								      @php } @endphp
								      <tr>
										<td valign="top" align="center" height="15" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #DDDDDD;" colspan="3">&nbsp;</td>
									  </tr>
									  @if($admincost > 0)
									  <tr>
								        <td style="font-size: 16px; line-height: 20px; border: 0px; color: #222222; text-align: right; padding:15px 0px 5px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-top: 1px solid #DDDDDD;" colspan="2"><b>Admin cost(one-off):</b></td>
								        <td style="font-size: 16px; line-height: 20px; border: 0px; color: #222222; text-align: right; padding:15px 0px 5px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-top: 1px solid #DDDDDD;">??{{$admincost}}</td>
								      </tr>
									  @endif
								      <tr>
								        <td style="font-size: 16px; line-height: 20px; border: 0px; color: #222222; text-align: right; padding:5px 0px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" colspan="2"><b>Total:</b></td>
								        <td style="font-size: 16px; line-height: 20px; border: 0px; color: #222222; text-align: right; padding:5px 0px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">??{{$total + $admincost}}</td>
								      </tr>
								  </table>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" height="40" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<p style="font-family:Arial, Helvetica, sans-serif;font-size:20px; line-height:24px; color:#222222; text-align:left; padding:0px 0px 10px 0px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
										Kind Regards,<br>
										Global Relief Trust (GRT) Team
									</p>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" height="25" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<p style="font-family:Arial, Helvetica, sans-serif;font-size:16px; line-height:20px; color:#222222; font-style: italic; text-align:left; padding:0px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
										&#34;The believers in their mutual kindness, compassion and sympathy are just like one body. When one of the limbs suffers, the whole body responds to it with wakefulness and fever&#34;
									</p>
									<p style="font-family:Arial, Helvetica, sans-serif;font-size:16px; line-height:20px; color:#222222; text-align:left; padding:20px 0px 0px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
										- Prophet Muhammad (PBUH)
									</p>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" height="50" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" align="center" height="40" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
	</tr>
	<tr>
		<td style="margin:0;padding:0;width:100%;border-top:0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table cellspacing="0" cellpadding="0" border="0" bgcolor="#f2f2f2" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
						<a href="#" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 24px; text-decoration:none; margin: 0 5px;">
							<img src="https://theplayculture.com/grt/images/instagram.png" alt="">
						</a>
						<a href="https://www.facebook.com/globalrelieftrustuk" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 24px; text-decoration:none; margin: 0 5px;">
							<img src="https://theplayculture.com/grt/images/facebook.png" alt="">
						</a>
						<a href="#" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 24px; text-decoration:none; margin: 0 5px;">
							<img src="https://theplayculture.com/grt/images/twitter.png" alt="">
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="margin:0;padding:0;width:100%;border-top:0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table cellspacing="0" cellpadding="0" border="0" bgcolor="#f2f2f2" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
						<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px; line-height:14px; color:#777777; text-align:center; padding:5px 0px 0px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
							Copyright @ 2022 GRT, All Right Reserved. Charity Number: 1191793
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" align="center" height="100" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
	</tr>
</table>
</body>
</html>