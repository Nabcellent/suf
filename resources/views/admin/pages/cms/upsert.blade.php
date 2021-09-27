@extends('admin.layouts.app')
@once
    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('vendor/trix/trix.css') }}">
    @endpush
@endonce
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <form class="cms" action="{{ empty($cms) ? route('admin.cms.store') : route('admin.cms.update', ['id' => $cms->id]) }}" method="POST">
                        @csrf @isset($cms) @method('PUT') @endisset
                        <div class="modal-header d-flex align-items-center">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <a class="btn btn-outline-info" title="Back to list" href="{{ route('admin.cms.index') }}"><i class='bx bx-arrow-back'></i></a>
                            </h5>
                            <h5> {{ empty($cms) ? 'Create' : 'Update' }} CMS</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col">
                                    <label>Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $cms->title ?? '') }}" aria-label required
                                           autofocus>
                                </div>
                                <div class="form-group col">
                                    <label>Url *</label>
                                    <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $cms->url ?? '') }}" aria-label required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description *</label>
                                <input id="desc" value="{{ old('description', $cms->description ?? '') }}" type="hidden" name="description">
                                <trix-editor input="desc"></trix-editor>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Meta title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $cms->meta_title ?? '') }}"
                                           aria-label>
                                </div>
                                <div class="form-group col">
                                    <label>Meta keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $cms->meta_keywords ?? '') }}"
                                           aria-label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Meta description</label>
                                <input id="meta_desc" value="{{ old('meta_desc', $cms->meta_desc ?? '') }}" type="hidden" name="meta_desc">
                                <trix-editor input="meta_desc"></trix-editor>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary cms">{{ empty($cms) ? 'Create' : 'Update' }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.create-product') }}" class="list-group-item list-group-item-action">
                                Create Product
                            </a>
                            <a href="{{ route('admin.coupon') }}" class="list-group-item list-group-item-action">
                                Create Coupon
                            </a>
                            <a href="{{ route('admin.products') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                            <a href="{{ route('admin.orders') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Remaining stock<span class="badge badge-primary badge-pill">37</span>
                            </a>
                            <a href="{{ route('admin.categories') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Categories<span class="badge badge-primary badge-pill">{{ tableCount()['categories'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/trix/trix.js') }}"></script>
    <script>
        (function() {
            let HOST = "https://d13txem1unpe48.cloudfront.net/"

            addEventListener("trix-attachment-add", function(event) {
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment)
                }
            })

            function uploadFileAttachment(attachment) {
                uploadFile(attachment.file, setProgress, setAttributes)

                function setProgress(progress) {
                    attachment.setUploadProgress(progress)
                }

                function setAttributes(attributes) {
                    attachment.setAttributes(attributes)
                }
            }

            function uploadFile(file, progressCallback, successCallback) {
                let key = createStorageKey(file)
                let formData = createFormData(key, file)
                let xhr = new XMLHttpRequest()

                xhr.open("POST", HOST, true)

                xhr.upload.addEventListener("progress", function(event) {
                    let progress = event.loaded / event.total * 100
                    progressCallback(progress)
                })

                xhr.addEventListener("load", function() {
                    if (xhr.status === 204) {
                        let attributes = {
                            url: HOST + key,
                            href: HOST + key + "?content-disposition=attachment"
                        }
                        successCallback(attributes)
                    }
                })

                xhr.send(formData)
            }

            function createStorageKey(file) {
                let date = new Date()
                let day = date.toISOString().slice(0,10)
                let name = date.getTime() + "-" + file.name
                return [ "tmp", day, name ].join("/")
            }

            function createFormData(key, file) {
                let data = new FormData()
                data.append("key", key)
                data.append("Content-Type", file.type)
                data.append("file", file)
                return data
            }
        })();
    </script>
@endsection
