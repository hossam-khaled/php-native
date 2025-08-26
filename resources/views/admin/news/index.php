<?php
view('admin.layouts.header', ['title' => lang('admin.news')]);
$news_list = db_paginate('news', '', 10);
// var_dump(mysqli_fetch_assoc($news['query']));
// die;
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('admin.news')}}
            <a href="{{aurl('news/create')}}" class="btn btn-primary"><i
                    class="fa-solid fa-plus"></i>{{lang('cat.create')}}</a>
        </h1>
    </div>
    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">{{lang('news.id')}}</th>
                    <th scope="col">{{lang('news.title')}}</th>
                    <th scope="col">{{lang('news.user_id')}}</th>
                    <th scope="col">{{lang('news.category_id')}}</th>
                    <th scope="col">{{lang('news.description')}}</th>
                    <th scope="col">{{lang('news.image')}}</th>
                    <th scope="col">{{lang('admin.created_at')}}</th>
                    <th scope="col">{{lang('admin.updated_at')}}</th>
                    <th scope="col">{{lang('admin.action')}}</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($news = mysqli_fetch_assoc($news_list['query'])):
                    $image_url = is_null($news['image']) ? '' : $news['image'];
                ?>
                <tr>
                    <td>{{$news['id']}}</td>
                    <td>{{$news['title']}}</td>
                    <td>{{$news['user_id']}}</td>
                    <td>{{$news['category_id']}}</td>
                    <td>{{$news['description']}}</td>
                    <td>{{ image( storage_url( $image_url ) )}}</td>
                    <td>{{$news['created_at']}}</td>
                    <td>{{$news['updated_at']}}</td>
                    <td>
                        <a href="{{aurl('news/show?id='.$news['id'])}}" class="btn btn-sm btn-info"><i
                                class="fa-regular fa-eye"></i></a>
                        <a href="{{aurl('news/edit?id='.$news['id'])}}" class="btn btn-sm btn-primary"><i
                                class="fa-regular fa-pen-to-square"></i></a>
                        <!-- <a href="{{aurl('news/delete?id='.$news['id'])}}" class="btn btn-sm btn-danger"><i
                                    class="fa-regular fa-trash-can"></i></a> -->
                        {{ delete_record( aurl( 'news/delete?id='.$news['id'] ) ) }}
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    {{ $news_list['render'] }}
</main>
<?php view('admin.layouts.footer'); ?>