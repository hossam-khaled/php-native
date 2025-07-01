<?php

/**
 * Insert Data in Database
 * @param string $table
 * @param array $data
 * @return array as assoc
 */
if( !function_exists("db_create") ){
    function db_create($table ,array $data):array {

        $sql = "INSERT INTO " . $table;
        $columns = '';
        $values = '';
        foreach($data as $key => $value) {
            $columns .=  $key .',';
            $values .= " '{$value}',";
        }
        $columns = rtrim($columns,',');
        $values = rtrim($values,',');
        $sql .= " ({$columns}) VALUES ({$values})";
        // echo $sql;
        // die();
        $query = mysqli_query($GLOBALS["connect"],$sql);

        $id = mysqli_insert_id($GLOBALS["connect"]);
        $first = mysqli_query($GLOBALS["connect"], "SELECT * FROM $table WHERE id=$id");

        $data = mysqli_fetch_assoc($first);
        $GLOBALS["query"] = $query;
        
        return $data;
    }
}


/**
 * UPDATE Data in Database
 * @param array $date
 * @param string $table
 * @param int $id
 * @return array as assoc
 */
if( !function_exists("db_update") ){
    function db_update(string $table ,array $data ,int $id):array {

        $sql = "UPDATE " . $table ." set ";
        $columns_value = '';
        foreach($data as $key => $value) {
            $columns_value .=  $key . "='{$value}' ,";
        }
        $columns_value = rtrim($columns_value,',');
        // $values = rtrim($values,',');
        $sql .= $columns_value ." WHERE id=" .$id;
        // echo $sql;
        $query = mysqli_query($GLOBALS["connect"],$sql);
        
        // die();
        // $id = mysqli_insert_id($GLOBALS["connect"]);
        $first = mysqli_query($GLOBALS["connect"], "SELECT * FROM $table WHERE id=$id");

        $data = mysqli_fetch_assoc($first);
        $GLOBALS["query"] = $query;

        return $data;
    }
}


/**
 * delete Data in Database
 * @param string $table
 * @param int $id
 */
if( !function_exists("db_delete") ){
    function db_delete(string $table ,int $id):mixed {

        $sql = "DELETE from $table WHERE id=$id";
        $query = mysqli_query($GLOBALS["connect"],$sql);
        $GLOBALS["query"] = $query;

        return $query;
    }
}

/**
 * find single row data from Database
 * @param string $table
 * @param int $id
 */
if( !function_exists("db_find") ){
    function db_find(string $table ,int $id):mixed {

        $sql = "SELECT * FROM $table WHERE id=$id";
        $query = mysqli_query($GLOBALS["connect"],$sql);
        $data = mysqli_fetch_assoc($query);
        $GLOBALS["query"] = $query;

        return $data;
    }
}


/**
 * search for a single row data from Database
 * @param string $table
 * @param int $id
 */
if( !function_exists("db_search") ){
    function db_search(string $table ,string $query_str):mixed {

        $sql = "SELECT * FROM $table $query_str";
        // echo $sql;
        $query = mysqli_query($GLOBALS["connect"],$sql);
        $data = mysqli_fetch_assoc($query);
        $GLOBALS["query"] = $query;

        return $data;
    }
}




/**
 * get for a multiple row data from Database
 * @param string $table
 * @param int $id
 */
if( !function_exists("db_get") ){
    function db_get(string $table ,string $query_str):mixed {

        $sql = "SELECT * FROM $table $query_str";
        // echo $sql;
        $query = mysqli_query($GLOBALS["connect"],$sql);
        $num = mysqli_num_rows($query);
        $GLOBALS["query"] = $query;

        return [
            'num'=> $num,
            'query' => $query,
        ];
    }
}



/**
 * paginate for a multiple row data from Database
 * @param string $table
 * @param int $id
 */
if( !function_exists("db_paginate") ){
    function db_paginate(string $table ,string $query_str , int $limt = 10, string $orderby= 'asc'):array 
    {
        if (isset($_GET['page']) && is_numeric( $_GET['page'] ) && $_GET['page'] > 0) {
            $current_page = $_GET['page'] -1;
        }else{
            $current_page = 0;
        }
        $query_count = mysqli_query($GLOBALS['connect'],"SELECT COUNT(ID) FROM $table $query_str");
        $count = mysqli_fetch_row($query_count);
        $total_rows = $count[0];
        $start = $current_page * $limt;
        $total_pages = ceil($total_rows / $limt);

        if ($current_page >= $total_pages) {
            $start = $total_pages+1;
        }
        // var_dump($count);
        $sql = "SELECT * FROM $table $query_str ORDER BY ID $orderby LIMIT $start,$limt";
        // echo $sql;
        $query = mysqli_query($GLOBALS["connect"],$sql);
        $num = mysqli_num_rows($query);
        $GLOBALS["query"] = $query;

        return [
            'num'=> $num,
            'query' => $query,
            'render' => render_paginate( $total_pages),
            'current_page' => $current_page,
            'limit'=> $limt,
        ];
    }
}

if (!function_exists('render_paginate')) {
    function render_paginate(int $total_page ) :string
    {
        $html = '<ul>';
        for ($i=1; $i <= $total_page ; $i++) { 
            $html .= '<li><a href="?page='. $i .'">'. $i .'</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }
}

