<?php
/*
'JOIN categories ON news.category_id = categories.id 
    JOIN users ON news.user_id = users.id
    ', 10, 'asc',  '
    news.id,
    news.title,
    news.description, 
    news.content, 
    news.image, 
    news.category_id, 
    news.user_id, 
    news.created_at, 
    news.updated_at,
    categories.name as category_name, 
    users.name as user_name'
*/
//request('id')
$news = db_search('news', "JOIN categories ON news.category_id = categories.id 
    JOIN users ON news.user_id = users.id
    WHERE news.id=" . request('id'), '
    news.title,
    news.description, 
    news.content, 
    news.image, 
    news.category_id, 
    news.user_id, 
    news.created_at, 
    news.updated_at,
    categories.name as category_name, 
    users.name as username');
view('front.layouts.header', ['title' => $news['title']]);
// redirect_if(empty($news), url('/404'));
//var_dump($news);

?>

<!-- <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
    <div class="col-lg-6 px-0">
        <h1 class="display-4 fst-italic">
            <?= $news['title'] ?>
        </h1>
        <p class="lead my-3">
            <?= $news['content'] ?>
        </p>
    </div>
</div> -->


<div class="row mb-2">
    <div class="col-md-12">
        <article class="blog-post">
            <h1 class="display-5 link-body-emphasis mb-1"> <?= $news['title'] ?></h1>
            <p class="blog-post-meta">
                <span>{{ $news['created_at'] }}</span> by <a href="#">{{ $news['username'] }}</a>
            </p>
            <hr>
            <div class="col-auto d-none d-lg-block">
                <?php
                if (!empty($news['image'])) {
                    $image = storage_url($news['image']);
                } else {
                    $image = url('assets/images/image.png');
                }
                ?>

                <img src="{{$image}}" class="bd-placeholder-img" style="width:100%; height:auto; object-fit:cover;" />

            </div>
            <p>
                <?= $news['content'] ?>
            </p>
        </article>
    </div>
</div>


<?php
view('front.layouts.footer');
?>