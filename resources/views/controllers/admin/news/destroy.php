<?php

$news = db_find('news', request('id'));
redirect_if(empty($news), aurl('news'));
if(!empty($news['images'])) {
    delete_file($news['images']);
}


db_delete('news', request('id') );
session('success', lang('admin.deleted'));

redirect(aurl('news'));
