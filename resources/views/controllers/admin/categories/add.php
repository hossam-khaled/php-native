<?php
$data = validation(
    [
        'name' => 'required|string',
        'icon' => 'required',
        'description' => 'required|string',
    ],
    [
        'name' => lang('cat.name'),
        'icon' => lang('cat.icon'),
        'description' => lang('cat.description'),
    ],
);
