<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .vending-machine {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 500px;
            text-align: center;
            color: #333;
        }
        h2 {
            color: #0066cc;
        }
        fieldset {
            border: 1px solid #0066cc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }
        legend {
            color: #0066cc;
            font-weight: bold;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        .quantity-field {
            margin-top: 10px;
        }
        .submit-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="vending-machine">
    <h2>Vendo Machine</h2>

    <form action="" method="post">
        <fieldset>
            <legend>Products</legend>
            <label>
                <input type="checkbox" name="items[]" value="Coke"> Coke - ₱15
            </label>
            <label>
                <input type="checkbox" name="items[]" value="Sprite"> Sprite - ₱20
            </label>
            <label>
                <input type="checkbox" name="items[]" value="Royal"> Royal - ₱20
            </label>
            <label>
                <input type="checkbox" name="items[]" value="Pepsi"> Pepsi - ₱15
            </label>
            <label>
                <input type="checkbox" name="items[]" value="Mountain Dew"> Mountain Dew - ₱20
            </label>
        </fieldset>

        <fieldset>
            <legend>Customize Your Order</legend>
            <label for="drinkSize">Size:</label>
            <select name="drinkSize" id="drinkSize">
                <option value="regular">Regular</option>
                <option value="upsized">Up-Sized (+₱5)</option>
                <option value="jumbo">Jumbo (+₱10)</option>
            </select>
            
            <label for="amount" class="quantity-field">Quantity:</label>
            <input type="number" name="amount" id="amount" min="0" value="0">
            
            <button type="submit" name="submitOrder" class="submit-btn">Order Now</button>
        </fieldset>
    </form>

    <?php
    if (isset($_POST['submitOrder'])):
      
        $priceList = [
            'Coke' => 15,
            'Sprite' => 20,
            'Royal' => 20,
            'Pepsi' => 15,
            'Mountain Dew' => 20,
        ];

        // Gather inputs
        $selectedItems = $_POST['items'] ?? [];
        $selectedSize = $_POST['drinkSize'];
        $itemCount = (int)$_POST['amount'];

      
        if (empty($selectedItems)) {
            echo "<hr><p style='color: red;'>Please select at least one drink.</p>";
        } elseif ($itemCount <= 0) {
            echo "<hr><p style='color: red;'>Please choose a valid quantity.</p>";
        } elseif ($itemCount >= 100) { 
            echo "<hr><p style='color: red;'>Please choose a smaller quantity.</p>";
        } else {
            
            $additionalCost = ($selectedSize === 'upsized') ? 5 : (($selectedSize === 'jumbo') ? 10 : 0);

        
            $totalDrinks = 0;
            $grandTotal = 0;

            echo "<hr><h3>Your Order Summary</h3><ul>";

            foreach ($selectedItems as $drink) {
                $basePrice = $priceList[$drink];
                $totalCost = ($basePrice + $additionalCost) * $itemCount;
                $grandTotal += $totalCost;
                $totalDrinks += $itemCount;

                $sizeLabel = ucfirst($selectedSize);
                echo "<li>{$itemCount} pieces of {$sizeLabel} {$drink} = ₱{$totalCost}</li>";
            }

            echo "</ul>";
            echo "<p><strong>Total Items:</strong> {$totalDrinks}</p>";
            echo "<p><strong>Total Amount:</strong> ₱{$grandTotal}</p>";
        }
    endif;
    ?>
</div>

</body>
</html>
