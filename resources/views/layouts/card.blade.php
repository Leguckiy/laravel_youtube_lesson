<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if ($product->isNew())
                <span class="badge rounded-pill bg-success">
                    @lang('main.properties.new')
                </span>
            @endif

            @if ($product->isRecommend())
                <span class="badge rounded-pill bg-warning">
                    @lang('main.properties.recommend')
                </span>
            @endif

            @if ($product->isHit())
                <span class="badge rounded-pill bg-danger">
                    @lang('main.properties.hit')
                </span>
            @endif
        </div>
        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->__('name') }}">
        <div class="caption">
            <h3>{{ $product->__('name') }}</h3>
            <p>{{ $product->price }}
                @lang('main.rub').
            </p>
            <p>
                <form action="{{ route('basket-add', $product->id) }}" method="post">
                    @if($product->isAvailable())
                        <button class="btn btn-primary" type="submit">
                            @lang('main.add_to_basket')
                        </button>
                    @else
                        @lang('main.not_available')
                    @endif
                    <a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code]) }}"
                        class="btn btn-default" role="button">
                        @lang('main.more')
                    </a>
                    @csrf
                </form>
            </p>
        </div>
    </div>
</div>
