<?php

// var_dump(request('images'));



store_file(request('images'), 'images'. request('images')['name']);



