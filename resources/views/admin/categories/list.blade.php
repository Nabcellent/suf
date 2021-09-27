<?php
use App\Models\Category;
?>
@extends('admin.layouts.app')
@section('content')

    <div id="categories" class="container-fluid">
        <div class="row">
            <div class="col p-0">
                <div class="row">
                    <div class="col-9">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Sections</h6>
                                <button class="btn btn-info" data-toggle="modal" data-target="#add_section">Add Section</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="sections_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">No of Sub-Categories</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($sections as $section)
                                            <tr>
                                                <td></td>
                                                <td>{{ $section->title }}</td>
                                                <td><?= Category::where('section_id', $section->id)->count() ?></td>
                                                <td class="text-nowrap">{{ date('M d, Y', strtotime($section->created_at)) }}</td>
                                                <td class="action">
                                                    @if($section->status)
                                                        <a class="update_status" data-id="{{ $section->id }}" data-model="Category" title="Update Status"
                                                           style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                    @else
                                                        <a class="update_status" data-id="{{ $section->id }}" data-model="Category" title="Update Status"
                                                           style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    @endif
                                                    <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-success"></i></a>
                                                    <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $section->id }}" data-model="Category">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="{{ route('admin.create.product') }}" class="list-group-item list-group-item-action">
                                        Create Product
                                    </a>
                                    <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Products<span class="badge badge-primary badge-pill">14</span>
                                    </a>
                                    <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Orders<span class="badge badge-primary badge-pill">7</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Quantity Sold<span class="badge badge-primary badge-pill">{{ tableCount()['qtySold'] }}</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Remaining stock<span class="badge badge-primary badge-pill">37</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col">
                        <div class="card bg-dark">
                            <div class="card-header text-center"><a href="{{ route('admin.category') }}" class="btn btn-info">Create Category</a></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Categories</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="categories_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($categories as $category)
                                            <tr>
                                                <td></td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->section->title }}</td>
                                                <td>{{ $category->discount }}%</td>
                                                <td class="action">
                                                    @if($category->status)
                                                        <a class="update_status" data-id="{{ $category->id }}" data-model="Category" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                    @else
                                                        <a class="update_status" data-id="{{ $category->id }}" data-model="Category" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    @endif
                                                    <a href="{{ route('admin.category', ['id' => $category->id]) }}" class="ml-3" title="Modify">
                                                        <i class="fas fa-pen text-success"></i>
                                                    </a>
                                                    <a href="#" class="ml-3 delete-from-table" data-id="{{ $category->id }}" data-model="Category" title="Remove">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Sub-Categories</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="sub_categories_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Sub-Category</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($subCategories as $subCategory)
                                            <tr>
                                                <td></td>
                                                <td>{{ $subCategory->title }}</td>
                                                <td>{{ $subCategory->category->title }}</td>
                                                <td>{{ $subCategory->category->section->title }}</td>
                                                <td>{{ $subCategory->discount }}%</td>
                                                <td class="action">
                                                    @if($subCategory->status)
                                                        <a class="update_status" data-id="{{ $subCategory->id }}" data-model="Category" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                    @else
                                                        <a class="update_status" data-id="{{ $subCategory->id }}" data-model="Category" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                     @endif
                                                    <a href="{{ route('admin.category', ['id' => $subCategory->id]) }}" class="ml-3 update_sub_category" title="Modify">
                                                        <i class="fas fa-pen text-success"></i>
                                                    </a>
                                                    <a href="#" class="ml-3 delete-from-table" data-id="{{ $subCategory->id }}" data-model="Category" title="Remove">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.categories.modals')
@endsection
