<?php
view('admin.layouts.header', ['title' => lang('admin.create')]);
// var_dump(mysqli_fetch_assoc($categories['query']));
// die;
?>
@php
// var_dump(any_errors());
//echo get_error();'
$name = get_error('name');
$icon = get_error('icon');
$description = get_error('description');
@endphp
<?php
// var_dump(parse_url(url(ADMIN)));
// die;
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    @if( any_errors() )
    <div class="alert alert-danger" role="alert">
        <ol>
            @foreach( all_errors() as $error)
            <li> @php echo $error @endphp </li>
            @endforeach
        </ol>
    </div>
    @php
    end_errors();
    @endphp
    @endif

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('admin.create')}}
            <a href="{{aurl('news')}}" class="btn btn-info">{{lang('admin.news')}}</a>
        </h1>
    </div>
    <form action="{{aurl('news/create')}}" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="mb-3">
            <label for="title" class="form-label">{{lang('news.title')}}</label>
            <input type="text" class="form-control <?= !empty($title) ? 'is-invalid' : '' ?>"
                value="<?= old('title') ?>" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">{{lang('news.image')}}</label>
            <input type="file" class="form-control <?= !empty($image) ? 'is-invalid' : '' ?>"
                value="<?= old('image') ?>" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">{{lang('news.description')}}</label>
            <textarea class="form-control <?= !empty($description) ? 'is-invalid' : '' ?>" id="description"
                name="description" rows="3"><?= old('description') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">{{lang('news.content')}}</label>
            <textarea class="form-control <?= !empty($content) ? 'is-invalid' : '' ?>" id="content"
                name="content" rows="3"><?= old('content') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{lang('news.create')}}</button>
    </form>
</main>

<?php
view('admin.layouts.footer');