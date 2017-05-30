<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Cart;
use Carbon\Carbon;
use App\Models\Sales\Order;
use App\Events\OrderCreated;
use App\Models\Master\Product;
use App\Models\Sales\OrderDetail;
use App\Models\Sales\GuestMember;
use App\Models\Master\MemberAddress;
use App\Http\Controllers\Controller;
use App\Models\Master\PaymentMethod;
use App\Models\Master\DeliveryMethod;

class OrderController extends Controller
{

    /**
     * The path view
     * @var string
     */
    protected $pathView = 'frontend.order';

    /**
     * Init Tree Category
     */
    public function __construct()
    {
      $this->getTreeCategory();
    }

    /**
     * Show list cart
     * @return \Illuminate\Http\Response
     */
    public function shoppingCart()
    {
      $this->defaultMeta()->setTitle('Shopping Cart')->setProperty('type', 'shopping cart');
      $data['previous_url'] = $this->randomUrlCategory();
      return view('frontend.order.shopping-cart', $data);
    }

    /**
     * Step 1 order
     * @return \Illuminate\Http\Response
     */
    public function step1()
    {
      if (!Cart::count()) return redirect()->route('order.shopping-cart');

      $this->stepList('Address');
      $this->boxFooter(
        [route('order.shopping-cart') => 'Back to Shopping Cart'],
        ['address' => 'Continue to Delivery Method']
      );
      return view($this->pathView.'.step1');
    }

    /**
     * Step 1 order store
     * @return \Illuminate\Http\Response
     */
    public function storeStep1()
    {
      session()->put('biodata', request()->except('_token'));
      return redirect()->route('order.step-2');
    }

    /**
     * Step 2 order
     * @return \Illuminate\Http\Response
     */
    public function step2()
    {
      if (!session()->has('biodata')) return redirect()->route('order.step-1');
      $data['delivery_methods'] = $this->toCache('delivery_methods', function() {
        return DeliveryMethod::get();
      });
      $this->stepList('Delivery Method');
      $this->boxFooter(
        [route('order.step-1') => 'Back to Addresses'],
        ['delivery-method' => 'Continue to Payment Method']
      );
      return view($this->pathView.'.step2', $data);
    }

    /**
     * Step 2 order store
     * @return \Illuminate\Http\Response
     */
    public function storeStep2()
    {
      if (!request()->has('delivery')) return redirect()->back();

      session()->put('biodata.delivery_method_id', (int)request()->get('delivery'));
      return redirect()->route('order.step-3');
    }

    /**
     * Step 3 order
     * @return \Illuminate\Http\Response
     */
    public function step3()
    {
      if (!session()->has('biodata.delivery_method_id')) return redirect()->back();

      $data['payment_methods'] = $this->toCache('payment_methods', function() {
        return PaymentMethod::get();
      });
      $this->stepList('Payment Method');
      $this->boxFooter(
        [route('order.step-2') => 'Back to Shipping method'],
        ['payment-method' => 'Continue to Order review']
      );
      return view($this->pathView.'.step3', $data);
    }

    /**
     * Step 2 order store
     * @return \Illuminate\Http\Response
     */
    public function storeStep3()
    {
      if (!request()->has('payment_method')) return redirect()->back();

      session()->put('biodata.payment_method_id', (int)request()->get('payment_method'));
      return redirect()->route('order.step-4');
    }


    /**
     * Step 4 order
     * @return \Illuminate\Http\Response
     */
    public function step4()
    {
      if (!session()->has('biodata.payment_method_id')) return redirect()->back();

      $this->stepList('Order Review');
      $this->boxFooter(
        [route('order.step-3') => 'Back to Payment method'],
        ['place-order' => 'Place an order']
      );
      return view($this->pathView.'.step4');
    }

    /**
     * Save order
     * @return \Illuminate\Http\Response
     */
    public function save()
    {
      $biodata = session()->get('biodata');
      $cart = Cart::content();
      try {
        DB::beginTransaction();
        $questMember = GuestMember::create($biodata);
        $biodata['member_id'] = $questMember->id;
        $biodata['member_type'] = GuestMember::class;
        $address = MemberAddress::create($biodata);
        $order = $biodata;
        $order['address_id'] = $address->id;
        $order['date'] = Carbon::now();
        $order['total'] = Cart::subTotal(0, '', '');
        $order['tax'] = Cart::tax();
        $order['shipping_cost'] = 0;
        $order['discount_total'] = 0;
        $order['grand_total'] = Cart::total(0, '', '');
        $order = Order::create($order);
        $this->saveDetail($order);
        $this->destroyCartAndBiodata();
        $orderId = $order->id;
        $created = true;
        $message = 'Order has been created';
        event(new OrderCreated($order));
        DB::commit();
      } catch (\Exception $e) {
        $this->writeErrors($e);
        $created = false;
        $message = 'Fail to create order';
        $orderId = 0;
        DB::rollBack();
      }
      session()->flash('order.created', $created);
      session()->flash('order.message', $message);
      return redirect()->route('order.success', [$orderId]);

    }

    /**
     * Save order detail
     * @param  \App\Models\Sales\Order $order
     * @return void
     */
    public function saveDetail($order)
    {
      $products = collect([]);
      foreach (Cart::content() as $key => $value) {
        $products->push([
          'order_id' => $order->id,
          'product_id' => Product::findBySlug($value->id)->first()->id,
          'price' => (int)$value->price,
          'qty' => $value->qty,
          'discount' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);
      }
      OrderDetail::insert($products->all());
    }

    /**
     * Destroy Cart and user data
     * @return void
     */
    public function destroyCartAndBiodata()
    {
      session()->forget('biodata');
      Cart::destroy();
    }

    /**
     * Show summary Order
     * @param  \App\Models\Sales\Order $orderId
     * @return \Illuminate\Http\Response
     */
    public function finish($orderId)
    {
      $data['order'] = Order::with('details')->where('id', $orderId)->first();
      return view($this->pathView.'.finish', $data);
    }

    /**
     * List step all and current
     * @param  string $enable
     * @return void
     */
    public function stepList($enable)
    {
      $lists = collect([
          ['name' => 'Address', 'icon' => 'fa-map-marker', 'disabled' => $enable === 'Address' ? false : true, 'link' => route('order.step-1')],
          ['name' => 'Delivery Method', 'icon' => 'fa-truck','disabled' => $enable === 'Delivery Method' ? false : true, 'link' => route('order.step-2') ],
          ['name' => 'Payment Method', 'icon' => 'fa-money','disabled' => $enable === 'Payment Method' ? false : true, 'link' => route('order.step-3') ],
          ['name' => 'Order Review', 'icon' => 'fa-eye','disabled' => $enable === 'Order Review' ? false : true , 'link' => route('order.step-4')]
      ]);
      $activeIndex = $lists->filter(function($data) {
        return !$data['disabled'];
      })->keys()->first();
      $lists = $lists->map(function($data, $key) use($activeIndex) {
        return [
          'name' => $data['name'],
          'icon' => $data['icon'],
          'disabled' => $data['disabled'] ? $activeIndex <= $key : $data['disabled'],
          'link' => $data['link'],
          'class' => $activeIndex === $key ? 'active' : ''
        ];
      });
      view()->share('step_lists', $lists->all());
    }

    /**
     * Box footer button step order
     * @param  array $back
     * @param  array $next
     * @return void
     */
    public function boxFooter($back, $next)
    {
      $back = collect($back);
      $next = collect($next);
      $boxButton = $back->merge($next);
      view()->share('box_button', $boxButton->all());
    }
}
