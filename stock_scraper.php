<?php
// Load the latest stock data from JSON file
$jsonFiles = glob('ambani_stock_data_*.json');
rsort($jsonFiles); // Sort in descending order to get the latest file first

$stockData = [];
if (!empty($jsonFiles)) {
    $latestFile = $jsonFiles[0];
    $stockData = json_decode(file_get_contents($latestFile), true);
}

// If no data is available, show a message
if (empty($stockData)) {
    echo "No stock data available. Please run the scraper first.";
    exit;
}

// Format functions
function formatNumber($value) {
    if (is_numeric(str_replace(',', '', $value))) {
        return number_format((float)str_replace(',', '', $value), 2);
    }
    return $value;
}

function getChangeClass($value) {
    if (strpos($value, '-') !== false) {
        return 'negative';
    } elseif (strpos($value, '+') !== false) {
        return 'positive';
    }
    return '';
}

// Extract key metrics
$companyName = $stockData['company_name'] ?? 'Ambani Orgochem Ltd.';
$currentPrice = $stockData['current_price'] ?? $stockData['table_40_row_1_ambani_orgochem'] ?? '105.10';
$priceChange = $stockData['price_change'] ?? '0.00';
$percentChange = $stockData['percent_change'] ?? '0.00%';
$changeClass = getChangeClass($priceChange);

// Key metrics to display
$keyMetrics = [
    'Market Overview' => [
        'Open' => $stockData['table_1_row_0_open'] ?? 'N/A',
        'High' => $stockData['table_2_row_0_high'] ?? 'N/A',
        'Low' => $stockData['table_2_row_1_low'] ?? 'N/A',
        'Previous Close' => $stockData['table_1_row_1_previous_close'] ?? 'N/A',
        'Volume' => $stockData['table_1_row_2_volume'] ?? 'N/A',
    ],
    'Key Indicators' => [
        '52 Week High' => $stockData['table_2_row_4_52_week_high'] ?? 'N/A',
        '52 Week Low' => $stockData['table_2_row_5_52_week_low'] ?? 'N/A',
        'All Time High' => $stockData['table_3_row_0_all_time_high'] ?? 'N/A',
        'All Time Low' => $stockData['table_3_row_1_all_time_low'] ?? 'N/A',
        'Market Cap (₹ Cr)' => $stockData['table_1_row_6_mkt_cap_rs_cr'] ?? 'N/A',
    ],
    'Fundamentals' => [
        'EPS (TTM)' => $stockData['table_4_row_0_ttm_eps'] ?? 'N/A',
        'P/E Ratio' => $stockData['table_4_row_2_ttm_pe_see_historical_trend'] ?? 'N/A',
        'Book Value Per Share' => $stockData['table_3_row_4_book_value_per_share'] ?? 'N/A',
        'P/B Ratio' => $stockData['table_4_row_3_p_b_see_historical_trend'] ?? 'N/A',
        'Face Value' => $stockData['table_2_row_6_face_value'] ?? 'N/A',
    ]
];

// Get timestamp
$timestamp = $stockData['timestamp'] ?? date('Y-m-d H:i:s');
$date = date('F j, Y', strtotime($timestamp));
$time = date('g:i A', strtotime($timestamp));

// Get similar companies
$similarCompanies = [];
for ($i = 1; $i <= 5; $i++) {
    $companyKey = "table_40_row_{$i}_" . strtolower(str_replace(' ', '_', substr($stockData["table_40_row_{$i}_" . strtolower(str_replace(' ', '_', 'company_name'))] ?? '', 0, 20)));
    $priceKey = "table_40_row_{$i}_" . strtolower(str_replace(' ', '_', 'price'));
    
    if (isset($stockData[$companyKey]) && isset($stockData[$priceKey])) {
        $similarCompanies[] = [
            'name' => $stockData[$companyKey],
            'price' => $stockData[$priceKey]
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($companyName); ?> - Stock Information</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --background-color: #f8fafc;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --positive-color: #10b981;
            --negative-color: #ef4444;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }
        
        .company-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .company-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-color);
        }
        
        .company-logo {
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            margin-right: 15px;
        }
        
        .company-header {
            display: flex;
            align-items: center;
        }
        
        .timestamp {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .price-container {
            text-align: right;
        }
        
        .current-price {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-color);
        }
        
        .price-change {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-weight: 500;
        }
        
        .positive {
            color: var(--positive-color);
        }
        
        .negative {
            color: var(--negative-color);
        }
        
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow);
        }
        
        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary-color);
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }
        
        .metric {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        
        .metric-name {
            color: var(--text-muted);
            font-weight: 500;
        }
        
        .metric-value {
            font-weight: 600;
        }
        
        .similar-companies {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .company-chip {
            background-color: #e2e8f0;
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .company-chip-name {
            font-weight: 500;
        }
        
        .company-chip-price {
            font-weight: 600;
        }
        
        footer {
            text-align: center;
            margin-top: 30px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .data-source {
            margin-top: 10px;
            font-size: 0.8rem;
        }
        
        .icon {
            margin-right: 5px;
        }
        
        @media (max-width: 768px) {
            .card-grid {
                grid-template-columns: 1fr;
            }
            
            .company-info {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .price-container {
                text-align: left;
                margin-top: 15px;
            }
            
            .price-change {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="company-info">
                <div>
                    <div class="company-header">
                        <div class="company-logo"><?php echo substr($companyName, 0, 1); ?></div>
                        <div>
                            <h1 class="company-name"><?php echo htmlspecialchars($companyName); ?></h1>
                            <div class="timestamp">
                                <i class="fas fa-calendar-alt icon"></i> <?php echo $date; ?> 
                                <i class="fas fa-clock icon" style="margin-left: 10px;"></i> <?php echo $time; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="price-container">
                    <div class="current-price">₹<?php echo htmlspecialchars($currentPrice); ?></div>
                    <div class="price-change <?php echo $changeClass; ?>">
                        <?php if ($changeClass === 'positive'): ?>
                            <i class="fas fa-caret-up icon"></i>
                        <?php elseif ($changeClass === 'negative'): ?>
                            <i class="fas fa-caret-down icon"></i>
                        <?php endif; ?>
                        <?php echo htmlspecialchars($priceChange); ?> (<?php echo htmlspecialchars($percentChange); ?>)
                    </div>
                </div>
            </div>
        </header>
        
        <div class="card-grid">
            <?php foreach ($keyMetrics as $section => $metrics): ?>
            <div class="card">
                <h2 class="card-title"><i class="fas fa-chart-line icon"></i> <?php echo htmlspecialchars($section); ?></h2>
                <?php foreach ($metrics as $name => $value): ?>
                <div class="metric">
                    <div class="metric-name"><?php echo htmlspecialchars($name); ?></div>
                    <div class="metric-value"><?php echo htmlspecialchars($value); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
            
            <?php if (!empty($similarCompanies)): ?>
            <div class="card">
                <h2 class="card-title"><i class="fas fa-building icon"></i> Similar Companies</h2>
                <div class="similar-companies">
                    <?php foreach ($similarCompanies as $company): ?>
                    <div class="company-chip">
                        <span class="company-chip-name"><?php echo htmlspecialchars($company['name']); ?></span>
                        <span class="company-chip-price">₹<?php echo htmlspecialchars($company['price']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <footer>
            <p>Stock data is for informational purposes only and should not be considered as financial advice.</p>
            <p class="data-source">Data source: <a href="https://www.moneycontrol.com/india/stockpricequote/chemicals/ambaniorgochem/AO" target="_blank">MoneyControl</a></p>
        </footer>
    </div>
</body>
</html>
