<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva solicitud de Proyecto</title>
</head>

<body style="margin:0; padding:24px; background:#f5f7f3; font-family:sans-serif; font-size:14px; line-height:1.5;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">
        <tr>
            <td style="background:#111827;padding:20px 24px;">
                <h1 style="margin:0;font-size:20px;line-height:1.2;color:#d4ff00;">Nueva solicitud de Proyecto</h1>
                <p style="margin:8px 0 0;color:#d1d5db;font-size:14px;">Formulario enviado desde el sitio web.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:24px;">
                <p style="margin:0 0 12px;font-size:14px;"><strong>Nombre:</strong> {{ $data['name'] }}</p>
                <p style="margin:0 0 12px;font-size:14px;"><strong>Nombre:</strong> {{ $data['email'] }}</p>
                <p style="margin:0 0 12px;font-size:14px;"><strong>Telefono:</strong> {{ $data['phone'] }}</p>
                <p style="margin:0 0 12px;font-size:14px;"><strong>Compania:</strong> {{ $data['company'] }}</p>
                <p style="margin:0 0 12px;font-size:14px;"><strong>Servicios:</strong> {{ implode(', ', $data['services']) }}</p>
            </td>
        </tr>
    </table>
</body>

</html>