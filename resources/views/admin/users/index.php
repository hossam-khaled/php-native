<?php
view('admin.layouts.header', ['title' => lang('admin.users')]);
$users = db_paginate('users', '', 10);
// var_dump(mysqli_fetch_assoc($users['query']));
// die;
?>

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('admin.users')}}
            <a href="{{aurl('users/create')}}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                {{lang('user.create')}}</a>
        </h1>
    </div>
    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">{{lang('user.id')}}</th>
                    <th scope="col">{{lang('user.name')}}</th>
                    <th scope="col">{{lang('admin.email')}}</th>
                    <th scope="col">{{lang('user.mobile')}}</th>
                    <th scope="col">{{lang('user.user_type')}}</th>
                    <th scope="col">{{lang('admin.action')}}</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($users['query'])): ?>
                    <tr>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['mobile']}}</td>
                        <td>{{lang('user.'.$user['user_type'])}}</td>
                        <td>
                            <a href="{{aurl('users/show?id='.$user['id'])}}" class="btn btn-sm btn-info"><i
                                    class="fa-regular fa-eye"></i></a>
                            <a href="{{aurl('users/edit?id='.$user['id'])}}" class="btn btn-sm btn-primary"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                            <!-- <a href="{{aurl('users/delete?id='.$users['id'])}}" class="btn btn-sm btn-danger"><i
                                    class="fa-regular fa-trash-can"></i></a> -->
                            {{ delete_record( aurl( 'users/delete?id='.$user['id'] ) ) }}
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    {{ $users['render'] }}
<?php view('admin.layouts.footer'); ?>