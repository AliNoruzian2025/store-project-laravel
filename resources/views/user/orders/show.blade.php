<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات سفارش #{{ $order->id }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Vazirmatn', sans-serif; background: #f5f7fa; }
        .container { max-width: 1000px; margin: 0 auto; padding: 20px; }
        .back-btn { display: inline-block; margin-bottom: 20px; padding: 10px 15px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; }
        .order-card { background: white; border-radius: 10px; padding: 30px; margin-bottom: 20px; }
        .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .order-number { font-size: 1.5rem; color: #2c3e50; }
        .badge { padding: 8px 15px; border-radius: 20px; font-weight: 500; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-processing { background: #cce5ff; color: #004085; }
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .order-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .info-item { background: #f8f9fa; padding: 15px; border-radius: 8px; }
        .info-label { color: #6c757d; font-size: 0.9rem; margin-bottom: 5px; }
        .info-value { font-weight: 500; }
        .items-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .items-table th, .items-table td { padding: 12px; text-align: right; border-bottom: 1px solid #eee; }
        .items-table th { background: #f8f9fa; font-weight: 600; }
        .total-row { background: #f8f9fa; font-weight: bold; }
        .actions { margin-top: 30px; display: flex; gap: 10px; }
        .btn { padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-danger { background: #e74c3c; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('user.orders.index') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i>
            بازگشت به لیست سفارشات
        </a>
        
        <div class="order-card">
            <div class="order-header">
                <div class="order-number">سفارش #{{ $order->id }}</div>
                <span class="badge badge-{{ $order->status }}">
                    {{ $order->status_text }}
                </span>
            </div>
            
            <div class="order-info">
                <div class="info-item">
                    <div class="info-label">تاریخ ثبت سفارش</div>
                    <div class="info-value">{{ $order->created_at->format('Y/m/d H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">مبلغ کل</div>
                    <div class="info-value">{{ number_format($order->total_amount) }} تومان</div>
                </div>
                <div class="info-item">
                    <div class="info-label">آدرس تحویل</div>
                    <div class="info-value">{{ $order->address ?? 'ثبت نشده' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">کد پستی</div>
                    <div class="info-value">{{ $order->postal_code ?? 'ثبت نشده' }}</div>
                </div>
            </div>
            
            @if($order->notes)
                <div class="info-item" style="grid-column: 1 / -1;">
                    <div class="info-label">یادداشت</div>
                    <div class="info-value">{{ $order->notes }}</div>
                </div>
            @endif
            
            <h3>آیتم‌های سفارش</h3>
            @if($order->items && $order->items->count() > 0)
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>نام محصول</th>
                            <th>تعداد</th>
                            <th>قیمت واحد</th>
                            <th>قیمت کل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->unit_price) }} تومان</td>
                                <td>{{ number_format($item->total_price) }} تومان</td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="3">مبلغ کل سفارش</td>
                            <td>{{ number_format($order->total_amount) }} تومان</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p style="text-align: center; padding: 20px; color: #6c757d;">هیچ آیتمی در این سفارش وجود ندارد.</p>
            @endif
            
            <div class="actions">
                <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">
                    بازگشت به لیست سفارشات
                </a>
                
                @if(in_array($order->status, ['pending', 'processing']))
                    <form action="{{ route('user.orders.cancel', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('آیا از لغو سفارش مطمئن هستید؟')">
                            لغو سفارش
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>