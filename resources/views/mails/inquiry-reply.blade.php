<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
</head>

<body
  style="width:100%;height:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:Helvetica, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
  <table border="0" cellpadding="0" cellspacing="0"
    style="width:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:Helvetica, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
    <tr>
      <td valign="top" style="display:block;clear:both;margin:0 auto;max-width:580px;">
        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">
          <tr>
            <td valign="top" align="center" class="masthead" style="padding:20px 0;background:#03618c;color:white;">
              <h1 style="font-size:32px;margin:0 auto;max-width:90%;line-height:1.25;">
                <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer"
                  style="text-decoration:none;color:#ffffff;">{{ config('app.name') }}</a>
                <p style="margin-bottom:0;line-height:12px;font-weight:normal;margin-top:15px;font-size:18px;"></p>
              </h1>
            </td>
          </tr>
          <tr>
            <td valign="top" class="content" style="background:white;padding:20px 35px 10px 35px;">
              <p>Dear {{ $name }},</p>
              <p>Thank you for reaching out to us! We’ve received your enquiry and our team is currently reviewing it.
                We will get back to you as soon as possible with the information or assistance you requested.</p>
              <p>If you have any urgent questions or need further assistance, feel free to reply to this email or
                contact us at <strong><a href="tel:{{ callPhoneNumber(phone_india) }}">{{ phone_india }}</a></strong>.
              </p>
              <p>We appreciate your interest and look forward to assisting you soon!</p>
              <br>
              <p>Best regards,</p>
              <p><strong>{{ config('app.name') }}</strong></p>
              <p><strong>{{ contact_email }}</strong></p>
              <p><a href="{{ url('/') }}">{{ DOMAIN }}</a></p>
              <hr>
              <p style="text-align: justify">
                <b>Our mailing address is:</b><br>
                B-16 ground floor Gurugram, Mayfield Garden,<br>Sector 50, Gurugram
              </p>
            </td>
          </tr>
          <tr>
            <td valign="top" align="center" class="masthead" style="padding:20px 0;background:#03618c;color:white;">
              <h1 style="font-size:32px;margin:0 auto;max-width:90%;line-height:1.25;">
              </h1>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
