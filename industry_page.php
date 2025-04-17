<?php require 'header.php'; ?>

<!-- Add custom CSS for table styling -->
<style>
    .industry-section {
        padding: 40px 0;
        background-color: #f8f9fa;
    }
    
    .industry-header {
        position: relative;
        margin-bottom: 30px;
        padding-bottom: 15px;
        color: #333;
        font-weight: 600;
    }
    
    .industry-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #28a745, #17a2b8);
    }
    
    .custom-table {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border: none;
    }
    
    .custom-table thead {
        background: linear-gradient(90deg, #343a40, #495057);
    }
    
    .custom-table thead th {
        color: white;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 15px;
    }
    
    .custom-table tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,0.02);
    }
    
    .custom-table tbody tr:hover {
        background-color: rgba(0,0,0,0.05);
    }
    
    .custom-table td {
        padding: 15px;
        vertical-align: middle;
        border-color: #e9ecef;
    }
    
    .product-img {
        max-width: 150px;
        border-radius: 5px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .product-img:hover {
        transform: scale(1.05);
    }
    
    .alert {
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        padding: 20px;
    }
    
    .breadcrumb-section {
        margin-top: 80px; /* Adjust this value based on your header height */
        padding-top: 15px;
        padding-bottom: 15px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    
    .breadcrumb {
        margin-bottom: 0;
        background-color: transparent;
        padding: 0;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
    
    .industry-container {
        padding-top: 20px;
    }
    
    @media (max-width: 768px) {
        .breadcrumb-section {
            margin-top: 60px; 
        }
    }
    
    /* Industry slogan styles */
    .industry-slogan {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .industry-slogan:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(to bottom, #28a745, #17a2b8);
    }
    
    .slogan-text {
        font-size: 1.2rem;
        font-weight: 300;
        font-style: italic;
        color: #495057;
        margin-bottom: 0;
        line-height: 1.6;
    }
    
    .slogan-text strong {
        color: #28a745;
        font-weight: 600;
    }
    
    .slogan-icon {
        font-size: 1.5rem;
        color: #17a2b8;
        margin-right: 10px;
        vertical-align: middle;
    }
    
    /* Product modal styles */
    .product-name-link {
        color: #28a745;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .product-name-link:hover {
        color: #218838;
        text-decoration: underline;
    }
    
    .modal-product-title {
        color: #343a40;
        font-weight: 700;
        border-bottom: 2px solid #28a745;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    
    .modal-product-specs {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .modal-product-specs table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .modal-product-specs th {
        background-color: #e9ecef;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        color: #495057;
        border: 1px solid #dee2e6;
    }
    
    .modal-product-specs td {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
    }
    
    .modal-product-specs tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    .modal-product-description {
        line-height: 1.8;
        color: #495057;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-top: 30px;
    }
    
    .modal-product-description p {
        margin-bottom: 15px;
    }
    
    .modal-product-info {
        background-color: #e9ecef;
        border-left: 4px solid #28a745;
        padding: 15px;
        margin-top: 20px;
        border-radius: 0 8px 8px 0;
    }
    
    .modal-product-info p {
        margin-bottom: 8px;
    }
    
    .modal-product-info strong {
        color: #343a40;
    }
    
    .modal-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #28a745;
    }
    
    .modal-footer {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-top: 1px solid #dee2e6;
    }
    
    .product-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .product-meta-item {
        background-color: #e9ecef;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 0.9rem;
        color: #495057;
    }
    
    .product-meta-item i {
        color: #28a745;
        margin-right: 5px;
    }
    
    /* Industry description section */
    .industry-description {
        background-color: #fff;
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }
    
    .industry-description h4 {
        color: #343a40;
        margin-bottom: 15px;
        font-weight: 600;
        border-bottom: 2px solid #28a745;
        padding-bottom: 10px;
        display: inline-block;
    }
    
    .industry-description p {
        color: #495057;
        line-height: 1.8;
    }
    
    /* Product category section */
    .product-category {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .product-category h5 {
        color: #343a40;
        margin-bottom: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    
    .product-category h5 i {
        color: #28a745;
        margin-right: 10px;
    }
    
    @media (max-width: 768px) {
        .slogan-text {
            font-size: 1rem;
        }
        
        .modal-dialog {
            margin: 10px;
        }
        
        .product-meta {
            flex-direction: column;
        }
        
        .product-meta-item {
            margin-bottom: 10px;
        }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php#gallery">Industries</a></li>
                <?php if(isset($_GET['industry_name'])): ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars(urldecode($_GET['industry_name'])); ?></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>

<div class="industry-section">
    <div class="container">
        <?php
            // Database Connection
            $mysqli = new mysqli("localhost", "learnsupport_ambani", "2EfH1t!L8:v5", "learnsupport_ambaniorganic_statging");
            $mysqli->set_charset("utf8mb4");

            
            
            // Check connection
            if ($mysqli->connect_error) 
            {
                die("<div class='alert alert-danger' role='alert'>
                    <i class='fas fa-exclamation-triangle me-2'></i> Connection failed: " . $mysqli->connect_error . "
                </div>");
            }
            
            if (isset($_GET['industry_name'])) 
            {
                $industry_name = urldecode($_GET['industry_name']);
                
              
                
                // Define industry slogans
                $industry_slogans = [
                    "Composite FRP Industry" => [
                        "<i class='fas fa-layer-group slogan-icon'></i> <strong>Strengthening innovations</strong> with advanced composite solutions.",
                        "<i class='fas fa-cogs slogan-icon'></i> Powering the <strong>future of lightweight materials</strong> with superior chemistry.",
                        "<i class='fas fa-industry slogan-icon'></i> <strong>Enhancing performance</strong> in every fiber and resin."
                    ],
                    "Paint Industry" => [
                        "<i class='fas fa-paint-roller slogan-icon'></i> <strong>Coloring the world</strong> with innovative chemical solutions.",
                        "<i class='fas fa-tint slogan-icon'></i> The <strong>science behind beautiful finishes</strong> and lasting protection.",
                        "<i class='fas fa-palette slogan-icon'></i> <strong>Advancing coating technology</strong> for superior performance."
                    ],
                    "Textile Industry" => [
                        "<i class='fas fa-tshirt slogan-icon'></i> <strong>Enhancing fabrics</strong> with innovative chemical solutions.",
                        "<i class='fas fa-thread slogan-icon'></i> The <strong>chemistry of comfort</strong> and performance in textiles.",
                        "<i class='fas fa-ruler slogan-icon'></i> <strong>Transforming fibers</strong> into exceptional textile products."
                    ],
                    "Paper Industry" => [
                        "<i class='fas fa-scroll slogan-icon'></i> <strong>Improving paper quality</strong> with advanced chemical technology.",
                        "<i class='fas fa-file slogan-icon'></i> The <strong>science behind stronger</strong>, brighter, and better paper.",
                        "<i class='fas fa-recycle slogan-icon'></i> <strong>Sustainable solutions</strong> for modern paper production."
                    ],
                    "Adhesive Industry" => [
                        "<i class='fas fa-tape slogan-icon'></i> <strong>Creating stronger bonds</strong> with innovative adhesive chemistry.",
                        "<i class='fas fa-link slogan-icon'></i> The <strong>science of adhesion</strong> for every application.",
                        "<i class='fas fa-puzzle-piece slogan-icon'></i> <strong>Connecting materials</strong> with advanced bonding solutions."
                    ],
                    "Carpet Industry" => [
                        "<i class='fas fa-rug slogan-icon'></i> <strong>Enhancing carpet performance</strong> with specialized chemistry.",
                                                "<i class='fas fa-home slogan-icon'></i> The <strong>foundation of comfort</strong> and durability in flooring.",
                        "<i class='fas fa-broom slogan-icon'></i> <strong>Advancing carpet technology</strong> for superior performance and longevity."
                    ],
                    "Construction Industry" => [
                        "<i class='fas fa-hard-hat slogan-icon'></i> <strong>Building stronger foundations</strong> with advanced chemical solutions.",
                        "<i class='fas fa-building slogan-icon'></i> The <strong>chemistry behind modern construction</strong> materials and methods.",
                        "<i class='fas fa-hammer slogan-icon'></i> <strong>Enhancing durability</strong> in every construction project."
                    ],
                    "Wood Industry" => [
                        "<i class='fas fa-tree slogan-icon'></i> <strong>Preserving natural beauty</strong> with advanced wood treatment solutions.",
                        "<i class='fas fa-chair slogan-icon'></i> The <strong>science of wood protection</strong> and enhancement.",
                        "<i class='fas fa-leaf slogan-icon'></i> <strong>Extending the life</strong> of wood products with innovative chemistry."
                    ],
                    "Pharmacetical Industry" => [
                        "<i class='fas fa-capsules slogan-icon'></i> <strong>Supporting healthcare innovation</strong> with pharmaceutical-grade chemicals.",
                        "<i class='fas fa-flask slogan-icon'></i> The <strong>chemistry behind healing</strong> and wellness.",
                        "<i class='fas fa-heartbeat slogan-icon'></i> <strong>Advancing pharmaceutical science</strong> with quality chemical solutions."
                    ]
                ];
                
                // Display industry header
                echo "<h2 class='industry-header text-center'>" . htmlspecialchars($industry_name) . "</h2>";
                
                // Display a random slogan from the array for this industry
                if (isset($industry_slogans[$industry_name]) && !empty($industry_slogans[$industry_name])) {
                    $random_slogan = $industry_slogans[$industry_name][array_rand($industry_slogans[$industry_name])];
                    echo "<div class='industry-slogan'>
                            <p class='slogan-text'>" . $random_slogan . "</p>
                          </div>";
                }
                
                // Display industry description
                if (isset($industry_descriptions[$industry_name])) {
                    echo "<div class='industry-description'>
                            <h4><i class='fas fa-info-circle'></i> Industry Overview</h4>
                            <p>" . $industry_descriptions[$industry_name] . "</p>
                          </div>";
                }
                
                // Define mapping of industries to relevant product tables
                $industry_product_tables = [
                    "Composite FRP Industry" => ["compositeFRPIndOne", "compositeFRPIndTwo"],
                    "Paint Industry" => ["paintIndustry"],
                    "Textile Industry" => ["textileIndustry"],
                    "Paper Industry" => ["paperIndustry"],
                    "Adhesive Industry" => ["adhesiveIndustry"],
                    "Carpet Industry" => ["carpetIndustry"],
                    "Construction Industry" => ["constructionIndustry"],
                    "Wood Industry" => ["woodIndustry"],
                    "Personal Care Home Care and Fragrances" => ["indPersonalhomecare"]
                ];
                
                // Define product table display names
                $table_display_names = [
                    "organicPeroxides" => "Organic Peroxides",
                    "paintDriers" => "Paint Driers",
                    "accelerators" => "Accelerators",
                    "acrylicEmulsion" => "Acrylic Emulsion",
                    "silverIonDisinfectant" => "Silver-Ion Disinfectants",
                    "prodPharmeceutical" => "Pharmaceutical Products"
                ];
                
                // Check if the industry exists in our mapping
                if (array_key_exists($industry_name, $industry_product_tables)) {
    $relevant_tables = $industry_product_tables[$industry_name];
    
    // Store all products for modal use
    $all_products = [];
    $product_id_counter = 1;
    
    // Loop through each relevant product table for this industry
    foreach ($relevant_tables as $table) {
        $table_display_name = isset($table_display_names[$table]) ? $table_display_names[$table] : ucfirst($table);
        
        $sql = "SELECT * FROM $table";
        $stmt = $mysqli->prepare($sql);
        
        if (!$stmt) {
            echo "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle me-2'></i> Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "
            </div>";
            continue; // Skip to next table
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "<div class='table-responsive container'>";
            echo "<table class='table table-striped table-bordered custom-table'>";
            
            // Table headers
            $field_info = $result->fetch_fields();
            echo "<thead><tr>";
            foreach ($field_info as $field) {
                if (!in_array($field->name, ['status', 'createdOn', 'createdON', 'id'])) {
                    echo "<th class='text-center'>" . formatFieldName($field->name) . "</th>";
                }
            }
            echo "</tr></thead><tbody>";
            
            // Table body rows
            while ($row = $result->fetch_assoc()) {
                $row['product_category'] = $table_display_name;
                $row['unique_id'] = $product_id_counter++;
                $all_products[] = $row;
                
                echo "<tr>";
                foreach ($row as $key => $value) {
                    if (!in_array($key, ['status', 'createdOn', 'createdON', 'id', 'product_category', 'unique_id'])) {
                        
                        // imageURL
                        if ($key == 'imageURL' && !empty($value)) {
                            echo "<td class='text-center'><img src='" . htmlspecialchars($value) . "' alt='Product Image' class='img-fluid product-img'></td>";
                        } 
                        // product name clickable
                        else if ($key == 'product') {
                            echo "<td class='text-left'><a href='#' class='product-name-link' data-toggle='modal' data-target='#productModal" . $row['unique_id'] . "'>" . htmlspecialchars($value) . "</a></td>";
                        }
                        // application text
                        else if ($key == 'application') {
                            echo "<td class='text-left'>" . htmlspecialchars($value) . "</td>";
                        }
                        // other values
                        else {
                            $class = is_numeric($value) || $value == "-" ? 'text-center' : 'text-left';
                            echo "<td class='{$class}'>" . htmlspecialchars($value) . "</td>";
                        }
                    }
                }
                echo "</tr>";
            }
            
            echo "</tbody></table>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-info'>
                <i class='fas fa-info-circle me-2'></i> No " . htmlspecialchars($table_display_name) . " products found for this industry.
            </div>";
        }

        echo "</div>"; // Close container or product-category div
        $stmt->close();
    }


                    
                    // Create modals for each product
                    foreach ($all_products as $product) {
                        // Generate product-specific descriptions based on product type
                        $product_description = '';
                        $additional_info = '';
                        $acronym = '';
                        
                        // Set default descriptions if specific ones aren't available
                        if (strpos($product['product_category'], 'Paint Driers') !== false) {
                            if (stripos($product['product'], 'cobalt') !== false) {
                                $product_description = "Cobalt is an extremely active & most widely used drier in coatings & capable of being used even as a single Drier. It is primarily an oxidation catalyst & acts as a \"Surface Drier\".<br><br>As quantity of Cobalt Drier used is very small, it minimizes discoloration in paints & enamels as compared with other Driers. Cobalt does not discolor white paints as the deep blue color of the cobalt counteracts the yellow of the oils & resins & thereby enhances the whiteness of the paint.";
                                $acronym = "Co";
                            } else if (stripos($product['product'], 'calcium') !== false) {
                                $product_description = "Calcium is an auxiliary drier which improves the activity of primary driers. It functions as a \"Through Drier\" and improves the elasticity of the paint film. It also prevents wrinkling of the paint film.";
                                $acronym = "Ca";
                            } else if (stripos($product['product'], 'zirconium') !== false) {
                                $product_description = "Zirconium is an auxiliary drier which functions as a \"Through Drier\". It improves the drying of the paint film throughout its thickness and helps to prevent wrinkling.";
                                $acronym = "Zr";
                            } else {
                                $product_description = "Combination Dryers are dryers which have more than one metal blended in one material. Thus, the combination drier imparts properties of multiple metals by addition of just a single material.";
                            }
                            $additional_info = "Diluent: White Spirit<br><br>Storage Temperature: Min - 5°C<br>Max - 40°C";
                        } else if (strpos($product['product_category'], 'Organic Peroxides') !== false) {
                            $product_description = "Organic peroxides are organic compounds containing the peroxide functional group (ROOR′). They are used in a wide range of applications, in polymer chemistry, pharmaceutical industry, and many other chemical processes.";
                            $additional_info = "Storage: Store in a cool, dry place away from direct sunlight.<br>Safety: Handle with care. Follow all safety protocols.";
                        } else if (strpos($product['product_category'], 'Accelerators') !== false) {
                            $product_description = "Accelerators are chemical additives that speed up chemical reactions. They are essential in many industrial processes where time efficiency is critical.";
                            $additional_info = "Application: Follow recommended dosage for optimal results.<br>Compatibility: Compatible with most standard industry materials.";
                        } else if (strpos($product['product_category'], 'Acrylic Emulsion') !== false) {
                            $product_description = "Acrylic emulsions are water-based polymer systems widely used in paints, coatings, adhesives, and construction materials. They provide excellent adhesion, flexibility, and durability.";
                            $additional_info = "Environmental Impact: Low VOC content.<br>Application: Suitable for both interior and exterior applications.";
                        } else if (strpos($product['product_category'], 'Silver-Ion Disinfectants') !== false) {
                            $product_description = "Silver-ion disinfectants utilize the natural antimicrobial properties of silver to eliminate harmful microorganisms. They provide long-lasting protection against bacteria, viruses, and fungi.";
                            $additional_info = "Usage: Safe for most surfaces when used as directed.<br>Effectiveness: Continues to work for extended periods after application.";
                        } else if (strpos($product['product_category'], 'Pharmaceutical Products') !== false) {
                            $product_description = "Our pharmaceutical industry products meet the highest standards of purity and quality. They are manufactured under strict quality control to ensure consistency and reliability.";
                            $additional_info = "Compliance: Meets all relevant pharmaceutical industry standards.<br>Quality Control: Each batch undergoes rigorous testing.";
                        }
                        
                        // Create modal for this product
                        echo '
                        <div class="modal fade" id="productModal' . htmlspecialchars($product['unique_id']) . '" tabindex="-1" role="dialog" aria-labelledby="productModalLabel' . htmlspecialchars($product['unique_id']) . '" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title modal-product-title" id="productModalLabel' . htmlspecialchars($product['unique_id']) . '">' . htmlspecialchars($product['product']) . '</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body row">
                                        <!-- Product meta information -->
                                        <div class="product-meta">';
                                           
                                            
                        if (!empty($acronym)) {
                            echo '<div class="product-meta-item">
                                    <i class="fas fa-atom"></i> Acronym: ' . htmlspecialchars($acronym) . '
                                  </div>';
                        }
                        
                        echo '</div>
                                        
                                        <!-- Product specifications table -->
                                        <div class="modal-product-specs">
                                            <h6 class="mb-3"><i class="fas fa-clipboard-list"></i> Product Specifications</h6>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>';
                                                    
                        // Generate table headers based on product type
                        if (strpos($product['product_category'], 'Paint Driers') !== false) {
                            echo '
                                                        <th>Product</th>
                                                        <th>Colour</th>
                                                        <th>Metal Content (± 0.2)</th>
                                                        <th>Non Volatile at 120°C/hr (± 5)</th>
                                                        <th>Specific Gravity at 30°C (± 0.03)</th>
                                                        <th>Viscosity at 30°C (± 3)</th>';
                        } else {
                            // For other product types, dynamically generate headers for key fields
                            $display_fields = [];
                            foreach ($product as $key => $value) {
                                if ($key != 'status' && $key != 'createdOn' && $key != 'createdON' && $key != 'id' && 
                                    $key != 'imageURL' && $key != 'benefitsAnduses' && 
                                    $key != 'product_category' && $key != 'unique_id') {
                                    $display_fields[] = $key;
                                }
                            }
                            
                            foreach ($display_fields as $field) {
                                echo '<th>' . formatFieldName($field) . '</th>';
                            }
                        }
                                                        
                        echo '
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>';
                                                    
                        // Generate table data based on product type
                        if (strpos($product['product_category'], 'Paint Driers') !== false) {
                            echo '
                                                        <td >' . htmlspecialchars($product['product']) . '</td>
                                                        <td>' . (isset($product['color']) ? htmlspecialchars($product['color']) : (isset($product['activeMetal']) && stripos($product['activeMetal'], 'co') !== false ? 'Bluish Violet' : 'Amber')) . '</td>
                                                        <td class="text-center">' . (isset($product['metalContent']) ? htmlspecialchars($product['metalContent']) : '3') . '</td>
                                                        <td class="text-center">' . (isset($product['nonVolatile']) ? htmlspecialchars($product['nonVolatile']) : '15') . '</td>
                                                        <td class="text-center">' . (isset($product['Densityat30']) ? htmlspecialchars($product['Densityat30']) : '0.82') . '</td>
                                                        <td class="text-center">' . (isset($product['Viscocityat30']) ? htmlspecialchars($product['Viscocityat30']) : '12') . '</td>';
                        } else {
                            // For other product types, dynamically generate data for key fields
                            foreach ($display_fields as $field) {
                                //  $class = is_numeric($value) ? 'text-center' : '';
                                 $class = is_numeric($value) || $value == "-" ? 'text-center' : '';
                                echo '<td class="'.$class.'">' . htmlspecialchars($product[$field]) . '</td>';
                            }
                        }
                                                        
                        echo '
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>';
                                        

                                        

                        // Add application info if available
                        // if (isset($product['application']) && !empty($product['application'])) {
                        //     echo '<div class="modal-product-description">';
                        //     echo '<h6 class="mt-4 mb-2"><i class="fas fa-tasks"></i> Applications</h6>
                        //           <p>' . nl2br(htmlspecialchars($product['application'])) . '</p>';
                        //     echo '</div>';
                        // }
                        
                        // Add benefits info if available
                        if (isset($product['benefitsAnduses']) && !empty($product['benefitsAnduses'])) {
                            echo '<div class="modal-product-description">';
                            echo '<h6 class="mt-4 mb-2"><i class="fas fa-check-circle"></i> Benefits & Uses</h6>
                                  <p>' . nl2br(htmlspecialchars($product['benefitsAnduses'])) . '</p>';
                            echo '</div>';
                        }
                        
                        if (isset($product['application']) && !empty($product['application'])) {
                        echo '<div class="d-none" style="width: 100%;">';
                        echo '
                            <div class="modal-product-info mt-4">
                                <p>' . $additional_info . '</p>
                            </div>';
                        echo '</div>';
                        }
                        
                                        
                        // Display product image if available
                        if (isset($product['imageURL']) && !empty($product['imageURL'])) {
                            echo '
                                        <div class="text-center mt-4">
                                            <img src="' . htmlspecialchars($product['imageURL']) . '" alt="' . htmlspecialchars($product['product']) . '" class="img-fluid" style="max-height: 200px;">
                                        </div>';
                        }
                                        
                        echo '
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="contact.php?inquiry=' . urlencode($product['product']) . '&industry=' . urlencode($industry_name) . '" class="btn btn-primary">Inquire About This Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                    
                } else {
                    echo "<div class='alert alert-danger'>
                        <i class='fas fa-exclamation-triangle me-2'></i> Invalid industry category.
                    </div>";
                }
            } else {
                echo "<div class='alert alert-warning'>
                    <i class='fas fa-info-circle me-2'></i> Industry category not specified.
                </div>";
            }
            
            // Close the connection
            $mysqli->close();
            
            // Helper function to format field names for display
            function formatFieldName($fieldName) {
                $fieldMap = [
                    'product' => 'Product Name',
                    'chemicalName' => 'Chemical Name',
                    'imageURL' => 'Product Image',
                    'activeOxygen' => 'Active Oxygen',
                    'application' => 'Application',
                    'metalContent' => 'Metal Content',
                    'nonVolatile' => 'Non-Volatile',
                    'benefitsAnduses' => 'Benefits & Uses',
                    'category' => 'Category',
                    'activeMetal' => 'Active Metal',
                    'PerOfSolid' => 'Percentage of Solid',
                    'Densityat30' => 'Density at 30°C',
                    'Viscocityat30' => 'Viscosity at 30°C',
                    'solidPercent' => 'Solid Percentage',
                    'pH' => 'pH Value'
                ];
                
                return isset($fieldMap[$fieldName]) ? $fieldMap[$fieldName] : ucfirst($fieldName);
            }
            
            // Helper function to generate industry-specific application text
            function generateIndustryApplication($product_name, $industry_name, $product_category) {
                // Default application text
                $application_text = "This product is commonly used in the " . $industry_name . " for various applications.";
                
                // Industry-specific applications
                $industry_applications = [
                    "Composite FRP Industry" => [
                        "Organic Peroxides" => "In the Composite FRP industry, this organic peroxide serves as an initiator for polyester and vinyl ester resins, enabling the curing process. It's essential for manufacturing boat hulls, automotive parts, wind turbine blades, and construction panels.",
                        "Accelerators" => "This accelerator enhances the curing rate of composite materials, reducing production time while maintaining quality. It's particularly valuable in pultrusion, filament winding, and RTM (Resin Transfer Molding) processes."
                    ],
                    "Paint Industry" => [
                        "Paint Driers" => "In the paint industry, this drier catalyzes the oxidation and polymerization of alkyd resins, reducing drying time and improving film formation. It's essential for producing high-quality architectural and industrial coatings.",
                        "Acrylic Emulsion" => "This acrylic emulsion serves as a binder in water-based paints, providing excellent adhesion, durability, and weather resistance. It's used in premium interior and exterior paints, offering low VOC and environmental benefits."
                    ],
                    "Textile Industry" => [
                        "Acrylic Emulsion" => "In textile manufacturing, this acrylic emulsion is used for fabric coating, providing water resistance, increased durability, and improved hand feel. It's applied in technical textiles, upholstery, and performance fabrics.",
                        "Silver-Ion Disinfectants" => "This silver-ion disinfectant provides antimicrobial properties to textiles, making them resistant to odor-causing bacteria and fungi. It's particularly valuable in sportswear, healthcare textiles, and home textiles."
                    ],
                    "Paper Industry" => [
                        "Acrylic Emulsion" => "In paper production, this acrylic emulsion improves surface properties, water resistance, and printability. It's used in specialty papers, packaging, and coated papers for enhanced performance.",
                        "Organic Peroxides" => "This organic peroxide assists in pulp bleaching processes, providing efficient lignin removal while minimizing fiber damage. It contributes to producing brighter, stronger paper with improved optical properties."
                    ],
                    "Adhesive Industry" => [
                        "Acrylic Emulsion" => "This acrylic emulsion serves as a base for pressure-sensitive adhesives, providing excellent tack, peel strength, and cohesion. It's used in tapes, labels, and construction adhesives.",
                        "Organic Peroxides" => "In adhesive formulations, this organic peroxide acts as a crosslinking agent, improving heat resistance, chemical resistance, and bond strength in structural and specialty adhesives."
                    ],
                    "Carpet Industry" => [
                        "Acrylic Emulsion" => "This acrylic emulsion is used in carpet backing systems, providing tuft lock, dimensional stability, and durability. It enhances the performance and longevity of residential and commercial carpeting.",
                        "Silver-Ion Disinfectants" => "This silver-ion disinfectant provides antimicrobial protection to carpets, preventing the growth of bacteria, mold, and mildew. It's particularly valuable in healthcare, hospitality, and high-traffic commercial environments."
                    ],
                    "Construction Industry" => [
                        "Acrylic Emulsion" => "In construction applications, this acrylic emulsion is used in cementitious waterproofing systems, elastomeric coatings, and concrete admixtures. It improves flexibility, adhesion, and weather resistance.",
                        "Organic Peroxides" => "This organic peroxide is used in the curing of polymer-modified concrete and mortars, enhancing strength, chemical resistance, and durability in infrastructure and building applications."
                    ],
                    "Wood Industry" => [
                        "Organic Peroxides" => "In wood processing, this organic peroxide assists in bleaching processes and in the curing of coatings and finishes. It helps achieve desired appearance while maintaining wood integrity.",
                        "Silver-Ion Disinfectants" => "This silver-ion disinfectant provides long-lasting protection against wood-degrading fungi and bacteria. It's used in wood preservation treatments for furniture, flooring, and structural timber."
                    ],
                    "Pharmacetical Industry" => [
                        "Pharmaceutical Products" => "This pharmaceutical-grade product meets stringent purity requirements for use in drug formulation and manufacturing processes. It's essential for producing safe and effective medications.",
                        "Silver-Ion Disinfectants" => "In pharmaceutical environments, this silver-ion disinfectant provides surface sanitization and microbial control. It's used in clean rooms, manufacturing areas, and medical device production."
                    ]
                ];
                
                // Check if we have a specific application for this industry and product category
                if (isset($industry_applications[$industry_name]) && 
                    isset($industry_applications[$industry_name][$product_category])) {
                    return $industry_applications[$industry_name][$product_category];
                }
                
                // If no specific application is found, return the default text
                return $application_text;
            }
        ?>
    </div>
</div>

<!-- Add Font Awesome if not already included -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    document.querySelectorAll("td").forEach(function(cell) {
      const text = cell.textContent.trim();
      if (
          /^-?\d+(\.\d+)?%?$/.test(text) ||                                              // Numbers or percentages
          /^-?\d+(\.\d+)?\s*[\u00B1±]\s*-?\d+(\.\d+)?%?$/.test(text) ||                  // ± ranges
          /^-?\d+(\.\d+)?%?\s*[\-–—]\s*-?\d+(\.\d+)?%?(\s*\(.+\))?$/.test(text) ||       // Numeric ranges
          /^MIN\s*\d+(\.\d+)?%?$/.test(text.toUpperCase()) ||                           // MIN 99%
          /^OPEN$/i.test(text) ||                                                       // "Open"
          /^cat\d*$/i.test(text) ||                                                     // cat1, cat2
          /^(\d+\.)+\d+$/.test(text) ||                                                 // Versions like 1.0.21
          /^\d+\+%?$/.test(text) ||                                                     // 12+ or 12+%
          /^N[\s\/]?A$/i.test(text) ||                                                  // N A, N/A
          /^unknown$/i.test(text)                                                       // Optional: catch "unknown"
        )
          {
            cell.classList.remove("text-left");
            cell.classList.add("text-center");
            cell.style.textAlign = "center";
            cell.style.setProperty("text-align", "center", "important");
          }
        });


</script>


<!-- Add custom JavaScript for modal functionality -->
<script>
$(document).ready(function() {
    // Enhance modal functionality
    $('.product-name-link').click(function(e) {
        e.preventDefault();
        const modalId = $(this).data('target');
        $(modalId).modal('show');
    });
    
    // Add animation to modal opening
    $('.modal').on('show.bs.modal', function () {
        $(this).find('.modal-dialog').css({
            transform: 'scale(0.8)',
            opacity: 0
        });
        
        setTimeout(() => {
            $(this).find('.modal-dialog').css({
                transform: 'scale(1)',
                opacity: 1,
                transition: 'all 0.3s ease'
            });
        }, 50);
    });
    
    // Reset animation on modal close
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('.modal-dialog').css({
            transform: '',
            opacity: '',
            transition: ''
        });
    });
    
    // Make table rows clickable to open the modal
    $('.custom-table tbody tr').click(function() {
        const productLink = $(this).find('.product-name-link');
        if (productLink.length) {
            productLink.click();
        }
    });
});
</script>

<?php require 'footer.php'; ?>

