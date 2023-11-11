
<?php 

$logo = get_field('logo', 'option');
$logo_url = $logo['url'];
$siteURL = get_site_url(); ?>

<style>
    body { font-family: system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Ubuntu, \"Helvetica Neue\", sans-serif; background-color: #3f2560 !important; margin: 0; padding: 0 24px; }
    .logo-container { text-align: center; padding-top: 60px; margin-bottom: 30px; }
    .logo { width: 230px; height: 140px; object-fit: contain;}
    .email-container { max-width: 550px; margin: 0 auto; padding: 20px; border-radius: 10px; color: #3F2460; background-color: #e9e6f1; }
    .email-container > p {text-align: center;font-size: 20px; font-weight: 300; margin-bottom: 0px:}
    .btn { background-color: #3f2560; color: #e9e6f1;padding: 12px 24px;text-decoration: none;text-transform: uppercase;font-weight: bold;border-radius: 6px;margin: 30px auto 15px;display: block; text-align: center;}
    small {text-align: center;display: block;}
    p.signature { margin-bottom: 0px; text-align: center; margin-top: 20px; border-top: 1px solid #3f2560; padding-top: 20px;font-size: 16px; font-weight: 400; }"
</style>


<div class='logo-container'>
    <a href='<?php echo $siteURL; ?>' target='_blank'><img class='logo' src='<?php echo $logo_url; ?>' alt='{site_name}'></a>
</div>
<div class="email-container">
    <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Si ha realizado esta solicitud, haga clic en el siguiente enlace para cambiar tu contraseña:</p>
    <a class="btn" href="{password_reset_link}">Restablecer contraseña</a>
    <small>Si no ha realizado esta solicitud, ignore este correo electrónico</small>
    <p class="signature">Este es un mensaje automático, por favor no responder.</p>
</div>
