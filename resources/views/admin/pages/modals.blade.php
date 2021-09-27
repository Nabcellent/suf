{{--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    BANNER MODELS    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%--}}

<!--&&&===    CREATE / UPDATE BANNER    ===&&&-->

<div class="modal fade" id="create_slider">
    <div class="modal-dialog">
        <div class="modal-content text-info overflow-auto">
            <form class="create_banner" action="{{ route('admin.banners') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create Banner</h4>
                    <button type="button" class="close text-info" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Banner title" aria-label required>
                    </div>
                    <div class="form-group m-0">
                        <label>Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input form-control" id="image" name="image" accept="image/png,image/jpg,image/jpeg">
                            <label class="custom-file-label">Choose an Image</label>
                            <small>Recommended size: <i>Width: 1170px, Height: 480px</i></small>
                        </div>
                        <img src="" alt="" class="img-fluid product_img" style="width: 7rem">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="slide_name">Link</label>
                            <input type="text" class="form-control" name="link" placeholder="Banner link" aria-label required>
                        </div>
                        <div class="form-group col">
                            <label for="slide_name">Alternate Text</label>
                            <input type="text" class="form-control" name="alt" placeholder="Banner alt" aria-label required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" rows="2" class="form-control" placeholder="Enter slider description..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="banner_id" name="banner_id">
                    <input type="hidden" name="type" value="Slider">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info submit">Insert</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    AD MODELS    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%--}}

<!--    Start Edit modal    -->

<div class="modal fade" id="create_ad_box">
    <div class="modal-dialog modal modal-dialog-centered">
        <div class="modal-content bg-dark overflow-auto text_orange">
            <form class="create_banner" action="{{ route('admin.banners') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close text_orange" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="box_title">Title *</label>
                        <input type="text" id="box_title" name="title" class="form-control" placeholder="Enter box title *" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="box_url">Url</label>
                            <input type="text" name="link" class="form-control" placeholder="Enter box url">
                        </div>
                        <div class="form-group col">
                            <label for="box_url">Alternate text</label>
                            <input type="text" name="alt" class="form-control" placeholder="Enter box url">
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Image *</label>
                        <div class="input-group my-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control" name="image" aria-describedby="inputGroupFileAddon">
                                <label class="custom-file-label" for="box_image">Choose Image *</label>
                            </div>
                        </div>
                        <img src="" alt="" class="img-fluid box_img" style="width: 7rem">
                    </div>
                    <div class="form-group">
                        <label for="box_desc">Description</label>
                        <textarea name="description" rows="3" cols="20" class="form-control" placeholder="Enter box description..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="banner_id" name="banner_id">
                    <input type="hidden" name="type" value="Box">
                    <button type="button" class="btn btn_outline_orange" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn_orange submit"></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--    End Edit modal    -->
