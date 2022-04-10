<div class="left-sidebar">
    <?php
        $categories=DB::table('categories')->where([['status',1],['parent_id',0]])->get();
    ?>
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach($categories as $category)
            <?php
                $sub_categories=DB::table('categories')->select('id','name')->where([['parent_id',$category->id],['status',1]])->get();
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear{{$category->id}}">
                            @if(count($sub_categories)>0)
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            @endif
                        </a>
                            <a href="{{route('cats',$category->id)}}">{{$category->name}}</a>

                    </h4>
                </div>
                @if(count($sub_categories)>0)
                    <div id="sportswear{{$category->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($sub_categories as $sub_category)
                                    <li><a href="{{route('cats',$sub_category->id)}}">{{$sub_category->name}} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div><!--/category-products-->

</div>