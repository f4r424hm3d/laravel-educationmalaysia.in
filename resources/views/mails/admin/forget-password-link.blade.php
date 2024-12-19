<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />

  <style>
    .pink-btn {
      font-weight: bold;
      background: #e74e84;
      color: #fff;
      align-items: center;
      padding: 12px 25px;
      font-size: 15px;
      border-radius: 4px;
      border: 0px
    }

    .pink-btn a {
      color: #fff;
      text-decoration: none
    }

    .pink-btn:hover {
      background: #3f4079;
    }

    .blue-btn {
      font-weight: bold;
      background: #3f4079;
      color: #fff;
      align-items: center;
      padding: 12px 25px;
      font-size: 15px;
      border-radius: 4px;
      border: 0px
    }

    .blue-btn a {
      color: #fff;
      text-decoration: none
    }

    .blue-btn:hover {
      background: #e74e84;
    }
  </style>
</head>

<body
  style="width:100%;height:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:Helvetica, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
  <table border="0" cellpadding="0" cellspacing="0"
    style="width:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:Helvetica, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
    <tr>
      <td valign="top" style="display:block;clear:both;margin:0 auto;max-width:580px;">
        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">
          <tr>
            <td valign="top" align="center" class="masthead"
              style="padding:20px 0px 5px 0px;background:#3f4079;color:white;">
              <h1 style="font-size:32px;margin:0 auto;max-width:90%;line-height:1.25;">
                <a href="{{ url('/') }}" target="_blank" style="text-decoration:none;color:#ffffff;">{{
                  config('app.name'); }}</a>
                <p style="margin-bottom:0;line-height:12px;font-weight:normal;margin-top:15px;font-size:18px;"></p>
              </h1>
            </td>
          </tr>
          <tr>
            <td valign="top" class="content" style="background:white;padding:25px;">
              <p style="text-align: justify">
                Hi {{ $name }},

                Sorry to hear you’re having trouble logging. We got a message that you forgot your password. If this was
                you, you can get right back into your account or reset your password now.
              </p>
              <button class="pink-btn"><a href="{{ $login_link }}">Log in</a></button>
              <button class="blue-btn"><a href="{{ $reset_password_link }}">Reset your password</a></button>
            </td>
          </tr>
          <tr>
            <td valign="top" align="center" class="masthead" style="padding:20px 0;background:#e74e84;color:white;">
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