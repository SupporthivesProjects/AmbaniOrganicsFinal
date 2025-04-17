<?php require 'header.php'; ?>
<!-- Add custom CSS for table styling -->
<style>
    .product-section {
        padding: 40px 0;
        background-color: #f8f9fa;
    }
    
    .product-header {
        position: relative;
        margin-bottom: 30px;
        padding-bottom: 15px;
        color: #333;
        font-weight: 600;
    }
    
    .product-header:after {
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
        background-color: #e9ecef;
        padding: 15px 0;
        margin-bottom: 30px;
    }
    
    /* New styles for product slogan */
    .product-slogan {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .product-slogan:before {
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
<div class="breadcrumb-section" style="margin-top: 90px">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php#products">Products</a></li>
                <?php if(isset($_GET['product_name'])): ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars(urldecode($_GET['product_name'])); ?></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>

<div class="product-section">
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
            
            if (isset($_GET['product_name'])) 
            {
                $product_name = urldecode($_GET['product_name']);
                
                // Whitelist of valid product names and their corresponding tables
                $valid_tables = [
                    "Organic Peroxides" => "organicPeroxides",
                    "Paint Driers" =>  ["paintDriers", "combinationDriers"],
                    "Accelerators" => "accelerators",
                    "Acrylic Emulsion" => "acrylicEmulsion",
                    "SPECIALITY CHEMICALS" => "specialityChemicals",
                    "Salicylates" => ["salicylates", "indPersonalhomecare"]
                ];
                
                if (array_key_exists($product_name, $valid_tables)) {
    $table = $valid_tables[$product_name];
    echo "<h2 class='product-header text-center'>" . htmlspecialchars($product_name) . "</h2>";
    
    // Store all product data for modal use
    $all_products = [];
    $table_index = 0; // Add a table index counter
    
    // Check if this product category has multiple tables
    if (is_array($table)) {
        foreach ($table as $single_table) {
            $sql = "SELECT * FROM $single_table";
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                echo "<div class='alert alert-danger' role='alert'>
                    <i class='fas fa-exclamation-triangle me-2'></i> Prepare failed for table $single_table: (" . $mysqli->errno . ") " . $mysqli->error . "
                </div>";
                continue;
            }
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered custom-table'>";
                
                // Headers
                $field_info = $result->fetch_fields();
                echo "<thead><tr>";
                foreach ($field_info as $field) {
                    if (!in_array($field->name, ['status', 'createdOn', 'createdON', 'id'])) {
                        echo "<th class='text-center'>" . formatFieldName($field->name) . "</th>";
                    }
                }
                echo "</tr></thead><tbody>";
                
                while ($row = $result->fetch_assoc()) {
                    // Create a unique modal ID using table name and product ID
                    $modal_id = $single_table . '_' . $row['id'];
                    
                    // Store source table and modal ID
                    $row['source_table'] = $single_table;
                    $row['modal_id'] = $modal_id;
                    $all_products[] = $row;
                    
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        if (!in_array($key, ['status', 'createdOn', 'createdON', 'id', 'source_table', 'modal_id'])) {
                            if ($key === 'imageURL' && !empty($value)) {
                                echo "<td class='text-center'><img src='" . htmlspecialchars($value) . "' alt='Product Image' class='img-fluid product-img'></td>";
                            } else if ($key === 'product') {
                                echo "<td class='text-left'><a href='#' class='product-name-link' data-toggle='modal' data-target='#productModal" . htmlspecialchars($modal_id) . "'>" . htmlspecialchars($value) . "</a></td>";
                            } else {
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
                    <i class='fas fa-info-circle me-2'></i> No products found in " . ucfirst($single_table) . "!
                </div>";
            }
            $stmt->close();
            $table_index++; // Increment table index
        }
    } else {
        // Single table
        $sql = "SELECT * FROM $table";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle me-2'></i> Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "
            </div>");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered custom-table'>";
            
            // Headers
            $field_info = $result->fetch_fields();
            echo "<thead><tr>";
            foreach ($field_info as $field) {
                if (!in_array($field->name, ['status', 'createdOn', 'createdON', 'id'])) {
                    echo "<th class='text-center'>" . formatFieldName($field->name) . "</th>";
                }
            }
            echo "</tr></thead><tbody>";
            
            $all_products = [];
            while ($row = $result->fetch_assoc()) {
                // Create a unique modal ID using table name and product ID
                $modal_id = $table . '_' . $row['id'];
                
                // Store source table and modal ID
                $row['source_table'] = $table;
                $row['modal_id'] = $modal_id;
                $all_products[] = $row;
                
                echo "<tr>";
                foreach ($row as $key => $value) {
                    if (!in_array($key, ['status', 'createdOn', 'createdON', 'id', 'source_table', 'modal_id'])) {
                        if ($key === 'imageURL' && !empty($value)) {
                            echo "<td class='text-center'><img src='" . htmlspecialchars($value) . "' alt='Product Image' class='img-fluid product-img'></td>";
                        } else if ($key === 'product') {
                            echo "<td class='text-left'><a href='#' class='product-name-link' data-toggle='modal' data-target='#productModal" . htmlspecialchars($modal_id) . "'>" . htmlspecialchars($value) . "</a></td>";
                        } else {
                            $class = is_numeric($value) || $value == "-" ? 'text-center' : 'text-left';
                            echo "<td class='{$class}'>" . htmlspecialchars($value) . "</td>";
                        }
                    }
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
            echo "</div>";
            $stmt->close();
        } else {
            echo "<div class='alert alert-info'>
                <i class='fas fa-info-circle me-2'></i> No products found.
            </div>";
            $stmt->close();
        }
    }
                    
    // Create modals for each product
    foreach ($all_products as $product) {
        // Get the appropriate table name for this product
        $current_table = $product['source_table'];
        $modal_id = $product['modal_id'];
        
        // Generate product-specific descriptions based on product type
        $product_description = '';
        $additional_info = '';
        $acronym = '';
        
        // Set default descriptions if specific ones aren't available
        if ($current_table == 'paintDriers') {
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
            $additional_info = "Temperature: Min - 5°C<br>Max - 40°C";
        } else if ($current_table == 'combinationDriers') {
            $product_description = "Combination Dryers are dryers which have more than one metal blended in one material. Thus, the combination drier imparts properties of multiple metals by addition of just a single material.";
            $additional_info = "Diluent: White Spirit<br><br>Storage Temperature: Min - 5°C<br>Max - 40°C";
        } else if ($current_table == 'organicPeroxides') {
            $product_description = "Organic peroxides are organic compounds containing the peroxide functional group (ROOR′). They are used in a wide range of applications, in polymer chemistry, pharmaceutical industry, and many other chemical processes.";
            $additional_info = "Storage: Store in a cool, dry place away from direct sunlight.<br>Safety: Handle with care. Follow all safety protocols.";
        } else if ($current_table == 'accelerators') {
            $product_description = "Accelerators are chemical additives that speed up chemical reactions. They are essential in many industrial processes where time efficiency is critical.";
            $additional_info = "Application: Follow recommended dosage for optimal results.<br>Compatibility: Compatible with most standard industry materials.";
        } else if ($current_table == 'acrylicEmulsion') {
            $product_description = "Acrylic emulsions are water-based polymer systems widely used in paints, coatings, adhesives, and construction materials. They provide excellent adhesion, flexibility, and durability.";
            $additional_info = "Environmental Impact: Low VOC content.<br>Application: Suitable for both interior and exterior applications.";
        } else if ($current_table == 'silverIonDisinfectant') {
            $product_description = "Silver-ion disinfectants utilize the natural antimicrobial properties of silver to eliminate harmful microorganisms. They provide long-lasting protection against bacteria, viruses, and fungi.";
            $additional_info = "Usage: Safe for most surfaces when used as directed.<br>Effectiveness: Continues to work for extended periods after application.";
        } else if ($current_table == 'prodPharmeceutical' || $current_table == 'indPersonalhomecare') {
            $product_description = "Our Salicylate industry products meet the highest standards of purity and quality. They are manufactured under strict quality control to ensure consistency and reliability.";
            $additional_info = "Compliance: Meets all relevant pharmaceutical industry standards.<br>Quality Control: Each batch undergoes rigorous testing.";
        }
        
        // Create modal for this product
        echo '
        <div class="modal fade" id="productModal' . htmlspecialchars($modal_id) . '" tabindex="-1" role="dialog" aria-labelledby="productModalLabel' . htmlspecialchars($modal_id) . '" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-product-title" id="productModalLabel' . htmlspecialchars($modal_id) . '">' . htmlspecialchars($product['product']) . '</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <!-- Product meta information -->
                        <div class="product-meta"> ';
                        
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
        if ($current_table == 'paintDriers' || $current_table == 'combinationDriers') {
            echo '
                                        <th>Product</th>
                                        <th>Metal Content (± 0.2)</th>
                                        <th>Non Volatile at 120°C/hr (± 5)</th>
                                        <th>Specific Gravity at 30°C (± 0.03)</th> ';
                                        
        } else {
            // For other product types, dynamically generate headers for key fields
            $display_fields = [];
            foreach ($product as $key => $value) {
                if ($key != 'status' && $key != 'createdOn' && $key != 'createdON' && $key != 'id' && 
                     $key != 'imageURL' && $key != 'benefitsAnduses' && 
                     $key != 'source_table' && $key != 'modal_id') {
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
        if ($current_table == 'paintDriers' || $current_table == 'combinationDriers') {
            echo '
                                        <td>' . htmlspecialchars($product['product']) . '</td>
                                        <td>' . (isset($product['metalContent']) ? htmlspecialchars($product['metalContent']) : '3') . '</td>
                                        <td>' . (isset($product['nonVolatile']) ? htmlspecialchars($product['nonVolatile']) : '15') . '</td>
                                        <td>' . (isset($product['specific Gravity']) ? htmlspecialchars($product['specific Gravity']) : '0.82') . '</td>  ';
                                        
        } else {
            // For other product types, dynamically generate data for key fields
            foreach ($display_fields as $field) {
                echo '<td>' . htmlspecialchars($product[$field]) . '</td>';
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
        //     echo '<h6 class="mt-4 mb-2 text-left "><i class="fas fa-tasks"></i> Applications</h6>
        //           <p>' . nl2br(htmlspecialchars($product['application'])) . '</p>';
        //     echo '</div>';

        // }
        
        // Product Description moved below Applications
        if($product_description){
           echo '<h6 class="mt-4 mb-2"><i class="fas fa-info-circle"></i> Product Description</h6>
          <p>' . $product_description . '</p>';
        }
        
        // Add benefits info if available
        if (isset($product['benefitsAnduses']) && !empty($product['benefitsAnduses'])) {
            echo '<div class="modal-product-description">';
            echo '<h6 class="mt-4 mb-2"><i class="fas fa-check-circle"></i> Benefits & Uses</h6>
                  <p>' . nl2br(htmlspecialchars($product['benefitsAnduses'])) . '</p>';
                  echo '</div>';
        }
        
                if($product_description){
                    echo '
                        <div class="" style="width=100%">
                            <div class="modal-product-info mt-4">
                                <p>' . $additional_info . '</p>
                            </div>
                        </div>';
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
                        <a href="contact.php?inquiry=' . urlencode($product['product']) . '" class="btn btn-primary">Inquire About This Product</a>
                    </div>
                </div>
            </div>
        </div>';
    }
} else {
    echo "<div class='alert alert-danger'>
        <i class='fas fa-exclamation-triangle me-2'></i> Invalid product category.
    </div>";
}
            } else {
                echo "<div class='alert alert-warning'>
                    <i class='fas fa-info-circle me-2'></i> Product category not specified.
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
        ?>
    </div>
</div>

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
        })
</script>

<!-- Add Font Awesome if not already included -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
})
</script>

<?php require 'footer.php'; ?>
