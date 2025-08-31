<?php
view('admin.layouts.header', ['title' => lang('cat.create')]);
// var_dump(mysqli_fetch_assoc($categories['query']));
// die;
?>
@php
// var_dump(any_errors());
//echo get_error();'
$name = get_error('name');
$email = get_error('email');
$mobile = get_error('mobile');
$user_type = get_error('user_type');
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
            {{lang('user.create')}}
            <a href="{{aurl('users')}}" class="btn btn-info">{{lang('admin.users')}}</a>
        </h1>
    </div>
    <form action="{{aurl('users/create')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="mb-3">
            <label for="name" class="form-label">{{lang('user.name')}}</label>
            <input type="text" class="form-control <?= !empty($name) ? 'is-invalid' : '' ?>" value="<?= old('name') ?>"
                id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{lang('user.email')}}</label>
            <input type="email" class="form-control <?= !empty($email) ? 'is-invalid' : '' ?>"
                value="<?= old('email') ?>" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">{{lang('user.mobile')}}</label>
            <input type="number" class="form-control <?= !empty($mobile) ? 'is-invalid' : '' ?>"
                value="<?= old('mobile') ?>" id="mobile" name="mobile">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{lang('user.password')}}</label>
            <input type="password" class="form-control <?= !empty($password) ? 'is-invalid' : '' ?>" value=""
                id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="user_type" class="form-label">{{lang('user.user_type')}}</label>
            <select class="form-select <?= !empty($user_type) ? 'is-invalid' : '' ?>" name="user_type" id="user_type">
                <option value="" disabled selected>{{lang('user.select_user_type')}}</option>
                <option value="user" <?= old('user_type') == 'user' ? 'selected' : '' ?>>{{lang('user.user')}}</option>
                <option value="admin" <?= old('user_type') == 'admin' ? 'selected' : '' ?>>{{lang('user.admin')}}
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{lang('user.create')}}</button>
    </form>
</main>

<?php
view('admin.layouts.footer');
