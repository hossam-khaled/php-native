<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= url('/') ?>">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= url('/') ?>"><?= lang('main.home') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= url('users') ?>"><?= lang('main.users') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= url('login') ?>"><?= lang('main.login') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= url('register') ?>"><?= lang('main.register') ?></a>
        </li>

        <li class="nav-item">
          <?php if (session('locale') == 'ar') { ?>
            <a class="nav-link" href="<?= url('lang?lang=en') ?>"><?= lang('main.english') ?></a>
          <?php } else { ?>
            <a class="nav-link" href="<?= url('lang?lang=ar') ?>"><?= lang('main.arabic') ?></a>
          <?php } ?>
        </li>
        
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>