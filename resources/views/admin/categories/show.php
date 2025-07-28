<?php
view('admin.layouts.header', ['title' => lang('admin.show')]);
// var_dump(mysqli_fetch_assoc($categories['query']));
// die;
$category = db_find('categories', request('id'));
if (empty($category)) {
    redirect(aurl('categories'));
}
// var_dump($category);
$icon_url = is_null($category['icon']) ? '' : $category['icon'];
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

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
        <img src="{{ storage_url( $icon_url ) }}" alt="{{$category['name']}}" srcset="{{ storage_url( $icon_url ) }}" data-bs-toggle="modal" data-bs-target="#showImage" width="150px" height="100px">


        <!-- Modal -->
        <div class="modal fade" id="showImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="{{ storage_url( $icon_url ) }}" alt="{{$category['name']}}" srcset="{{ storage_url( $icon_url ) }}" data-bs-toggle="modal" data-bs-target="#showImage" width="100%" height="80%">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="mb-3">
        <label for="description" class="form-label">{{lang('cat.description')}}</label>
        {{ $category['description']}}
    </div>
</main>

<?php
view('admin.layouts.footer');
