@extends('backEnd.layouts.master')
@section('title','Add Category')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('category.index')}}">Categories</a> <a href="{{route('category.create')}}" class="current">Add New Category</a> </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>Add New Category</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="{{route('category.store')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="control-group{{$errors->has('name')?' has-error':''}}">
                            <label class="control-label">Category Name :</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" value="{{old('name')}}" required>
                                <span class="text-danger" id="chCategory_name" style="color: red;">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Category Lavel :</label>
                            <div class="controls" style="width: 245px;">
                                <select name="parent_id" id="parent_id">
                                        @foreach($cate_levels as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            <?php
                                                if($key!=0){
                                                    $subCategory=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
                                                    if(count($subCategory)>0){
                                                        foreach ($subCategory as $subCate){
                                                            echo '<option value="'.$subCate->id.'">&nbsp;&nbsp;--'.$subCate->name.'</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Description :</label>
                            <div class="controls">
                                <textarea name="description" id="description" rows="3">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="control-group{{$errors->has('url')?' has-error':''}}">
                            <label class="control-label">URL (Start with http://) :</label>
                            <div class="controls">
                                <input type="text" name="url" id="url">
                                <span class="text-danger">{{$errors->first('url')}}</span>
                            </div>
                        </div>
                        <div class="control-group{{$errors->has('status')?' has-error':''}}">
                            <label class="control-label">Enable :</label>
                            <div class="controls">
                                <input type="checkbox" name="status" id="status" value="1">
                                <span class="text-danger">{{$errors->first('status')}}</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="control-label"></label>
                            <div class="controls">
                                <input type="submit" value="Add New" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.custom.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.uniform.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/matrix.js') }}"></script>
    <script src="{{ asset('js/matrix.form_validation.js') }}"></script>
    <script src="{{ asset('js/matrix.tables.js') }}"></script>
    <script src="{{ asset('js/matrix.popover.js') }}"></script>
@endsection