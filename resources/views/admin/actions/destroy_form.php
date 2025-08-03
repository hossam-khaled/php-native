<?php if ( !empty($url) ):
    $rand = md5(rand(000, 999));
?>

    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#destroyForm{{$rand}}"><i class="fa-regular fa-trash-can"></i></a>

    <!-- Modal -->
    <div class="modal fade" id="destroyForm{{$rand}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{$url}}">
                        <input type="hidden" name="_method" value="post">
                        <div class="alert alert-danger">
                            {{ lang('admin.delete_massage') }}
                        </div>

                        <button type="submet" class="btn btn-danger" data-bs-dismiss="modal"> {{ lang('admin.delete')}} </button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> {{ lang('admin.cancel')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>