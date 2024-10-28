<!DOCTYPE html>
<html>
<head>
    <title>Redefinição de Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }
        .email-header h1 {
            color: #4CAF50;
        }
        .email-content {
            padding: 20px 0;
        }
        .email-content p {
            margin: 10px 0;
        }
        .reset-button {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .email-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Redefinição de Senha</h1>
        </div>
        <div class="email-content">
            <p>Olá,</p>
            <p>Você solicitou uma redefinição de senha para sua conta. Para redefinir sua senha, clique no botão abaixo:</p>
            <p style="text-align: center; margin: 20px 0;">
                <a href="{{ $resetUrl }}" class="reset-button">Redefinir Senha</a>
            </p>
            <p>Se você não solicitou essa redefinição, ignore este e-mail. Sua senha não será alterada.</p>
        </div>
        <div class="email-footer">
            <p>Obrigado,<br/>Equipe de Suporte</p>
        </div>
    </div>
</body>
</html>
