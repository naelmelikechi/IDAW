<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center">Connexion</h1>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">Login</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#loginForm").on("submit", function (event) {
                event.preventDefault();
                const username = $("#username").val();
                const password = $("#password").val();

                $.ajax({
                    url: '../backend/login.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: username,
                        password: password
                    },
                    success: function (response) {
                        if (response.success) {
                            window.location.href = 'index.php';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('Erreur lors de la connexion. Veuillez réessayer.');
                    }
                });
            });
        });
    </script>
</body>
</html>