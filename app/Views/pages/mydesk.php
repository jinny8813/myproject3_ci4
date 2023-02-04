<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
          <hr>
          <div class="">
            <a href="<?= base_url('Blog/createBlog')?>" class="btn btn-primary mx-3">建立書本</a>
            <a href="#" class="btn btn-primary mx-3 float-end">排序</a>
            <a href="#" class="btn btn-primary mx-3 float-end">排序</a>
          </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>