<?php
view('admin.layouts.header', ['title' => lang('admin.news')]);


/*
    JOIN categories ON news.category_id = categories.id 
    JOIN users ON news.user_id = users.id
    WHERE news.id=" . request('id'),
    '
    news.title,
    news.description, 
    news.content, 
    news.image, 
    news.category_id, 
    news.user_id, 
    categories.name as category_name, 
    users.name as user_name'
*/
$news_list = db_paginate('news', 'JOIN categories ON news.category_id = categories.id 
    JOIN users ON news.user_id = users.id
    ', 10, 'asc',  '
    news.id,
    news.title,
    news.description, 
    news.content, 
    news.image, 
    news.category_id, 
    news.user_id, 
    news.created_at, 
    news.updated_at,
    categories.name as category_name, 
    users.name as user_name');
// var_dump(mysqli_fetch_assoc($news['query']));
// die;
?>

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
                        <td><a href="{{aurl('users/show?id='.$news['user_id'])}}">{{$news['user_name']}}</a></td>
                        <td>
                            <a href="{{aurl('categories/show?id='.$news['category_id'])}}">{{$news['category_name']}}</a>
                        </td>
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
<?php view('admin.layouts.footer'); ?>