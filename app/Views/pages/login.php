<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
    <section class="bg_two">
        <div class="container p-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2 class="text-center mb-3">登入</h2>

                    <form method="POST" action="<?= base_url("User/doLogin")?>">
                    <div class="form-group row mb-3">
                <div class="col-4">
                  <label for="email" class="form-label"
                    >電子郵件:
                  </label>
                </div>
                <div class="col-8">
                  <input
                    type="email"
                    class="col-4 form-control"
                    id="email"
                    name="email" placeholder="請輸入電子郵件"
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <div class="col-4">
                  <label for="password" class="form-label"
                    >密碼:
                  </label>
                </div>
                <div class="col-8">
                  <input
                    type="password"
                    class="col-4 form-control"
                    id="password"
                    name="password" placeholder="請輸入密碼"
                  />
                </div>
              </div>
              <div class="row mb-3 justify-content-center">
              <button type="submit" name="submit" class="btn btn-primary col-2">送出</button>
              </div>
		        </form>
        
                <?php 
                if(isset($error_messages)){
                    echo '<div class="alert alert-danger">' . esc($error_messages) . '</div>';
                }        
                ?>
            <div class="text-center row justify-content-center py-5">
                <p class="text-center col-12">還沒有帳號嗎?現在就註冊一個吧!</p>
                <a href="<?php echo base_url('User/register') ?>" class="btn btn-primary col-2">註冊</a>
            </div>
        </div>
        </div>
        </div>
    </section>
<?= $this->endSection()?>