<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سفارشات من - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Vazirmatn', sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        .orders-table { background: white; border-radius: 10px; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: right; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        .badge { padding: 5px 10px; border-radius: 15px; font-size: 0.85rem; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-processing { background: #cce5ff; color: #004085; }
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #3498db; color: white; }
        .filters { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        .filter-select { padding: 8px; border: 1px solid #ddd; border-radius: 5px; }
        .pagination { margin-top: 20px; display: flex; justify-content: center; gap: 5px; }
        .page-link { padding: 8px 12px; border: 1px solid #ddd; border-radius: 5px; text-decoration: none; }
        .page-link.active { background: #3498db; color: white; border-color: #3498db; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>سفارشات من</h1>
        </div>
        
        <div class="filters">
            <form method="GET" action="{{ route('user.orders.index') }}">
                <label>فیلتر بر اساس وضعیت:</label>
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>همه سفارشات</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>در انتظار</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>در حال پردازش</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>لغو شده</option>
                </select>
            </form>
        </div>
        
        <div class="orders-table">
            @if($orders->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>شماره سفارش</th>
                            <th>تاریخ</th>
                            <th>مبلغ کل</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('Y/m/d') }}</td>
                                <td>{{ number_format($order->total_amount) }} تومان</td>
                                <td>
                                    <span class="badge badge-{{ $order->status }}">
                                        {{ $order->status_text }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('user.orders.show', $order) }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                        مشاهده
                                    </a>
                                    @if(in_array($order->status, ['pending', 'processing']))
                                        <form action="{{ route('user.orders.cancel', $order) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" onclick="return confirm('آیا از لغو سفارش مطمئن هستید؟')" 
                                                    style="background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                                                لغو سفارش
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pagination">
                    {{ $orders->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 50px;">
                    <i class="fas fa-shopping-cart" style="font-size: 4rem; color: #ddd;"></i>
                    <h3 style="margin-top: 20px;">هنوز سفارشی ثبت نکرده‌اید</h3>
                    <a href="{{ route('home') }}" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">
                        شروع خرید از فروشگاه
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>