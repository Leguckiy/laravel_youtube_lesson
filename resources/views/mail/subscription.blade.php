@lang('mail.subscription.dear_client') {{ $sku->product->__('name') }} @lang('mail.subscription.appeared_in_stock').

<a href="{{ route('product', [$sku->product->category->code, $sku->product->code, $sku->id]) }}">
    @lang('mail.subscription.more_info')
</a>
