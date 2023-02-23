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
		<td style="margin:0;padding:0;width:100%;border-top:0; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; padding: 0 40px;">
						<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
							<tr>
								<td valign="top" align="center" height="40" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#000000; text-align:left; padding:0px 0 20px; margin:0px; font-weight: 700; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Hi {{$data['name']}},</h2>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#000000; text-align:left; padding:0px 0px 20px 0px; margin:0px; font-weight: 700; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Your fundraising page on 13 Rivers Trust for {{$data['appeal']}}, is live and ready to receive donations.</h2>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#000000; text-align:left; padding:0px 0 20px; margin:0px; font-weight: 700; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">We'll send the money you raise directly to 13 Rivers Trust, so you can focus on your fundraising.</h2>
								</td>
							</tr>
							<tr>
								<td valign="top" align="left" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#000000; text-align:left; padding:0px 0 20px; margin:0px; font-weight: 700; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Here is your page we address: <a href="#" style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#000000; text-align:left; padding:0px 0 20px; margin:0px; font-weight: 700; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> 

									@php $slug = preg_replace('/\s+/', '-', $data['title']); @endphp
									{{url('fundraising')}}/{{$slug}}</a></h2>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#000000; text-align:left; padding:0px 0 20px; margin:0px; font-weight: 700; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Don't forget to share your page.</h2>
								</td>
							</tr>
							
							<tr>
								<td valign="top" align="center" height="25" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<p style="font-family:Arial, Helvetica, sans-serif;font-size:20px; line-height:24px; color:#000000; text-align:left; padding:0px 0px 10px 0px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
										Kind Regards,<br>
										Global Relief Trust (GRT) Team
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