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
        <th>{{ $key+1 }}</th>
        <th>{{ $value->product->name }}</th>
        <th>{{ $value->qty }}</th>
        <th>{{ $value->price }}</th>
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

@component('mail::button', ['url' => config('app.url')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
