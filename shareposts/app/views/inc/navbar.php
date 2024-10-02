<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URLROOT ?>"><?= SITENAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URLROOT ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/pages/about">About</a>
                </li>                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/users/register">Register</a>
                </li>                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/users/login">Login</a>
                </li>
        </div>
    </div>
</nav>