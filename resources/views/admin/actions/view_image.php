<?php if(!empty($image)): 
    $rand =md5( rand(000, 999) );
    ?>


<img src="{{ $image }}" alt="{{$category['name']}}" srcset="{{ $image }}"
    data-bs-toggle="modal" data-bs-target="#showImage{{$rand}}" width="100px" height="80px">


<!-- Modal -->
<div class="modal fade" id="showImage{{$rand}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ $image }}" alt="{{$category['name']}}"
                    srcset="{{ $image }}" data-bs-toggle="modal" data-bs-target="#showImage"
                    width="100%" height="80%">
            </div>
        </div>
    </div>
</div>

<?php endif; ?>