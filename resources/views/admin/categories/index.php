<?php
view('admin.layouts.header', ['title' => lang('admin.categories')]);
$categories = db_paginate('categories', '', 10);
// var_dump(mysqli_fetch_assoc($categories['query']));
// die;
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('admin.categories')}}
            <a href="{{aurl('categories/create')}}" class="btn btn-primary">{{lang('cat.create')}}</a>
        </h1>
    </div>
    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">{{lang('cat.id')}}</th>
                    <th scope="col">{{lang('cat.icon')}}</th>
                    <th scope="col">{{lang('cat.name')}}</th>
                    <th scope="col">{{lang('cat.description')}}</th>
                    <th scope="col">{{lang('admin.action')}}</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($category = mysqli_fetch_assoc($categories['query'])):
                    $icon_url = is_null($category['icon']) ? '' : $category['icon']; ?>
                    <tr>
                        <td>{{$category['id']}}</td>
                        <td><img src="{{ storage_url( $icon_url ) }}" alt="{{$category['name']}}"
                                srcset="{{ storage_url( $icon_url ) }}" width="50px" height="25px"></td>
                        <td>{{$category['name']}}</td>
                        <td>{{$category['description']}}</td>
                        <td>
                            <a href="{{aurl('categories/show?id='.$category['id'])}}" class="btn btn-sm btn-info"><i
                                    class="fa-regular fa-eye"></i></a>
                            <a href="{{aurl('categories/edit?id='.$category['id'])}}" class="btn btn-sm btn-primary"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                            <a href="{{aurl('categories/delete?id='.$category['id'])}}" class="btn btn-sm btn-danger"><i
                                    class="fa-regular fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>


            </tbody>
        </table>
    </div>
</main>
<?php view('admin.layouts.footer'); ?>