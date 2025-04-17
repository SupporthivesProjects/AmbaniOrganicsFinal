<?php require 'header.php'; ?>

<style>
    section.section-4 {
        background-color: yellow;
        padding: 100px 0px 25px 0px;
    }
</style>

<?php
// Configuration
$cacheExpiration = 24 * 60 * 60; // Cache expiration in seconds (24 hours)
$stockUrl = 'https://www.moneycontrol.com/india/stockpricequote/chemicals/ambaniorgochem/AO';
$cacheDir = 'stock_cache/'; // Directory to store cache files

// Create cache directory if it doesn't exist
if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

// Function to scrape stock data from MoneyControl
function scrapeStockData($url) {
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    // Execute cURL session and get the HTML content
    $html = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        return [
            'error' => true,
            'message' => 'cURL Error: ' . curl_error($ch)
        ];
    }
    
    // Get HTTP status code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode != 200) {
        return [
            'error' => true,
            'message' => 'HTTP Error: ' . $httpCode
        ];
    }
    
    // Close cURL session
    curl_close($ch);
    
    // Initialize the result array
    $result = [
        'error' => false,
        'data' => []
    ];
    
    // Use regular expressions to extract data
    // Extract stock price
    if (preg_match('/<div class="inprice1[^>]*>.*?<span[^>]*>([\d,.]+)<\/span>/s', $html, $matches)) {
        $result['data']['current_price'] = trim($matches[1]);
    }
    
    // Extract price change
    if (preg_match('/<div class="inprice1[^>]*>.*?<span[^>]*>.*?<\/span>.*?<span[^>]*>([\+\-\d,.]+)<\/span>/s', $html, $matches)) {
        $result['data']['price_change'] = trim($matches[1]);
    }
    
    // Extract percentage change
    if (preg_match('/<div class="inprice1[^>]*>.*?<span[^>]*>.*?<\/span>.*?<span[^>]*>.*?<\/span>.*?<span[^>]*>\(([\+\-\d,.%]+)\)<\/span>/s', $html, $matches)) {
        $result['data']['percent_change'] = trim($matches[1]);
    }
    
    // Extract all table data using a more general approach
    preg_match_all('/<div class="FL gL_10[^>]*>([^<]+)<\/div>\s*<div class="FR gL_11[^>]*>([^<]+)<\/div>/s', $html, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        if (isset($match[1]) && isset($match[2])) {
            $key = sanitizeKey(trim($match[1]));
            $value = trim($match[2]);
            $result['data'][$key] = $value;
        }
    }
    
    // Extract more table data from other sections
    preg_match_all('/<div class="FL gL_7[^>]*>([^<]+)<\/div>\s*<div class="FR gL_8[^>]*>([^<]+)<\/div>/s', $html, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        if (isset($match[1]) && isset($match[2])) {
            $key = sanitizeKey(trim($match[1]));
            $value = trim($match[2]);
            $result['data'][$key] = $value;
        }
    }
    
    // Try to extract data from any table on the page
    preg_match_all('/<table[^>]*>(.*?)<\/table>/s', $html, $tableMatches);
    
    foreach ($tableMatches[1] as $tableIndex => $tableContent) {
        preg_match_all('/<tr[^>]*>(.*?)<\/tr>/s', $tableContent, $rowMatches);
        
        foreach ($rowMatches[1] as $rowIndex => $rowContent) {
            preg_match_all('/<t[dh][^>]*>(.*?)<\/t[dh]>/s', $rowContent, $cellMatches);
            
            if (count($cellMatches[1]) >= 2) {
                $key = sanitizeKey(strip_tags(trim($cellMatches[1][0])));
                $value = strip_tags(trim($cellMatches[1][1]));
                
                if (!empty($key) && !empty($value)) {
                    $result['data']["table_{$tableIndex}_row_{$rowIndex}_{$key}"] = $value;
                }
            }
        }
    }
    
    // Extract company name
    if (preg_match('/<h1[^>]*>([^<]+)<\/h1>/s', $html, $matches)) {
        $result['data']['company_name'] = trim($matches[1]);
    }
    
    // Extract BSE/NSE codes
    if (preg_match('/BSE: (\d+)/s', $html, $matches)) {
        $result['data']['bse_code'] = trim($matches[1]);
    }
    
    if (preg_match('/NSE: ([A-Z0-9]+)/s', $html, $matches)) {
        $result['data']['nse_code'] = trim($matches[1]);
    }
    
    // Extract sector information
    if (preg_match('/SECTOR: <a[^>]*>([^<]+)<\/a>/s', $html, $matches)) {
        $result['data']['sector'] = trim($matches[1]);
    }
    
    // Add timestamp
    $result['data']['timestamp'] = date('Y-m-d H:i:s');
    
    return $result;
}

// Helper function to sanitize keys
function sanitizeKey($key) {
    // Remove special characters and convert to lowercase
    $key = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $key));
    // Remove multiple underscores
    $key = preg_replace('/_+/', '_', $key);
    // Trim underscores from beginning and end
    $key = trim($key, '_');
    return $key;
}

// Check if we need to fetch fresh data
$needFreshData = true;
$cacheFile = $cacheDir . 'stock_data_' . date('Y-m-d') . '.json';

// Check if today's cache file exists and is not expired
if (file_exists($cacheFile)) {
    $fileAge = time() - filemtime($cacheFile);
    if ($fileAge < $cacheExpiration) {
        $needFreshData = false;
    }
}

