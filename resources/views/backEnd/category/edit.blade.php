@extends('backEnd.layouts.master')
@section('title','Edit Category')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('category.index')}}">Categories</a> <a href="#" class="current">Edit Category</a> </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{route('category.update',$edit_category->id)}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{method_field("PUT")}}
                            <div class="control-group{{$errors->has('name')?' has-error':''}}">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" value="{{$edit_category->name}}" required>
                                    <span class="text-danger" style="color: red;">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Category Lavel :</label>
                                <div class="controls" style="width: 245px;">
                                    <select name="parent_id" id="parent_id">
                                        {{--@foreach($cate_levels as $key=>$value)
                                            <option value="{{$key}}" {{($edit_category->parent_id==$key)?' selected':''}}>{{$value}}</option>
                                        @endforeach--}}

                                        @foreach($cate_levels as $key=>$value)
                                            <option value="{{$key}}"{{($edit_category->parent_id==$key)?' selected':''}}>{{$value}}</option>
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
                                    <textarea name="description" id="description" rows="3">{{$edit_category->description}}</textarea>
                                </div>
                            </div>
                            <div class="control-group{{$errors->has('url')?' has-error':''}}">
                                <label class="control-label">URL (Start with http://) :</label>
                                <div class="controls">
                                    <input type="text" name="url" id="url" value="{{$edit_category->url}}">
                                    <span class="text-danger">{{$errors->first('url')}}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enable :</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1" {{($edit_category->status==0)?'':'checked'}}>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="control-label"></label>
                                <div class="controls">
                                    <input type="submit" value="Update" class="btn btn-success">
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