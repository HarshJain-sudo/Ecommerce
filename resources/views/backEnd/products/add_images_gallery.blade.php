@extends('backEnd.layouts.master')
@section('title','Add Images Gallery')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('product.index')}}">Products</a> <a href="#" class="current">Add Images Gallery</a> </div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-file"></i> </span>
                        <h5>Product : {{$product->p_name}}</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <ul class="recent-posts">
                            <li>
                                <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{url('products/small',$product->image)}}"> </div>
                                <div class="article-post">
                                    <span class="user-info">Product Code : <b>{{$product->p_code}}</b></span>
                                    <p>Product Color : <b>{{$product->p_color}}</b></p>
                                </div>
                            </li>
                            <li>
                                <form action="{{route('image-gallery.store')}}" method="post" role="form" enctype="multipart/form-data">
                                    <legend>Can Add Multi Images</legend>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <input type="hidden" name="products_id" value="{{$product->id}}">
                                        <input type="file" name="image[]" id="id_imageGallery" class="form-control" multiple="multiple" required>
                                        <span class="text-danger">{{$errors->first('image')}}</span>
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>

                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                        <h5>List Images Galleries</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                                @foreach($imageGalleries as $imageGallery)
                                    <tr>
                                        <td class="taskDesc" style="text-align: center;vertical-align: middle;">{{$i++}}</td>
                                        <td class="taskOptions" style="text-align: center;vertical-align: middle;"><img src="{{url('products/small',$imageGallery->image)}}" class="img-responsive" alt="Image" width="60"></td>
                                        <td style="text-align: center;vertical-align: middle;"><a href="javascript:" rel="{{$imageGallery->id}}" rel1="delete-imageGallery" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('js/jquery.toggle.buttons.js')}}"></script>
    <script src="{{asset('js/masked.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.form_common.js')}}"></script>
    <script src="{{asset('js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-wysihtml5.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(".deleteRecord").click(function () {
            var id=$(this).attr('rel');
            var deleteFunction=$(this).attr('rel1');
            swal({
                title:'Are you sure?',
                text:"You won't be able to revert this!",
                type:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes, delete it!',
                cancelButtonText:'No, cancel!',
                confirmButtonClass:'btn btn-success',
                cancelButtonClass:'btn btn-danger',
                buttonsStyling:false,
                reverseButtons:true
            },function () {
                window.location.href="/admin/"+deleteFunction+"/"+id;
            });
        });
    </script>
@endsection