<?php
$category = db_find('categories', request('id'));
view('front.layouts.header', ['title' => $category['name']]);
redirect_if(empty($category), url('/404'));


$news =  db_paginate('news', "where category_id = {$category['id']}", 10);
// var_dump($news);
?>


<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
    <div class="col-lg-6 px-0">
        <h1 class="display-4 fst-italic">
            <?= $category['name'] ?>
        </h1>
        <p class="lead my-3">
            <?= $category['description'] ?>
        </p>
    </div>
</div>


<div class="row mb-2">
    <?php while ($news_item = mysqli_fetch_assoc($news['query'])) : ?>
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                    <h3 class="mb-0"><?= $news_item['title'] ?></h3>
                    <div class="mb-1 text-body-secondary"><?= $news_item['created_at'] ?></div>
                    <p class="card-text mb-auto">
                        <?= $news_item['description'] ?>
                    </p>
                    <a href="{{ url('news?id=' . $news_item['id']) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                        {{ lang('main.read_more')}}
                        <svg class="bi" aria-hidden="true">
                            <use xlink:href="#chevron-right"></use>
                        </svg>
                    </a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <?php
                    if (!empty($news_item['image'])){
                        $image = storage_url($news_item['image']);
                    }elseif(!empty($category['icon'])){
                        $image = storage_url($category['icon']);
                    }else{
                        $image = url('assets/images/image.png');
                    }
                    ?>  

                    <img src="{{$image}}" class="bd-placeholder-img"  style="width:200px; height:250px; object-fit:cover;" />
            
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <!-- <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
                <h3 class="mb-0">Post title</h3>
                <div class="mb-1 text-body-secondary">Nov 11</div>
                <p class="mb-auto">
                    This is a wider card with supporting text below as a natural
                    lead-in to additional content.
                </p>
                <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                    Continue reading
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#chevron-right"></use>
                    </svg>
                </a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img" height="250"
                    preserveAspectRatio="xMidYMid slice" role="img" width="200" xmlns="http://www.w3.org/2000/svg">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c"></rect>
                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>
            </div>
        </div>
    </div> -->
</div>


<?php
view('front.layouts.footer');
?>