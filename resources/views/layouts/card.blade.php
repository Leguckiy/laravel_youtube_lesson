<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="{{ Storage::url($product->image) }}" alt="iPhone X 64GB">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} грн.</p>
            <p>
                <form action="{{ route('basket-add', $product->id) }}" method="post">
                    <button class="btn btn-primary" type="submit">В корзину</button>
                    <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default"
                    role="button">Подробнее</a>
                    @csrf
                </form>
            </p>
        </div>
    </div>
</div>
