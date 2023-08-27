        <div class="mega-category-menu">
            <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
            <ul class="sub-category">
                @foreach ($categories as $item)
                <li><a href="product-grids.html">{{ $item->name }}
                        @if ($item->children)
                        <i class="lni lni-chevron-right"></i>
                        @endif
                    </a>
                    @if ($item->children->count() > 0)
                    <ul class="inner-sub-category">
                        @foreach ($item->children as $child)
                        <li><a href="product-grids.html">{{ $child->name }}</a></li>
                        @endforeach

                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
