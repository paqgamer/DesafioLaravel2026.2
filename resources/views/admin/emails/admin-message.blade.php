<!DOCTYPE html>
<!-- ta indo pro log  essa merda, o envio ta pronto, pra receber abre o mail.google.com que deve funcionar
 depois tem que abrir o .env, colocar um  email  real, mas deve funcionar -->
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $messageSubject }}</title>
</head>
<!-- vou deixar assim mesmo,  nao vou criar outro arquivo css separado  agora, viva  o css inline -->
<body style="font-family: Arial, sans-serif; color: #111827; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; padding: 24px;">
        <h2 style="color: #111827;">{{ $messageSubject }}</h2>
        <div style="white-space: pre-line;">{{ $messageBody }}</div>
        <hr style="margin-top: 32px; border: none; border-top: 1px solid #e5e7eb;">
        <p style="font-size: 12px; color: #6b7280;">
            Mensagem enviada da equipe  do  De$af.io, volte sempre.
        </p>
    </div>
</body>
</html>