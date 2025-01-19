<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin/auth.css">
</head>

<body>
    <fieldset>
        <legend>Авторизация</legend>
        <form action="/auth" method="POST">
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Войти">

            <?php if (isset($error)): ?>
                <div style="color: red; margin-top: 10px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
        </form>
        <div style="margin-top: 10px">
            <script src="https://unpkg.com/@vkid/sdk@<3.0.0/dist-sdk/umd/index.js"></script>
            <script type="text/javascript">
                if ('VKIDSDK' in window) {
                    const VKID = window.VKIDSDK;

                    VKID.Config.init({
                        app: 52877591,
                        redirectUrl: 'http://localhost/admin',
                        responseMode: VKID.ConfigResponseMode.Callback,
                        source: VKID.ConfigSource.LOWCODE,
                        scope: '', // Заполните нужными доступами по необходимости
                    });

                    const oAuth = new VKID.OAuthList();

                    oAuth.render({
                            container: document.currentScript.parentElement,
                            oauthList: [
                                'vkid'
                            ]
                        })
                        .on(VKID.WidgetEvents.ERROR, vkidOnError)
                        .on(VKID.OAuthListInternalEvents.LOGIN_SUCCESS, function(payload) {
                            const code = payload.code;
                            const deviceId = payload.device_id;

                            VKID.Auth.exchangeCode(code, deviceId)
                                .then(vkidOnSuccess)
                                .catch(vkidOnError);
                        });

                    function vkidOnSuccess(data) {
                        fetch('/auth/vk', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify(data)
                            })
                            .then(response => response.json())
                            .then(result => {
                                if (result.success) {
                                    window.location.href = '/admin';
                                } else {
                                    alert(result.message);
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка:', error);
                            });
                    }

                    function vkidOnError(error) {
                        console.error('Ошибка авторизации:', error);
                    }
                }
            </script>
        </div>
    </fieldset>
</body>

</html>