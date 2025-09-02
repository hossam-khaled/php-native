<?php
view('admin.layouts.header', ['title' => lang('admin.categories') . '-' . lang('admin.show')]);
// var_dump(mysqli_fetch_assoc($categories['query']));
// die;
$category = db_find('categories', request('id'));
// if (empty($category)) {
//     redirect(aurl('categories'));
// }
redirect_if(empty($category), aurl('categories'));
// var_dump($category);
$icon_url = is_null($category['icon']) ? '' : $category['icon'];
?>

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('admin.categories')}} - {{lang('admin.show')}} - {{ request('id') }}
        </h1>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">{{lang('cat.name')}}</label>
        {{ $category['name']}}
    </div>
    <div class="mb-3">
        <label for="icon" class="form-label">{{lang('cat.icon')}}</label>

        {{ image( storage_url( $icon_url ) )}}


    </div>
    <div class="mb-3">
        <label for="description" class="form-label">{{lang('cat.description')}}</label>
        {{ $category['description']}}
    </div>

<?php
view('admin.layouts.footer');
