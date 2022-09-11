<p>&nbsp;</p>
<p>&nbsp;</p>
<!-- [if mso]>
  <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
  </xml>
  <style>
    table {border-collapse: collapse;}
    .spacer,.divider {mso-line-height-rule:exactly;}
    td,th,div,p,a {font-size: 13px; line-height: 22px;}
    td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family:"Segoe UI",Helvetica,Arial,sans-serif;}
  </style>
  <![endif]-->
<p>&nbsp;</p>
<div style="display: none; font-size: 0; line-height: 0;">
    <!-- Add your inbox preview text here -->
</div>
<table class="wrapper" role="presentation" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td class="px-sm-16" align="center" bgcolor="#EEEEEE">
                <table class="container" role="presentation" width="600" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="px-sm-8" align="left" bgcolor="#EEEEEE">
                                <div class="spacer line-height-sm-0 py-sm-8" style="line-height: 24px;">&zwnj;</div>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td class="col" align="center" width="100%"><a href="https://example.com">
                                                    <img src="https://avisosmendoza.com.ar/styleWeb/assets/logo_chico.png"
                                                        alt="Header Logo" width="43" height="61" /> </a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="spacer line-height-sm-0 py-sm-8" style="line-height: 24px;">&zwnj;</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table class="wrapper" style="height: 293px; width: 100%;" role="presentation" width="100%" cellspacing="0"
    cellpadding="0">
    <tbody>
        <tr style="height: 293px;">
            <td class="px-sm-16" style="height: 293px;" align="center" bgcolor="#EEEEEE">
                <table class="container" style="height: 289px;" role="presentation" width="600" cellspacing="0"
                    cellpadding="0">
                    <tbody>
                        <tr style="height: 289px;">
                            <td style="background: linear-gradient(to right, #00c6ff, #0072ff); height: 289px; width: 596px;"
                                bgcolor="#0072FF">
                                <!-- [if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;">
            <v:fill type="gradient" color="#0072FF" color2="#00C6FF" angle="90" />
            <v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
            <div><![endif]-->
                                <div class="spacer line-height-sm-0 py-sm-16" style="line-height: 32px;">&zwnj;</div>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td class="px-sm-16" style="padding: 0 96px;" align="center">
                                                <h1 class="webfont h1"
                                                    style="color: #ffffff; font-size: 36px; font-weight: 300; line-height: 100%; margin: 0 0 16px;">
                                                    Hola, {{ $user->name }}</h1>
                                                <p
                                                    style="color: #ffffff; font-size: 14px; line-height: 23px; font-weight: 300; margin: 0;">
                                                    En Avisos Mendoza nos comprometemos en publicitar de la mejor manera
                                                    a nuestros usuarios para que puedan llegar a m&aacute;s clientes
                                                    dentro de la provincia y que sus servicios sean visto por mas
                                                    potenciales clientes</p>
                                                <p
                                                    style="color: #ffffff; font-size: 14px; line-height: 23px; font-weight: 300; margin: 0;">
                                                    &nbsp;</p>
                                                <p
                                                    style="color: #ffffff; font-size: 14px; line-height: 23px; font-weight: 300; margin: 0;">
                                                    A continuaci&oacute;n te mostramos los servicios destacados en el
                                                    sitio</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="spacer line-height-sm-0 py-sm-16" style="line-height: 40px;">&zwnj;</div>
                                <!-- [if gte mso 9]></div></v:textbox></v:rect><![endif]-->
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
            </td>
        </tr>
    </tbody>
</table>
<table class="wrapper" style="height: 176px; width: 100%;" role="presentation" width="100%" cellspacing="0"
    cellpadding="0">
    <tbody>
        <tr style="height: 176px;">
            <td class="px-sm-16" style="height: 176px;" align="center" bgcolor="#EEEEEE">
                @foreach($services as $service)
                <table class="container" role="presentation" width="600" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="px-sm-8" style="padding: 0 24px;" align="left" bgcolor="#FFFFFF">
                                <table style="width: 100%;" role="presentation" width="100%" cellspacing="0"
                                    cellpadding="0">
                                    <tbody>
                                        <tr>
                                            @if ($service->photo)
                                            <td class="col col-sm-1 pb-sm-8" style="padding: 0px 8px; width: 23.7226%;"
                                                width="100"><img
                                                    src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                                                    alt="Product title" width="100" /></td>
                                            @else
                                            <td class="col col-sm-1 pb-sm-8" style="padding: 0px 8px; width: 23.7226%;"
                                                width="100"><img
                                                    src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                                    alt="Product title" width="100" /></td>
                                            @endif
                                            <td class="col col-sm-3 webfont"
                                                style="padding: 0px 8px; vertical-align: middle; width: 60.9489%;"
                                                width="284">
                                                <br>
                                                <br>
                                                <h3 style="font-size: 16px; margin: 0 0 8px;">{{ $service->title }}</h3>
                                                <p style="color: #999999; margin: 0;">{{ $service->description }}</p>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>
<table class="wrapper" role="presentation" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td class="px-sm-16" align="center" bgcolor="#EEEEEE">
                <table class="container" role="presentation" width="600" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="px-sm-8" style="padding: 0 24px;" bgcolor="#FFFFFF">
                                <div class="spacer line-height-sm-0 py-sm-8" style="line-height: 24px;">&zwnj;</div>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td class="col" style="padding: 0 8px;" align="center" width="100%">
                                                <div>&nbsp;</div>
                                                <div class="spacer" style="line-height: 12px;">&zwnj;</div>
                                                <p style="color: #888888; margin: 0;">Avisos Mendoza</p>
                                                <p class="links-inherit-color" style="color: #888888; margin: 0;">Las
                                                    Heras, Mendoza, Argentina</p>
                                                <div class="spacer line-height-sm-0 py-sm-8" style="line-height: 24px;">
                                                    &nbsp;</div>
                                                <div class="spacer" style="line-height: 16px;">&zwnj;</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="spacer line-height-sm-0 py-sm-8" style="line-height: 24px;">&zwnj;</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>