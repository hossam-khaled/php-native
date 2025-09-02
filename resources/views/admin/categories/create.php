<?php
view('admin.layouts.header', ['title' => lang('cat.create')]);

?>

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('cat.create')}}
            <a href="{{aurl('categories')}}" class="btn btn-info">{{lang('admin.categories')}}</a>
        </h1>
    </div>
    <form action="{{aurl('categories/create')}}" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="mb-3">
            <label for="name" class="form-label">{{lang('cat.name')}}</label>
            <input type="text" class="form-control <?= !empty(get_error('name')) ? 'is-invalid' : '' ?>"
                value="<?= old('name') ?>" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">{{lang('cat.icon')}}</label>
            <input type="file" class="form-control <?= !empty(get_error('icon')) ? 'is-invalid' : '' ?>"
                value="<?= old('icon') ?>" id="icon" name="icon">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">{{lang('cat.description')}}</label>
            <textarea class="form-control <?= !empty(get_error('description')) ? 'is-invalid' : '' ?>" id="description"
                name="description" rows="3"><?= old('description') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{lang('cat.create')}}</button>
    </form>

<?php
view('admin.layouts.footer');