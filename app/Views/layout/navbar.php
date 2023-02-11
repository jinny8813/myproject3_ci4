<header>
  <nav class="navbar fixed-top navbar-expand-lg bg_dark">
      <div class="img_h">
        <a class="navbar-brand p-3" href="<?php echo site_url('User') ?>" style="color:white"
          ><img src="<?= base_url('../../public/assets/images/icon.png') ?>" class="h-100 px-2" />GoVoc
        </a>
      </div>

      <button class="navbar-toggler p-3" style="border: none;" data-bs-toggle="collapse" data-bs-target="#navbar">
        <i class="fas fa-bars" style="color:white"></i>
      </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbar">
      <ul class="navbar-nav">
        <li class="nav-item ">
        <a class="nav-link p-3" href="<?php echo site_url('User/bloghome') ?>">雜學探險徑</a>
        </li>
        <li class="nav-item ">
        <a class="nav-link p-3" href="<?php echo site_url('User/source') ?>">補給充電站</a>
        </li>
        <li class="nav-item ">
        <a class="nav-link p-3" href="<?php echo site_url('User/board') ?>">嶼之公告欄</a>
        </li>
        <li class="nav-item ">
        <a class="nav-link p-3" href="<?= isset($nickname)? base_url('User/personal'):base_url('User/login')?>"><?= isset($nickname)? '我的筆記本':'登入與註冊'?></a>
        </li>
      </ul>
    </div>
  </nav>
    <div>
      <br>
    </div>
</header>