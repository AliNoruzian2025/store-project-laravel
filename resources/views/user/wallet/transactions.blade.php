<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تاریخچه تراکنش‌ها - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
            --dark: #2b2d42;
            --radius: 10px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .back-btn {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .transactions-table {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }
        
        th, td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--dark);
        }
        
        .positive { color: var(--success); }
        .status-completed { color: var(--success); font-weight: 500; }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        .page-link {
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            text-decoration: none;
            color: var(--primary);
        }
        
        .page-link.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        .filter-badge {
            display: inline-block;
            background: var(--success);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>تاریخچه تراکنش‌های کیف پول</h1>
            <a href="{{ route('user.wallet.index') }}" class="back-btn">
                <i class="fas fa-arrow-right"></i>
                بازگشت به کیف پول
            </a>
        </div>
        
        <div class="transactions-table">
            <div class="filter-badge">
                <i class="fas fa-check-circle"></i>
                نمایش فقط تراکنش‌های موفق
            </div>
            
            @if($transactions->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>تاریخ و ساعت</th>
                            <th>نوع تراکنش</th>
                            <th>مبلغ</th>
                            <th>وضعیت</th>
                            <th>توضیحات</th>
                            <th>کد رهگیری</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('Y/m/d H:i') }}</td>
                                <td>{{ $transaction->type_text }}</td>
                                <td class="positive">
                                    {{ number_format($transaction->amount) }} تومان
                                </td>
                                <td class="status-completed">
                                    <i class="fas fa-check-circle"></i>
                                    {{ $transaction->status_text }}
                                </td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->tracking_code }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pagination">
                    {{ $transactions->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <h3>هیچ تراکنش موفقی یافت نشد</h3>
                    <p>هنوز تراکنش موفقیتی در کیف پول شما ثبت نشده است.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>