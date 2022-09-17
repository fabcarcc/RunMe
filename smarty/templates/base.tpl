<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Fabrizio Carusi">
    <title>RunMe. - Esegui i tuoi script dal web</title>

    <link href="./Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./Assets/css/runme.css" rel="stylesheet">
</head>

<body>
<main>
    <div class="container">

        <nav class="navbar navbar-expand-lg bg-light rounded" aria-label="Main Navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="./Assets/img/running_red.png" alt="Logo" height="30" class="d-inline-block align-text-top">
                    Run<i>Me</i><span class="text-danger"><strong>.</strong></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars01" aria-controls="navbars01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbars01">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">

                            {if !isset($user)}
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Login</a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-login">

                                    <form class="px-4 py-3 needs-validation" novalidate>
                                        <div class="mb-3">
                                            <label for="DropdownFormUsername" class="form-label">Username:</label>
                                            <input type="text" class="form-control" id="DropdownFormUsername"
                                                   placeholder="Username" required>
                                            <div class="invalid-feedback">
                                                Campo richiesto!
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="DropdownFormPassword" class="form-label">Password:</label>
                                            <input type="password" class="form-control" id="DropdownFormPassword" placeholder="Password" required>
                                            <div class="invalid-feedback">
                                                Campo Richiesto!
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </form>
                                </div>
                            {else}
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"><strong>{$user->getUsername()}</strong></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    {if $user->getAdmin()}
                                        <li><a class="dropdown-item" href="#">Gestisci Utenti</a></li>
                                        <li><a class="dropdown-item" href="#">Gestisci Permessi</a></li>
                                        <li><a class="dropdown-item" href="#">Visualizza Log</a></li>
                                    {else}
                                        <li><a class="dropdown-item" href="#">Visualizza Log</a></li>
                                    {/if}
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            {/if}
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div>
            {block name=body}{/block}
        </div>

    </div>
</main>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {

                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<script src="./Assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>