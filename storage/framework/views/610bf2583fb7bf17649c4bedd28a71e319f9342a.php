

<!--&&&===    CREATE BANNER    ===&&&-->

<div class="modal fade" id="add_banner_modal">
    <div class="modal-dialog">
        <div class="modal-content text-info overflow-auto">
            <form id="banner_form" enctype="multipart/form-data" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Create Banner</h4>
                    <button type="button" class="close text-info" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control crud_form" name="title" placeholder="Banner title" aria-label required>
                    </div>
                    <div class="form-group m-0">
                        <label>Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input form-control crud_form" id="image" name="image" required>
                            <label class="custom-file-label crud_form file">Choose an Image</label>
                            <small>Recommended size: <i>Width: 1170px, Height: 480px</i></small>
                        </div>
                        <img src="" alt="" class="img-fluid product_img" style="width: 7rem">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="slide_name">Link</label>
                            <input type="text" class="form-control crud_form" name="link" placeholder="Banner link" aria-label required>
                        </div>
                        <div class="form-group col">
                            <label for="slide_name">Alternate Text</label>
                            <input type="text" class="form-control crud_form" name="alt" placeholder="Banner alt" aria-label required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control crud_form" placeholder="Enter banner description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info submit">Insert</button>
                    <img class="d-none loader_gif" src="/images/loaders/Gear-0.2s-200px.gif" alt="loader.gif">
                </div>
            </form>
        </div>
    </div>
</div>


<!--&&&===    UPDATE BANNER    ===&&&-->

<div class="modal fade" id="update_banner_modal">
    <div class="modal-dialog">
        <div class="modal-content text-info overflow-auto">
            <form id="banner_details_form" action="/content/banners?_method=PUT" enctype="multipart/form-data" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Update Banner</h4>
                    <button type="button" class="close text-info" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="banner_details_form" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control crud_form" name="title" placeholder="Banner title" aria-label required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="slide_name">Link</label>
                                <input type="text" class="form-control crud_form" name="link" placeholder="Banner link" aria-label required>
                            </div>
                            <div class="form-group col">
                                <label for="slide_name">Alternate Text</label>
                                <input type="text" class="form-control crud_form" name="alt" placeholder="Banner alt" aria-label required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control crud_form" placeholder="Enter banner description">
                        </div>
                        <div class="form-group float-right">
                            <input type="hidden" id="banner_id" name="banner_id">
                            <button type="submit" class="btn btn-info submit">Update Details</button>
                            <img class="d-none loader_gif" src="/images/loaders/Gear-0.2s-200px.gif" alt="loader.gif">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Banner Image</h4>
                    </div>
                    <form id="banner_image_form" action="/content/banner-image?_method=PUT" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control crud_form" id="image" name="image" required>
                                <label class="custom-file-label crud_form file">Choose an Image</label>
                            </div>
                            <img src="" alt="" class="img-fluid product_img" style="width: 7rem">
                        </div>
                        <div class="form-group float-right">
                            <input type="hidden" id="banner_id" name="banner_id">
                            <input type="hidden" id="current_image" name="current_image">
                            <button type="submit" class="btn btn-info submit">Update Image</button>
                            <img class="d-none loader_gif" src="/images/loaders/Gear-0.2s-200px.gif" alt="loader.gif">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>





<!--    Start Edit modal    -->

<div class="modal fade" id="crud_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark overflow-auto" style="color: orange">
            <form id="img_box_form">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close text_orange" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="box_num">Box Number *</label>
                        <select name="box_num" id="box_num" class="form-control" required>
                            <option hidden value="">Select box Number *</option>
                            <option value="1">Box Number 1 </option>
                            <option value="2">Box Number 2 </option>
                            <option value="3">Box Number 3 </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="box_title">Box Title *</label>
                        <input type="text" id="box_title" name="box_title" class="form-control" placeholder="Enter box title *" required>
                    </div>
                    <div class="form-group">
                        <label for="box_desc">Box Description</label>
                        <textarea id="box_desc" name="box_desc" rows="3" cols="20" class="form-control" placeholder="Enter box description..."></textarea>
                    </div>
                    <div class="form-group">
                        <label> Box Image *</label>
                        <div class="input-group my-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control" id="box_image" name="box_image" aria-describedby="inputGroupFileAddon">
                                <label class="custom-file-label" for="box_image">Choose Image *</label>
                            </div>
                        </div>
                        <img src="" alt="" class="img-fluid box_img" style="width: 7rem">
                    </div>
                    <div class="form-group">
                        <label for="box_url">Box Url</label>
                        <input type="text" id="box_url" name="box_url" class="form-control" placeholder="Enter box url">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="img_box_id" name="img_box_id">
                    <button type="button" class="btn btn_outline_orange" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="img_box_crud" class="btn btn_orange submit"></button>
                    <img class="loader_gif" src="../../img/gif_loaders/Gear-0.2s-200px.gif" alt="loader.gif">
                </div>
            </form>
        </div>
    </div>
</div>
<!--    End Edit modal    -->

<!--    Start delete modal    -->

<div class="modal fade" id="del_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../../admin/index.php?boxes&del_id=" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Delete box</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Box?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger">Delete Box</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--    End Delete Modal    -->
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Pages/modals.blade.php ENDPATH**/ ?>