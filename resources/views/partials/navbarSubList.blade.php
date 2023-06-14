<ul>
  @foreach($subcategories as $subcategory)
    @if(count($subcategory->subcategory))
      @if($subcategory->view_subcat =='1')
        <li class="drop-down"><a href="{{url('category_show/'.$subcategory->sefriendly)}}">{{$subcategory->category_name}}</a>
            @include('partials.navbarSubList',['subcategories' => $subcategory->subcategory])
        </li>
      @endif
      @else
        @if($subcategory->view_subcat =='1')
          <li><a href="{{url('category_show/'.$subcategory->sefriendly)}}">{{$subcategory->category_name}}</a></li>
        @endif
      @endif
    </li>
  @endforeach
</ul>