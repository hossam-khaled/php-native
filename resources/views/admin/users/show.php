<?php
view('admin.layouts.header', ['title' => lang('admin.users') . '-' . lang('admin.show')]);
// var_dump(mysqli_fetch_assoc($users['query']));
// die;
$users = db_find('users', request('id'));

redirect_if(empty($users), aurl('users'));
// var_dump($users);
?>

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('admin.users')}} - {{lang('admin.show')}} - {{ request('id') }}
        </h1>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">{{lang('user.name')}}</label>
        {{ $users['name']}}
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">{{lang('user.email')}}</label>

        {{ $users['email']}}


    </div>
    <div class="mb-3">
        <label for="user_type" class="form-label">{{lang('user.user_type')}}</label>
        {{lang('user.'.$users['user_type'])}}
    </div>

<?php
view('admin.layouts.footer');
