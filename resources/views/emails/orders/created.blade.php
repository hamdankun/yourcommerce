@component('mail::message')
Your order has been created and still in prosessing, please wait until next notice coming

Your summary order:
<table width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Name</th>
      <th>Qty</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    @foreach($order->details as $key => $value)
      <tr>
        <th class="text-left">{{ $key+1 }}</th>
        <th class="text-left">{{ $value->product->name }}</th>
        <th class="text-left">{{ $value->qty }}</th>
        <th class="text-left">{{ $value->price }}</th>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
      <tr>
          <th colspan="3">Total</th>
          <th>{{ currency($order->grand_total, 'ID') }}</th>
      </tr>
  </tfoot>
</table>

@component('mail::button', ['url' => config('app.base_url')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
