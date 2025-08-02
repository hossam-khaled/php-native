<?php
view('admin.layouts.header', ['title' => lang('admin.categories') . ' - ' . lang('admin.edit')]);
// var_dump(mysqli_fetch_assoc($categories['query']));
// die;
$category = db_find('categories', request('id'));
redirect_if(empty($category), aurl('categories'));
$icon_url = is_null($category['icon']) ? '' : $category['icon'];

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
            {{lang('cat.edit') . ' - ' . request('id')}}
            <a href="{{aurl('categories')}}" class="btn btn-info">{{lang('admin.categories')}}</a>
        </h1>
    </div>
    <form action="{{aurl('categories/edit?id=' . $category['id']) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="mb-3">
            <label for="name" class="form-label">{{lang('cat.name')}}</label>
            <input type="text" class="form-control <?= !empty($name) ? 'is-invalid' : '' ?>"
                value="<?= $category['name'] ?>" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">{{lang('cat.icon')}}</label>
            <input type="file" class="form-control <?= !empty($icon) ? 'is-invalid' : '' ?>" value="" id="icon"
                name="icon">
        </div>
        <?php if (!empty($icon_url)) : ?>
            <div class="mb-3">
                <label for="icon" class="form-label">{{lang('cat.icon')}}</label>
                <img src="{{ storage_url( $icon_url ) }}" alt="{{$category['name']}}"
                    srcset="{{ storage_url( $icon_url ) }}" data-bs-toggle="modal" data-bs-target="#showImage" width="150px"
                    height="100px">


                <!-- Modal -->
                <div class="modal fade" id="showImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img src="{{ storage_url( $icon_url ) }}" alt="{{$category['name']}}"
                                    srcset="{{ storage_url( $icon_url ) }}" data-bs-toggle="modal"
                                    data-bs-target="#showImage" width="100%" height="80%">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="description" class="form-label">{{lang('cat.description')}}</label>
            <textarea class="form-control <?= !empty($description) ? 'is-invalid' : '' ?>" id="description"
                name="description" rows="3"><?= $category['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{lang('admin.save')}}</button>
    </form>
</main>

<?php
view('admin.layouts.footer');
