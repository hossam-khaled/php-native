<?php
view('admin.layouts.header', ['title' => lang('admin.news') . '-' . lang('admin.show')]);
// var_dump(mysqli_fetch_assoc($news['query']));
// request('id')
$news = db_search(
    'news',
    "
    JOIN categories ON news.category_id = categories.id 
    JOIN users ON news.user_id = users.id
    WHERE news.id=" . request('id'),
    '
    news.title,
    news.description, 
    news.content, 
    news.image, 
    news.category_id, 
    news.user_id, 
    categories.name as category_name, 
    users.name as user_name'
);
// if (empty($news)) {
//     redirect(aurl('news'));
// }
redirect_if(empty($news), aurl('news'));
// var_dump($news);
$image_url = is_null($news['image']) ? '' : $news['image'];
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('admin.categories')}} - {{lang('admin.show')}} - {{ request('id') }}
        </h1>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">{{lang('news.title')}}</label>
        {{ $news['title']}}
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">{{lang('news.category_id')}}</label>
        {{ $news['category_name']}}
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">{{lang('news.user_id')}}</label>
        {{ $news['user_name']}}
    </div>
    <div class="mb-3">
        <label for="icon" class="form-label">{{lang('news.image')}}</label>
        {{ image( storage_url( $image_url ) )}}
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">{{lang('news.description')}}</label>
        {{ $news['description']}}
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">{{lang('news.content')}}</label>
        {{ $news['content']}}
    </div>
</main>

<?php
view('admin.layouts.footer');
