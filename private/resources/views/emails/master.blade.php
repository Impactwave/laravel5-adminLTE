<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        /* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
        body{margin:0;padding:0;}
        img{border:0 none;height:auto;line-height:100%;outline:none;text-decoration:none;}
        a img{border:0 none;}
        .imageFix{display:block;}
        table, td{border-collapse:collapse; border-spacing: 0;}
        #bodyTable{height:100% !important;margin:0;padding:0;width:100% !important;}
        /* Email Client Specific Overrides */
        .ExternalClass{width:100%;}
        .ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height: 100%;}
        h2,h3,h4,h5,h6{color:#444 !important;}
        #outlook a{padding:0;}
        table{mso-table-lspace:0pt;mso-table-rspace:0pt;}
        img{-ms-interpolation-mode:bicubic;}
        body{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}

    </style>
</head>
<body style="height:100%;margin:0;" bgcolor="#EEE">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" bgcolor="#EEE" id="bodyTable">
    <!--New Content Block Wrapper Row-->
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center" valign="top" style="padding:40px 10px;">
                        <!--[if (gte mso 9)|(IE)]>
                        <table width="400" align="center" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->
                        <table class="content" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:400px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;color:#444;line-height: 1.43">
                            <tr>
                                <td align="left" valign="top">
                                    <div style="border:1px solid #999;background-color:#FFF">
                                        <div style="background:#666;border:1px solid #666;color:#FFF;font-size:20px;line-height:42px;height:42px;text-align:center">
                                            {{ Config::get('app.name') }}
                                        </div>
                                        <div class="panel-body" style="padding:15px 30px 10px;border-bottom:1px solid #DDD">
                                            @yield('content')
                                        </div>
                                        @if (trim($__env->yieldContent('footer')))
                                            <div style="border-top:1px solid #FFF;padding: 10px;background-color: #fcfcfc;border-bottom-right-radius: 3px;border-bottom-left-radius: 3px">
                                                @yield('footer')
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!--End New Content Block Wrapper Row-->
</table>
</body>
</html>