// Fetch fresh data if needed
if ($needFreshData) {
    $stockDataResult = scrapeStockData($stockUrl);
    
    if (!$stockDataResult['error']) {
        // Save the data to today's cache file
        file_put_contents($cacheFile, json_encode($stockDataResult['data'], JSON_PRETTY_PRINT));
        
        // Clean up old cache files (keep only last 7 days)
        $oldCacheFiles = glob($cacheDir . 'stock_data_*.json');
        usort($oldCacheFiles, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        
        // Keep only the 7 most recent files
        if (count($oldCacheFiles) > 7) {
            for ($i = 7; $i < count($oldCacheFiles); $i++) {
                unlink($oldCacheFiles[$i]);
            }
        }
        
        $stockData = $stockDataResult['data'];
    } else {
        // If there was an error fetching fresh data, try to use the most recent cache
        $jsonFiles = glob($cacheDir . 'stock_data_*.json');
        rsort($jsonFiles); // Sort in descending order to get the latest file first
        
        if (!empty($jsonFiles)) {
            $latestFile = $jsonFiles[0];
            $stockData = json_decode(file_get_contents($latestFile), true);
        } else {
            echo "Error fetching stock data: " . $stockDataResult['message'];
            echo "<br>No cached data available. Please try again later.";
            exit;
        }
    }
} else {
    // Use cached data
    $stockData = json_decode(file_get_contents($cacheFile), true);
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

// Helper function to display human-readable time difference
function human_time_diff($timestamp) {
    $diff = time() - $timestamp;
    
    if ($diff < 60) {
        return 'less than a minute ago';
    } elseif ($diff < 3600) {
        $mins = round($diff / 60);
        return $mins . ' minute' . ($mins > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400) {
        $hours = round($diff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } else {
        $days = round($diff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    }
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

// Get data freshness
$dataFreshness = $needFreshData ? 'just now' : human_time_diff(filemtime($cacheFile));

// Get similar companies
$similarCompanies = [];
for ($i = 1; $i <= 5; $i++) { 
    $companyKey = "table_40_row_{$i}_ambani_orgochem";
    $priceKey = "table_40_row_{$i}_price";
    
    if (isset($stockData[$companyKey]) && isset($stockData[$priceKey])) {
        $similarCompanies[] = [
            'name' => $stockData[$companyKey],
            'price' => $stockData[$priceKey]
        ];
    }
}
?>

<style>
        :root {
            --primary-color: #b73a36;
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
        
        
        
        .container_stock {
            max-width: 100% !important;
            margin: 0 auto !important;
            padding: 20px !important;
        }
        
        .container_stock .stock_head {
            background-color: var(--card-bg, #ffffff) !important;
            padding: 20px !important;
            border-radius: 10px !important;
            box-shadow: var(--shadow, 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)) !important;
            margin-bottom: 20px !important;
        }
        
        .container_stock .company-info {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            flex-wrap: wrap !important;
        }
        
        .container_stock .company-name {
            font-size: 1.8rem !important;
            font-weight: 700 !important;
            color: var(--text-color, #1e293b) !important;
        }
        
        .container_stock .company-logo {
            width: 50px !important;
            height: 50px !important;
            background-color: var(--primary-color, #b73a36) !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: white !important;
            font-weight: 700 !important;
            font-size: 1.2rem !important;
            margin-right: 15px !important;
        }
        
        .container_stock .company-header {
            display: flex !important;
            align-items: center !important;
        }
        
        .container_stock .timestamp {
            color: var(--text-muted, #64748b) !important;
            font-size: 0.9rem !important;
            margin-top: 5px !important;
        }
        
        .container_stock .price-container {
            text-align: right !important;
        }
        
        .container_stock .current-price {
            font-size: 2.2rem !important;
            font-weight: 700 !important;
            color: var(--text-color, #1e293b) !important;
        }
        
        .container_stock .price-change {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            font-weight: 500 !important;
        }
        
        .container_stock .positive {
            color: var(--positive-color, #10b981) !important;
        }
        
        .container_stock .negative {
            color: var(--negative-color, #ef4444) !important;
        }
        
        .container_stock .card-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fill, minmax(450px, 1fr)) !important;
            gap: 20px !important;
            margin-bottom: 20px !important;
        }
        
        .container_stock .card {
            background-color: var(--card-bg, #ffffff) !important;
            border-radius: 10px !important;
            padding: 20px !important;
            box-shadow: var(--shadow, 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)) !important;
        }
        
        .container_stock .card-title {
            font-size: 1.2rem !important;
            font-weight: 600 !important;
            margin-bottom: 15px !important;
            color: var(--primary-color, #b73a36) !important;
            border-bottom: 1px solid var(--border-color, #e2e8f0) !important;
            padding-bottom: 10px !important;
        }
        
        .container_stock .metric {
            display: flex !important;
            justify-content: space-between !important;
            margin-bottom: 12px !important;
        }
        
        .container_stock .metric-name {
            color: var(--text-muted, #64748b) !important;
            font-weight: 500 !important;
        }
        
        .container_stock .metric-value {
            font-weight: 600 !important;
        }
        
        .container_stock .similar-companies {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 10px !important;
        }
        
        .container_stock .company-chip {
            background-color: #e2e8f0 !important;
            border-radius: 20px !important;
            padding: 8px 15px !important;
            font-size: 0.9rem !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        .container_stock .company-chip-name {
            font-weight: 500 !important;
        }
        
        .container_stock .company-chip-price {
            font-weight: 600 !important;
        }
        
        .container_stock footer {
            text-align: center !important;
            margin-top: 30px !important;
            color: var(--text-muted, #64748b) !important;
            font-size: 0.9rem !important;
        }
        
        .container_stock .data-source {
            margin-top: 10px !important;
            font-size: 0.8rem !important;
        }
        
        .container_stock .icon {
            margin-right: 5px !important;
        }
        
        @media (max-width: 768px) {
            .container_stock .card-grid {
                grid-template-columns: 1fr !important;
            }
            
            .container_stock .company-info {
                flex-direction: column !important;
                align-items: flex-start !important;
            }
            
            .container_stock .price-container {
                text-align: left !important;
                margin-top: 15px !important;
            }
            
            .container_stock .price-change {
                justify-content: flex-start !important;
            }
        }
        
        /* Define CSS variables with !important to ensure they're applied */
        .container_stock {
            --primary-color: #b73a36 !important;
            --secondary-color: #1e40af !important;
            --background-color: #f8fafc !important;
            --card-bg: #ffffff !important;
            --text-color: #1e293b !important;
            --text-muted: #64748b !important;
            --border-color: #e2e8f0 !important;
            --positive-color: #10b981 !important;
            --negative-color: #ef4444 !important;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }
        
        /* Ensure all elements inside container_stock inherit styles */
        .container_stock * {
            box-sizing: border-box !important;
            font-family: 'Inter', sans-serif !important;
        }
        
        /* Additional specificity for links inside container_stock */
        .container_stock a {
            text-decoration: none !important;
            color: var(--primary-color, #b73a36) !important;
        }
        
        .container_stock a:hover {
            text-decoration: underline !important;
        }
        
        html 
        {
            scroll-behavior: smooth;
        }

        
        

    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--<body class="home" data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0" cz-shortcut-listen="true">-->

    <!-- Preloader -->
    <!-- <div id="preloader" data-timeout="2000" class="odd preloader counter ready">
        <div data-aos="fade-up" data-aos-delay="500"
            class="row justify-content-center text-center items aos-init aos-animate">
            <div data-percent="100" class="radial"><canvas width="140" height="140"
                    style="height: 70px; width: 70px;"></canvas>
                <span>100<i>%</i></span>
            </div>
        </div>
    </div> -->


    <!-- Hero -->
    <section id="slider" class="hero p-0 odd">
        <div class="swiper-container full-slider animation slider-h-100 slider-h-auto">
            <div class="swiper-wrapper" id="slider_coordinates" style="transition-duration: 300ms;">

                
                <div class="swiper-slide slide-center swiper-slide-active" id="slider_2">

                    <!-- Media -->
                    <video autoplay muted loop class="full-video">
                        <source src="assets/images/VID.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    
                </div>

            </div>
        </div>
    </section>
    <!-- <section id="slider" class="hero p-0 odd">
        <div
            class="swiper-container full-slider animation slider-h-100 slider-h-auto swiper-container-initialized swiper-container-horizontal">
            <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">

                <div class="swiper-slide slide-center">

                    <img src="assets/images/bg-11.jpg" alt="Full Image" class="full-image" data-mask="70">

                    <div class="slide-content row">
                        <div class="col-12 d-flex justify-content-start inner">
                            <div class="left text-left init">

                                <h1 data-aos="zoom-in" data-aos-delay="400"
                                    class="title effect-static-text aos-init aos-animate">
                                    <span class="pre-title m-0">Logistics Solutions</span>
                                    Structured <span class="featured"><span>Warehouse</span></span>
                                </h1>
                                <p data-aos="zoom-in" data-aos-delay="800" class="description aos-init aos-animate">We
                                    develop operational strategies with the customer to improve logistical efficiency.
                                </p>

                                <div data-aos="fade-up" data-aos-delay="1200" class="buttons aos-init aos-animate">
                                    <div class="d-sm-inline-flex">
                                        <a href="#contact" class="smooth-anchor mt-4 btn primary-button">GET IN
                                            TOUCH</a>
                                        <a href="#about" class="smooth-anchor ml-sm-4 mt-4 btn outline-button">READ
                                            MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide-center">

                    <img src="assets/images/bg-12.jpg" alt="Full Image" class="full-image" data-mask="70">

                    <div class="slide-content row">
                        <div class="col-12 d-flex justify-content-start justify-content-md-center inner">
                            <div class="center text-left text-md-center">

                                <h2 data-aos="zoom-in" data-aos-delay="400"
                                    class="title effect-static-text aos-init aos-animate">
                                    <span class="pre-title m-auto">Skilled Labor</span>
                                    <span class="featured"><span>Tech</span></span> ~ Innovation
                                </h2>
                                <p data-aos="zoom-in" data-aos-delay="800"
                                    class="description mr-auto ml-auto aos-init aos-animate">Through an innovative
                                    inventory management system we are able to guarantee the monitoring of the entire
                                    process in real time.</p>

                                <div data-aos="fade-up" data-aos-delay="1200" class="buttons aos-init aos-animate">
                                    <div class="d-sm-inline-flex">
                                        <a href="#contact" class="smooth-anchor mt-4 btn primary-button">GET IN
                                            TOUCH</a>
                                        <a href="#about" class="smooth-anchor ml-sm-4 mt-4 btn outline-button">READ
                                            MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section> -->

    <!-- About -->
    <!--<section id="about" class="section-1 highlights image-right">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12 col-md-6 pr-md-5 align-self-center text-center text-md-left text">-->
    <!--                <div data-aos="fade-up" class="row intro aos-init aos-animate">-->
    <!--                    <div class="col-12 p-0">-->
    <!--                        <span class="pre-title m-auto m-md-0">About the network</span>-->
    <!--                        <h2><span class="featured"><span>The</span></span> Company</h2>-->
    <!--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras iaculis diam varius diam ultricies lacinia. Mauris lacus tellus, ultrices eu volutpat sit amet, finibus a ipsum.-->
    <!--                        </p>-->
    <!--                        <p>Curabitur convallis, diam a egestas iaculis, neque lorem interdum felis, in viverra lacus tortor in leo.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-12 col-md-6 pr-md-5 align-self-center text-center text-md-left text">-->
    <!--                <div class="row items">-->
    <!--                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 item aos-init aos-animate">-->
    <!--                        <h4><i class="mr-2 fa-solid fa-ribbon"></i>Tradition</h4>-->
    <!--                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>-->
    <!--                    </div>-->
    <!--                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 item aos-init aos-animate">-->
    <!--                        <h4><i class="mr-2 fa-solid fa-lock"></i>Security</h4>-->
    <!--                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="row items">-->
    <!--                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 item aos-init aos-animate">-->
    <!--                        <h4><i class="mr-2 fa-solid fa-note-sticky"></i>Certificate</h4>-->
    <!--                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>-->
    <!--                    </div>-->
    <!--                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 item aos-init aos-animate">-->
    <!--                        <h4><i class="mr-2 fa-solid fa-graduation-cap"></i>Expertise</h4>-->
    <!--                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <!-- Video -->
    <section id="about" class="section-2 odd highlights image-center">
        <div class="container-fluid">
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="abt_desc_card">
                        
                                    <h4 class="about_pre_title text-center" data-aos="fade-up">About Us</h4>
                                    <h2 class="about_title" data-aos="fade-up">We Are <br><span>Ambani OrgoChem</span></h2>
                                    <p class="about_subtitle" data-aos="fade-up">
                                        Ambani Orgochem Ltd., originally founded as Specialty Coatings Pvt. Ltd. in 1985 and rebranded as Ambani Organics Ltd. in 1987, is a leading player in the specialty chemicals industry, with over three decades of expertise. Under the visionary leadership of Managing Director Mr. Rakesh Shah since 1996, we have expanded our capabilities and ventured into diverse industries, including textiles, packaging, paints, paper, construction, and pharmaceuticals <a href="./timeline.php" style="color: #FA8A37;">...Read More</a>
                                    </p>
                        <div class="stats-container">
                            <div class="stat-box">
                                <h2><span class="value" data-value="04" time-duration="3">0</span> Decade</h2>
                                <p>In Business</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="160" time-duration="3">0</span>+ Years</h2>
                                <p>Experience of Management</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="150" time-duration="3">0</span>+</h2>
                                <p>Team Size</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="100" time-duration="3">0</span>+</h2>
                                <p>SKUs</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="20" time-duration="3">0</span>+</h2>
                                <p>State Presence</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="30" time-duration="3">0</span></h2>
                                <p>Country Presence</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="4" time-duration="3">0</span></h2>
                                <p>Manufacturing Facilities</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="50000" time-duration="3">0</span>+</h2>
                                <p>Capacity</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="10" time-duration="3">0</span>+</h2>
                                <p>Industry Serves</p>
                            </div>
                            <div class="stat-box">
                                <h2><span class="value" data-value="15" time-duration="3">0</span>+</h2>
                                <p>Awards & Certificates</p>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            
            
        </div>
    </section>
            
            <!--<div class="row text-center intro">-->
            <!--    <div class="col-12">-->
            <!--        <span class="pre-title">Introduction Video</span>-->
            <!--        <h2>Tech <span class="featured"><span>Innovation</span></span></h2>-->
            <!--        <p class="text-max-800">Through an innovative inventory management system we are able to guarantee-->
            <!--            the monitoring of the entire process in real time.</p>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="row text-center">-->
            <!--    <div class="col-12 gallery">-->
            <!--        <a href="https://www.youtube.com/embed/KKtB-bDV4Ws"-->
            <!--            class="square-image d-flex justify-content-center align-items-center">-->
            <!--            <i class="icon bigger fas fa-play clone"></i>-->
            <!--            <i class="icon bigger fas fa-play"></i>-->
            <!--            <img src="assets/images/vid_img.png" class="fit-image" alt="Introduction Video">-->
            <!--        </a>-->
            <!--    </div>-->
            <!--</div>-->
        
    
    
    
    <!-- Products -->
    <section class="img_boxa" id="products">
  <div class="img_box">
    <div class="container-fluid px-0">
      <div class="servi_tt">
        <h4 class="bo_wt" data-aos="fade-up">PRODUCTS</h4>
        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam leo velit mi diam sed viverra aenean. Ut et-->
        <!--  velit molestie consectetur pharetra, platea convallis. Eleifend porttitor viverra sed lectus ipsum vitae ipsum-->
        <!--  blandit.</p>-->
      </div>
      <img src="./image/Line 55.png" alt="" class="img-fluid d-lg-block d-md-block d-none">
      <img src="./image/line_mob.png" alt="" class="img-fluid d-lg-none d-md-none d-block">

      <div class="serv_img_bs">
        <div class="serv_rw_1">
            <div class="serv_c1 js_hv" data-aos="fade-up">
                <a class="card_btn" href="#">Organic Peroxides</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4>Organic Peroxides</h4>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare volutpat blandit scelerisque et cursus tristique hendrerit hendrerit. Nunc urna at quis eu enim egestas.</p>-->
                        <a class="cart_black2" href="product_page.php?product_name=Organic%20Peroxides">View</a>
                    </div>
                </div>
            </div>
            <div class="serv_c2 js_hv" data-aos="fade-up">
                <a class="card_btn" href="#">Paint Driers</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4>Paint Driers</h4>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare volutpat blandit scelerisque et cursus tristique hendrerit hendrerit. Nunc urna at quis eu enim egestas.</p>-->
                        <a class="cart_black2" href="product_page.php?product_name=Paint%20Driers">View</a>
                    </div>
                </div>
            </div>
            <div class="serv_c3 js_hv" data-aos="fade-up">
                <a class="card_btn" href="#">Accelerators</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4>Accelerators</h4>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare volutpat blandit scelerisque et cursus tristique hendrerit hendrerit. Nunc urna at quis eu enim egestas.</p>-->
                        <a class="cart_black2" href="product_page.php?product_name=Accelerators">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="serv_rw_1">
            <div class="serv_c4 js_hv" data-aos="fade-up">
                <a class="card_btn" href="#">Acrylic Emulsion</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4>Acrylic Emulsion</h4>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare volutpat blandit scelerisque et cursus tristique hendrerit hendrerit. Nunc urna at quis eu enim egestas.</p>-->
                        <a class="cart_black2" href="product_page.php?product_name=Acrylic%20Emulsion">View</a>
                    </div>
                </div>
            </div>
            <div class="serv_c5 js_hv" data-aos="fade-up">
                <a class="card_btn" href="#">Speciality Chemicals</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4>Speciality Chemicals</h4>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare volutpat blandit scelerisque et cursus tristique hendrerit hendrerit. Nunc urna at quis eu enim egestas.</p>-->
                        <a class="cart_black2" href="product_page.php?product_name=SPECIALITY CHEMICALS">View</a>
                    </div>
                </div>
            </div>
            <div class="serv_c6 js_hv" data-aos="fade-up">
                <a class="card_btn" href="#">Salicylates</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4>Salicylates</h4>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare volutpat blandit scelerisque et cursus tristique hendrerit hendrerit. Nunc urna at quis eu enim egestas.</p>-->
                        <a class="cart_black2" href="product_page.php?product_name=Salicylates">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
</section>

    <section class="hs_csr" id="csr">
        <div class="container_custom">
            <h4 data-aos="fade-up">CSR</h4>
            <p data-aos="fade-up">
                Talk about the respect, the reputation or the brand name, whatever Ambani Orgochem is today is because of the society. Hence it has always been our belief to give back what has been earned and contribute towards building a stronger and sustainable community. AOL has a work culture that consistently intends to help and uplift the economic, social and environmental aspects of the society. Sustainable and renewable working environment has been a key aspect in our organization while on the same hand we have always restricted ourselves from releasing hazardous chemicals in the society. We believe and practice that all fire accidents, explosions and the release of other forms of hazardous energy are completely avoidable.<br>
                Sustainability has been integrated in our work culture since the very beginning of the establishment of Ambani Orgochem. While solvent base emulsion were an integral part of the Indian Industrial Market, we still decided to venture in Green Chemistry and go ahead with the manufacturing of water base chemicals. Although planet earth is being limited by resources our ambitions and imaginations are never restricted, but are fueled to overcome new limitations. All corners of the organization have willingly made Corporate Citizenship an integral part of their work ethic. This organization operates to enhancing the quality of life of the people inside and outside this organization. The commitments we make to our customers and the material that we supply have strings attached to us being affectionate to the people and environment around us. To strongly abide with our commitments to Responsible Corporate Citizenship, the products we manufacture are APEO Free and Low VOC. Due to these! practices, our commitment and knowledge towards green chemistry is stronger than ever before.
            </p>
        </div>
    </section>
    
    <!--<section class="hs_csr" id="csr" data-parallax="scroll" data-speed="0.01" data-image-src="./assets/images/new_img/csr7.jpg">-->
    <!--    <div class="container_custom">-->
    <!--        <h4>CSR</h4>-->
    <!--        <p>-->
    <!--            Talk about the respect, the reputation or the brand name, whatever Ambani Orgochem is today is because of the society. Hence it has always been our belief to give back what has been earned and contribute towards building a stronger and sustainable community. AOL has a work culture that consistently intends to help and uplift the economic, social and environmental aspects of the society. Sustainable and renewable working environment has been a key aspect in our organization while on the same hand we have always restricted ourselves from releasing hazardous chemicals in the society. We believe and practice that all fire accidents, explosions and the release of other forms of hazardous energy are completely avoidable.<br>-->
    <!--            Sustainability has been integrated in our work culture since the very beginning of the establishment of Ambani Orgochem. While solvent base emulsion were an integral part of the Indian Industrial Market, we still decided to venture in Green Chemistry and go ahead with the manufacturing of water base chemicals. Although planet earth is being limited by resources our ambitions and imaginations are never restricted, but are fueled to overcome new limitations. All corners of the organization have willingly made Corporate Citizenship an integral part of their work ethic. This organization operates to enhancing the quality of life of the people inside and outside this organization. The commitments we make to our customers and the material that we supply have strings attached to us being affectionate to the people and environment around us. To strongly abide with our commitments to Responsible Corporate Citizenship, the products we manufacture are APEO Free and Low VOC. Due to these! practices, our commitment and knowledge towards green chemistry is stronger than ever before.-->
    <!--        </p>-->
    <!--    </div>-->
    <!--</section>-->

    <!-- Gallery -->
    <section id="gallery" class="section-3 offers">
        <!--<div class="overflow-holder">-->
        <!--    <div class="container">-->
        <!--        <div class="row text-center intro">-->
        <!--            <div class="col-12">-->
        <!--                <span class="pre-title">Logistics solutions</span>-->
        <!--                <h2> <span class="featured"><span>Industry</span></span></h2>-->
        <!--                <p class="text-max-800">We develop operational strategies with the customer to improve-->
        <!--                    logistical efficiency.</p>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row gallery justify-content-center items">-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/1.jpg">-->
                        
        <!--                <div style="position: relative;">-->
        <!--                    <img src="assets/images/indus/1.jpg" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                        Composite FRP industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/2.webp">-->
        <!--                <div style="position: relative;">-->
        <!--                    <img src="assets/images/indus/2.webp" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                        Paint Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/3.png">-->
        <!--                <div style="position: relative;">-->
        <!--                    <img src="assets/images/indus/3.png" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                        Textile Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/4.jpeg">-->
        <!--                <div style="position: relative;">-->
        <!--                        <img src="assets/images/indus/4.jpeg" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                         Paper Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/5.jpg">-->
        <!--                <div style="position: relative;">-->
        <!--                    <img src="assets/images/indus/5.jpg" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                         Adhesive Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/6.jpg">-->
        <!--                <div style="position: relative;">-->
        <!--                        <img src="assets/images/indus/6.jpg" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                         Carpet Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--             <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/c.webp">-->
        <!--                 <div style="position: relative;">-->
        <!--                    <img src="assets/images/indus/c.webp" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                         Construction Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/8.jpg">-->
        <!--                <div style="position: relative;">-->
        <!--                    <img src="assets/images/indus/8.jpg" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                         Wood Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--            <a class="col-12 col-md-6 col-lg-4 item" href="assets/images/indus/9.jpg">-->
        <!--                <div style="position: relative;">-->
        <!--                        <img src="assets/images/indus/9.jpg" alt="Project" class="for_image">-->
        <!--                    <h3 class="for_position for_design">-->
        <!--                         Pharmacetical Industry-->
        <!--                    </h3>-->
        <!--                </div>-->
                        
        <!--            </a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
        
    <div class="container-fluid px-0">
      <div class="servi_tt">
         <!--<h2> <span class="featured"><span>Industry</span></span></h2>-->
         <h4 class="bo_wt" style="color: #b93833" data-aos="fade-up">Industry</h4>
        <!--<p style="padding: 0px 24px;color: #000">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam leo velit mi diam sed viverra aenean. Ut et-->
        <!--  velit molestie consectetur pharetra, platea convallis. Eleifend porttitor viverra sed lectus ipsum vitae ipsum</p>-->
      </div>
      <img src="./image/Line 55.png" alt="" class="img-fluid d-lg-block d-md-block d-none">
      <img src="./image/line_mob.png" alt="" class="img-fluid d-lg-none d-md-none d-block">

      <div class="serv_img_bs">
        <div class="serv_rw_1">
            <div class="serv_c7 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Composite%20FRP%20Industry" data-aos="fade-up">Composite FRP industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Composite FRP industry</h4>
                        <p data-aos="fade-up">The Composite FRP industry relies on high-performance chemicals for manufacturing durable, lightweight materials used in construction, automotive, aerospace, and marine applications. Our specialized products enhance the performance, durability, and processing of composite materials.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Composite%20FRP%20Industry">View Products</a>
                    </div>
                </div>
            </div>
            <div class="serv_c8 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Paint%20Industry" data-aos="fade-up">Paint Industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Paint Industry</h4>
                        <p data-aos="fade-up">The paint industry requires specialized additives and chemicals to enhance performance characteristics such as drying time, durability, and finish quality. Our range of paint driers, emulsions, and additives are formulated to meet the exacting standards of modern paint formulations.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Paint%20Industry">View Products</a>
                    </div>
                </div>
            </div>
            <div class="serv_c9 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Textile%20Industry" data-aos="fade-up">Textile Industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Textile Industry</h4>
                        <p data-aos="fade-up">The textile industry utilizes specialized chemicals for various processes including dyeing, printing, finishing, and coating. Our products help improve fabric quality, durability, and performance while meeting environmental standards.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Textile%20Industry">View Products</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="serv_rw_1">
            <div class="serv_c10 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Paper%20Industry" data-aos="fade-up">Paper Industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Paper Industry</h4>
                        <p data-aos="fade-up">The paper industry depends on chemical additives for improving paper strength, brightness, and processing efficiency. Our products assist in various stages of paper production from pulping to finishing.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Paper%20Industry">View Products</a>
                    </div>
                </div>
            </div>
            <div class="serv_c11 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Adhesive%20Industry" data-aos="fade-up">Adhesive Industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Adhesive Industry</h4>
                        <p data-aos="fade-up">The adhesive industry requires specialized chemicals to create bonding agents with specific properties. Our products enhance adhesive performance, curing time, and durability across various applications.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Adhesive%20Industry">View Products</a>
                    </div>
                </div>
            </div>
            <div class="serv_c12 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Carpet%20Industry" data-aos="fade-up">Carpet Industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Carpet Industry</h4>
                        <p data-aos="fade-up">The carpet industry uses specialized chemicals for backing, dyeing, and finishing processes. Our products help improve carpet durability, stain resistance, and overall performance.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Carpet%20Industry">View Products</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="serv_rw_1">
            <div class="serv_c13 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Construction%20Industry" data-aos="fade-up">Construction Industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up" data-aos="fade-up">Construction Industry</h4>
                        <p data-aos="fade-up">The construction industry relies on chemical additives for concrete, mortars, sealants, and coatings. Our products enhance workability, strength, water resistance, and durability of construction materials.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Construction%20Industry">View Products</a>
                    </div>
                </div>
            </div>
            <div class="serv_c14 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Wood%20Industry" data-aos="fade-up">Wood Industry</a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Wood Industry</h4>
                        <p  data-aos="fade-up">The wood industry uses specialized chemicals for treatment, preservation, and finishing of wood products. Our solutions help protect wood from decay, insects, and weathering while enhancing its appearance.</p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Wood%20Industry">View Products</a>
                    </div>
                </div>
            </div>
            <div class="serv_c15 js_hv" data-aos="fade-up">
                <a class="card_btn" href="industry_page.php?industry_name=Pharmacetical%20Industry" data-aos="fade-up">Personal Care, Home Care, and Fragrances </a>
                <div class="serv_gree">
                    <div class="dotted_box">
                        <h4 data-aos="fade-up">Personal Care, Home Care, and Fragrances </h4>
                        <p data-aos="fade-up">The personal care, home care, and fragrance industries all require high-quality, safe, and effective ingredients to create products that enhance everyday life. Our premium-grade raw materials meet the strictest standards, ensuring exceptional performance and reliability. </p>
                        <a class="cart_black2" href="industry_page.php?industry_name=Personal%20Care%20Home%20Care%20and%20Fragrances">View Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    </section>
    
    <section class="stock_section" id="stock_sec">
        <div class="container_custom">
            <h4 data-aos="fade-up" style="color: #b93833;">Insights</h4>
            <div class="container_stock">
                <div class="stock_head">
                    <div class="company-info">
                        <div>
                            <div class="company-header">
                                <div class="company-logo"><?php echo substr($companyName, 0, 1); ?></div>
                                <div>
                                    <h1 class="company-name"><?php echo htmlspecialchars($companyName); ?></h1>
                                    <div class="timestamp">
                                        <!-- Calendar SVG icon -->
                                        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14" style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                                            <path fill="currentColor" d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 448C48 456.8 55.16 464 64 464H384C392.8 464 400 456.8 400 448V192H48V448z"/>
                                        </svg>
                                        <?php echo $date; ?> 
                                        
                                        <!-- Clock SVG icon -->
                                        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="14" height="14" style="display: inline-block; vertical-align: middle; margin-right: 5px; margin-left: 10px;">
                                            <path fill="currentColor" d="M256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512zM232 256C232 269.3 242.7 280 256 280H360C373.3 280 384 269.3 384 256C384 242.7 373.3 232 360 232H280V120C280 106.7 269.3 96 256 96C242.7 96 232 106.7 232 120V256z"/>
                                        </svg>
                                        <?php echo $time; ?>
                                        
                                        <!-- Add data freshness indicator -->
                                        <span style="margin-left: 10px; font-size: 0.8rem; color: #6c757d;">
                                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="12" height="12" style="display: inline-block; vertical-align: middle; margin-right: 3px;">
                                                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/>
                                            </svg>
                                            Updated <?php echo $dataFreshness; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="price-container">
                            <div class="current-price">₹<?php echo htmlspecialchars($currentPrice); ?></div>
                            <div class="price-change <?php echo $changeClass; ?>">
                                <?php if ($changeClass === 'positive'): ?>
                                    <!-- Up arrow SVG icon -->
                                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="14" height="14" style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                                        <path fill="currentColor" d="M9.39 265.4l127.1-128C143.6 131.1 151.8 128 160 128s16.38 3.125 22.63 9.375l127.1 128c9.156 9.156 11.9 22.91 6.943 34.88S300.9 320 287.1 320H32.01c-12.94 0-24.62-7.781-29.58-19.75S.2333 274.5 9.39 265.4z"/>
                                    </svg>
                                <?php elseif ($changeClass === 'negative'): ?>
                                    <!-- Down arrow SVG icon -->
                                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="14" height="14" style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                                        <path fill="currentColor" d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/>
                                    </svg>
                                <?php endif; ?>
                                <?php echo htmlspecialchars($priceChange); ?> (<?php echo htmlspecialchars($percentChange); ?>)
                            </div>
                            
                            <!-- Add refresh button -->
                            <div style="margin-top: 10px;">
                                <a href="?refresh=true" class="refresh-button" style="display: inline-flex; align-items: center; font-size: 0.8rem; color: #6c757d; text-decoration: none; padding: 4px 8px; border: 1px solid #dee2e6; border-radius: 4px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="12" height="12" style="margin-right: 5px;">
                                        <path fill="currentColor" d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z"/>
                                    </svg>
                                    Refresh Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-grid">
                    <?php foreach ($keyMetrics as $section => $metrics): ?>
                    <div class="card">
                        <h2 class="card-title">
                            <!-- Chart SVG icon -->
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                                <path fill="currentColor" d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/>
                            </svg>
                            <?php echo htmlspecialchars($section); ?>
                        </h2>
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
                        <h2 class="card-title">
                            <!-- Building SVG icon -->
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="16" height="16" style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                                <path fill="currentColor" d="M336 0C362.5 0 384 21.49 384 48V464C384 490.5 362.5 512 336 512H240V432C240 405.5 218.5 384 192 384C165.5 384 144 405.5 144 432V512H48C21.49 512 0 490.5 0 464V48C0 21.49 21.49 0 48 0H336zM64 272C64 280.8 71.16 288 80 288H112C120.8 288 128 280.8 128 272V240C128 231.2 120.8 224 112 224H80C71.16 224 64 231.2 64 240V272zM176 224C167.2 224 160 231.2 160 240V272C160 280.8 167.2 288 176 288H208C216.8 288 224 280.8 224 272V240C224 231.2 216.8 224 208 224H176zM256 272C256 280.8 263.2 288 272 288H304C312.8 288 320 280.8 320 272V240C320 231.2 312.8 224 304 224H272C263.2 224 256 231.2 256 240V272zM80 96C71.16 96 64 103.2 64 112V144C64 152.8 71.16 160 80 160H112C120.8 160 128 152.8 128 144V112C128 103.2 120.8 96 112 96H80zM160 144C160 152.8 167.2 160 176 160H208C216.8 160 224 152.8 224 144V112C224 103.2 216.8 96 208 96H176C167.2 96 160 103.2 160 112V144zM272 96C263.2 96 256 103.2 256 112V144C256 152.8 263.2 160 272 160H304C312.8 160 320 152.8 320 144V112C320 103.2 312.8 96 304 96H272z"/>
                            </svg>
                            Similar Companies
                        </h2>
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
                    
                    <!-- Add data source information -->
                    <div class="card" style="grid-column: 1 / -1;">
                        <div style="font-size: 0.8rem; color: #6c757d; text-align: center;">
                            <p>Stock data is for informational purposes only and should not be considered as financial advice.</p>
                            <p>Data source: <a href="https://www.moneycontrol.com/india/stockpricequote/chemicals/ambaniorgochem/AO" target="_blank" style="color: #6c757d; text-decoration: underline;">MoneyControl</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('refresh')) {
                        setTimeout(function() {
                            urlParams.delete('refresh');
                            const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
                            window.location.href = newUrl;
                        }, 500);
                    }
                    
                    const refreshButton = document.querySelector('.refresh-button');
                    if (refreshButton) {
                        refreshButton.addEventListener('mouseenter', function() {
                            this.style.backgroundColor = '#f8f9fa';
                        });
                        refreshButton.addEventListener('mouseleave', function() {
                            this.style.backgroundColor = '';
                        });
                    }
                });
            </script>
           
        </div>
    </section>

    <!-- Team -->
    <section id="team" class="section-4 odd team owl_c">
        <div class="container">
            <div class="row">
                <div class="col-12 align-self-top text-center text-md-left text">
                    <div class="row text-center intro">
                        <div class="col-12">
                            <span class="pre-title m-auto" data-aos="fade-up">We like what we do</span>
                            <h2 style="color:#b73a36;" data-aos="fade-up">Awards and Recognition</h2>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <!--<div class="award_slider">-->
                    <!--    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">-->
                    <!--  <div class="carousel-inner">-->
                    <!--    <div class="carousel-item active">-->
                          
                          
                    <!--      <div class="row items text-left">-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/11.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>NSE Emerge</h4>-->
                    <!--                <p>The SME growth platform</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/12.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>NSE OF India LTD</h4>-->
                    <!--                <p>Honoured with a Grove of 25 trees at trees for Rural Communities, Chintamani, Karnataka, India</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/13.png" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Global Compact Network</h4>-->
                    <!--                <p>To certify that Ambani Organics LTD is an Annual Corporate Member of Global Compact Network</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/14.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Industry Developement</h4>-->
                    <!--                <p>Indian Achievers Award presented to Rakesh Hasmukhlal Shah Managing Director</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                          
                          
                          
                    <!--    </div>-->
                    <!--    <div class="carousel-item">-->
                          
                          
                    <!--      <div class="row items text-left">-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/15.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>The Colour Society</h4>-->
                    <!--                <p>The Colour Society Annual Seminar 2016. Ambani Organics Pvt.Ltd. Silver Technology Partner</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/16.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Indian Small Scale Paint Association</h4>-->
                    <!--                <p>Indian Small Scale Paint Association Maharashtra Region Presented to Mr. Ambani Organics Pvt LTD</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/17.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>NSE</h4>-->
                    <!--                <p>Celebrating Silver Jubliee National Stock Exchange of India Limited</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/18.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Indian Small Scale Paint Association</h4>-->
                    <!--                <p>For Giving Silver Support to One Day Techno- Commercial Seminar Organized by ISSPA Maharashtra Region</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                          
                          
                    <!--    </div>-->
                    <!--    <div class="carousel-item">-->
                          
                          
                    <!--      <div class="row items text-left">-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--                <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                    <img src="assets/images/awards/113.jpeg" alt="Person" class="person">-->
                    <!--                </div>-->
                    <!--                <div class="col-8 align-self-center text-left">-->
                    <!--                    <h4>Indian Paint and Coating Association Maharashtra</h4>-->
                    <!--                    <p>A token of Appreciation for Silver Event Support at Residential Conference, Nashik Breaking Barriers</p>-->
                                        
                    <!--                </div>-->
                    <!--            </div>-->
                            
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/110.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Indian Small Scale Paint Association</h4>-->
                    <!--                <p>For the contribution as a "Event Supporter" on the Occasion of the Presidential Seminar</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/111.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Indian Paint and Coating Association</h4>-->
                    <!--                <p>Certificate of Membership that they are a member in good standing of Indian Paint & Coating Association</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/112.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Indian Small Scale Paint Association Maharashtra</h4>-->
                    <!--                <p>For the Whole Hearted Silver Event Support on the Occasion of the Residential Seminar at Goa</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                          
                          
                    <!--    </div>-->
                    <!--    <div class="carousel-item">-->
                          
                          
                    <!--      <div class="row items text-left">-->
                    <!--        <div class="col-12 col-md-6 p-0">-->
                                
                    <!--            <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/awards/19.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Tasnee<br> </h4>-->
                    <!--                <p>Award for being loyal, the growth we've achieved over the years is because of the contribution as a valuable customer.</p>-->
                                    
                    <!--            </div>-->
                    <!--        </div>-->
                                
                    <!--        </div>-->
                    <!--    </div>-->
                          
                          
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--  <div class="carousel_btn_div">-->
                    <!--     <button class="btn carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">-->
                    <!--        <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                    <!--        <span class="sr-only">Previous</span>-->
                    <!--      </button>-->
                    <!--      <button class="btn carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">-->
                    <!--        <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                    <!--        <span class="sr-only">Next</span>-->
                    <!--      </button>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <!--</div>-->
                    
                    
                    
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n1.jpg" class="card-img-top" alt="NSE Emerge">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">NSE Emerge</h5>-->
                                <!--    <p class="card-text">The SME growth platform</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n5.jpg" class="card-img-top" alt="NSE OF India LTD">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">NSE OF India LTD</h5>-->
                                <!--    <p class="card-text">Honoured with a Grove of 25 trees at trees for Rural Communities, Chintamani, Karnataka, India</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n10.png" class="card-img-top" alt="Global Compact Network">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Global Compact Network</h5>-->
                                <!--    <p class="card-text">To certify that Ambani Organics LTD is an Annual Corporate Member of Global Compact Network</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n4.jpg" class="card-img-top" alt="Industry Development">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Industry Development</h5>-->
                                <!--    <p class="card-text">Indian Achievers Award presented to Rakesh Hasmukhlal Shah Managing Director</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n2.jpg" class="card-img-top" alt="The Colour Society">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">The Colour Society</h5>-->
                                <!--    <p class="card-text">The Colour Society Annual Seminar 2016. Ambani Organics Pvt.Ltd. Silver Technology Partner</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n6.jpg" class="card-img-top" alt="Indian Small Scale Paint Association">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Indian Small Scale Paint Association</h5>-->
                                <!--    <p class="card-text">Indian Small Scale Paint Association Maharashtra Region Presented to Mr. Ambani Organics Pvt LTD</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n7.jpg" class="card-img-top" alt="NSE">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">NSE</h5>-->
                                <!--    <p class="card-text">Celebrating Silver Jubilee National Stock Exchange of India Limited</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n8.jpg" class="card-img-top" alt="Indian Small Scale Paint Association">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Indian Small Scale Paint Association</h5>-->
                                <!--    <p class="card-text">For Giving Silver Support to One Day Techno-Commercial Seminar Organized by ISSPA Maharashtra Region</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n9.jpg" class="card-img-top" alt="Indian Paint and Coating Association Maharashtra">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Indian Paint and Coating Association Maharashtra</h5>-->
                                <!--    <p class="card-text">A token of Appreciation for Silver Event Support at Residential Conference, Nashik Breaking Barriers</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <div class="item">
                            <div class="card">
                                <img src="assets/images/awards/n3.jpg" class="card-img-top" alt="Indian Small Scale Paint Association">
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Indian Small Scale Paint Association</h5>-->
                                <!--    <p class="card-text">For the contribution as a 'Event Supporter' on the Occasion of the Presidential Seminar</p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    
                        <!--<div class="item">-->
                        <!--    <div class="card">-->
                        <!--        <img src="assets/images/awards/111.jpg" class="card-img-top" alt="Indian Paint and Coating Association">-->
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Indian Paint and Coating Association</h5>-->
                                <!--    <p class="card-text">Certificate of Membership that they are a member in good standing of Indian Paint & Coating Association</p>-->
                                <!--</div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    
                        <!--<div class="item">-->
                        <!--    <div class="card">-->
                        <!--        <img src="assets/images/awards/112.jpg" class="card-img-top" alt="Indian Small Scale Paint Association Maharashtra">-->
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Indian Small Scale Paint Association Maharashtra</h5>-->
                                <!--    <p class="card-text">For the Whole Hearted Silver Event Support on the Occasion of the Residential Seminar at Goa</p>-->
                                <!--</div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    
                        <!--<div class="item">-->
                        <!--    <div class="card">-->
                        <!--        <img src="assets/images/awards/19.jpg" class="card-img-top" alt="Tasnee">-->
                                <!--<div class="card-body">-->
                                <!--    <h5 class="card-title">Tasnee</h5>-->
                                <!--    <p class="card-text">Award for being loyal, the growth we've achieved over the years is because of the contribution as a valuable customer.</p>-->
                                <!--</div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <!--<div class="row items text-left">-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/team-1.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>David Cooper</h4>-->
                    <!--                <p>CTO &amp; CO-FOUNDER</p>-->
                    <!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras iaculis diam varius-->
                    <!--                    diam ultricies lacinia.</p>-->
                    <!--                <ul class="navbar-nav social share-list ml-auto">-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-linkedin-in"></i></a>-->
                    <!--                    </li>-->
                    <!--                </ul>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/team-2.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Emma Lopez</h4>-->
                    <!--                <p>CHIEF MARKETING</p>-->
                    <!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras iaculis diam varius-->
                    <!--                    diam ultricies lacinia.</p>-->
                    <!--                <ul class="navbar-nav social share-list ml-auto">-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-linkedin-in"></i></a>-->
                    <!--                    </li>-->
                    <!--                </ul>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="col-12 col-md-6 p-0">-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/team-3.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>Oliver Jones</h4>-->
                    <!--                <p>CHIEF PROCUREMENT</p>-->
                    <!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras iaculis diam varius-->
                    <!--                    diam ultricies lacinia.</p>-->
                    <!--                <ul class="navbar-nav social share-list ml-auto">-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-linkedin-in"></i></a>-->
                    <!--                    </li>-->
                    <!--                </ul>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="row item">-->
                    <!--            <div class="col-4 p-0 pr-3 align-self-center">-->
                    <!--                <img src="assets/images/team-4.jpg" alt="Person" class="person">-->
                    <!--            </div>-->
                    <!--            <div class="col-8 align-self-center text-left">-->
                    <!--                <h4>T. Johnson</h4>-->
                    <!--                <p>CEO &amp; PRESIDENT</p>-->
                    <!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras iaculis diam varius-->
                    <!--                    diam ultricies lacinia.</p>-->
                    <!--                <ul class="navbar-nav social share-list ml-auto">-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>-->
                    <!--                    </li>-->
                    <!--                    <li class="nav-item">-->
                    <!--                        <a href="#" class="nav-link"><i class="fab fa-linkedin-in"></i></a>-->
                    <!--                    </li>-->
                    <!--                </ul>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </section>

    <!-- Units -->
    <!--<section id="units" class="section-5 highlights image-right">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12 col-md-4 pr-md-5 align-self-top text">-->
    <!--                <div data-aos="fade-up" class="row intro aos-init aos-animate">-->
    <!--                    <div class="col-12 p-0">-->
    <!--                        <span class="pre-title m-0">Talk to an expert</span>-->
    <!--                        <h2>Our<br>Business<br>Units</h2>-->
    <!--                        <p>Curabitur convallis, diam a egestas iaculis, neque lorem interdum felis, in viverra lacus-->
    <!--                            tortor in leo.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-12 col-md-4 pr-md-5 align-self-top text">-->
    <!--                <div class="row items">-->
    <!--                    <div data-aos="fade-up" class="col-12 p-0 pr-md-4 item aos-init aos-animate">-->
    <!--                        <div class="contacts">-->
    <!--                            <h4>Branch</h4>-->
    <!--                            <ul class="navbar-nav">-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="nav-link">-->
    <!--                                        <i class="fa-solid fa-phone mr-2"></i>-->
    <!--                                        +1 (305) 1234-5678-->
    <!--                                    </a>-->
    <!--                                </li>-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="nav-link">-->
    <!--                                        <i class="fas fa-envelope mr-2"></i>-->
    <!--                                        hello@example.com-->
    <!--                                    </a>-->
    <!--                                </li>-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="nav-link">-->
    <!--                                        <i class="fas fa-map-marker-alt mr-2"></i>-->
    <!--                                        Main Avenue, 987-->
    <!--                                    </a>-->
    <!--                                </li>-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="mt-2 btn outline-button" data-toggle="modal"-->
    <!--                                        data-target="#map">VIEW MAP</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-12 col-md-4 pr-md-5 align-self-top text">-->
    <!--                <div class="row items">-->
    <!--                    <div data-aos="fade-up" class="col-12 p-0 pr-md-4 item aos-init aos-animate">-->
    <!--                        <div class="contacts">-->
    <!--                            <h4>Headquarters</h4>-->
    <!--                            <ul class="navbar-nav">-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="nav-link">-->
    <!--                                        <i class="fa-solid fa-phone mr-2"></i>-->
    <!--                                        +1 (305) 1234-5678-->
    <!--                                    </a>-->
    <!--                                </li>-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="nav-link">-->
    <!--                                        <i class="fas fa-envelope mr-2"></i>-->
    <!--                                        hello@example.com-->
    <!--                                    </a>-->
    <!--                                </li>-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="nav-link">-->
    <!--                                        <i class="fas fa-map-marker-alt mr-2"></i>-->
    <!--                                        Main Avenue, 987-->
    <!--                                    </a>-->
    <!--                                </li>-->
    <!--                                <li class="nav-item">-->
    <!--                                    <a href="#" class="mt-2 btn outline-button" data-toggle="modal"-->
    <!--                                        data-target="#map">VIEW MAP</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <!-- Contact -->
    <!--<section id="contact" class="section-6 odd form contact">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12 col-md-8 pr-md-5 align-self-center text">-->
    <!--                <div class="row intro">-->
    <!--                    <div class="col-12 p-0">-->
    <!--                        <span class="pre-title m-0">Send a message</span>-->
    <!--                        <h2>Get in <span class="featured"><span>Touch</span></span></h2>-->
    <!--                        <p>We will respond to your message as soon as possible.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="row">-->
    <!--                    <div class="col-12 p-0">-->
    <!--                        <form action="" id="nexgen-simple-form"-->
    <!--                            class="nexgen-simple-form">-->
    <!--                            <input type="hidden" name="section" value="nexgen_form">-->

    <!--                            <input type="hidden" name="reCAPTCHA">-->
                                <!-- Remove this field if you want to disable recaptcha -->

    <!--                            <div class="row form-group-margin">-->
    <!--                                <div class="col-12 col-md-6 m-0 p-2 input-group">-->
    <!--                                    <input type="text" name="name" class="form-control field-name"-->
    <!--                                        placeholder="Name">-->
    <!--                                </div>-->
    <!--                                <div class="col-12 col-md-6 m-0 p-2 input-group">-->
    <!--                                    <input type="email" name="email" class="form-control field-email"-->
    <!--                                        placeholder="Email">-->
    <!--                                </div>-->
    <!--                                <div class="col-12 col-md-6 m-0 p-2 input-group">-->
    <!--                                    <input type="text" name="phone" class="form-control field-phone"-->
    <!--                                        placeholder="Phone">-->
    <!--                                </div>-->
    <!--                                <div class="col-12 col-md-6 m-0 p-2 input-group">-->
    <!--                                    <i class="fa-solid fa-chevron-down icon-arrow-down mr-3"></i>-->
                                        
    <!--                                    <select name="info" class="form-control field-info">-->
    <!--                                        <option value="" selected="" disabled="">More Info</option>-->
    <!--                                        <option>Audit &amp; Assurance</option>-->
    <!--                                        <option>Financial Advisory</option>-->
    <!--                                        <option>Analytics and M&amp;A</option>-->
    <!--                                        <option>Middle Marketing</option>-->
    <!--                                        <option>Legal Consulting</option>-->
    <!--                                        <option>Regulatory Risk</option>-->
    <!--                                        <option>Other</option>-->
    <!--                                    </select>-->
    <!--                                </div>-->
    <!--                                <div class="col-12 m-0 p-2 input-group">-->
    <!--                                    <textarea name="message" class="form-control field-message"-->
    <!--                                        placeholder="Message"></textarea>-->
    <!--                                </div>-->
    <!--                                <div class="col-12 col-12 m-0 p-2 input-group">-->
    <!--                                    <span class="form-alert" style="display: none;"></span>-->
    <!--                                </div>-->
    <!--                                <div class="col-12 input-group m-0 p-2">-->
    <!--                                    <a class="btn primary-button">SEND</a>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-12 col-md-4">-->
    <!--                <div class="contacts">-->
    <!--                    <h4>Example Inc.</h4>-->
    <!--                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
    <!--                    <p>Praesent diam lacus, dapibus sed imperdiet consectetur.</p>-->
    <!--                    <ul class="navbar-nav">-->
    <!--                        <li class="nav-item">-->
    <!--                            <a href="#" class="nav-link">-->
    <!--                                <i class="fa-solid fa-phone mr-2"></i>-->
    <!--                                +1 (305) 1234-5678-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li class="nav-item">-->
    <!--                            <a href="#" class="nav-link">-->
    <!--                                <i class="fas fa-envelope mr-2"></i>-->
    <!--                                hello@example.com-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li class="nav-item">-->
    <!--                            <a href="#" class="nav-link">-->
    <!--                                <i class="fas fa-map-marker-alt mr-2"></i>-->
    <!--                                Main Avenue, 987-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li class="nav-item">-->
    <!--                            <a href="#" class="mt-2 btn outline-button" data-toggle="modal" data-target="#map">VIEW-->
    <!--                                MAP</a>-->
    <!--                        </li>-->
    <!--                    </ul>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    
  

<?php require 'footer.php'; ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
 </script>
 