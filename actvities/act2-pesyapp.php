<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peys App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        h3 {
            color: #0066cc;
            margin-bottom: 20px;
        }
        .container {
            text-align: center;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
        }
        label {
            margin-bottom: 10px;
            display: block;
            color: #333;
        }
        input[type="range"], input[type="color"] {
            width: 100%;
            margin-bottom: 15px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        #preview {
            display: block;
            margin: 0 auto; 
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .gap {
            margin-top: 20px; 
        }
    </style>
</head>
<body>
    <h3>Peys App</h3>
    <div class="container">
        <img id="preview" src="img/pic.jpg" alt="Image Preview" 
             style="width: <?php echo isset($_POST['sizeRange']) ? intval($_POST['sizeRange']) . 'px' : '160px'; ?>; border: 5px solid <?php echo isset($_POST['slcBorderColor']) ? htmlspecialchars($_POST['slcBorderColor']) : '#000000'; ?>;"><br>
        
        <form method="POST" action="">
            <label for="sizeRange">Select Photo Size:</label>
            <input type="range" id="sizeRange" name="sizeRange" min="100" max="200" 
                   value="<?php echo isset($_POST['sizeRange']) ? $_POST['sizeRange'] : '160'; ?>" step="10">
            
            <div class="gap"></div> 
            
            <label for="slcBorderColor">Select Border Color:</label>
            <input type="color" id="slcBorderColor" name="slcBorderColor" 
                   value="<?php echo isset($_POST['slcBorderColor']) ? $_POST['slcBorderColor'] : '#000000'; ?>">
            
            <button type="submit" name="process">Process</button>
        </form>
    </div>

    <?php
        
        $sizeRange = isset($_POST['sizeRange']) ? intval($_POST['sizeRange']) : 160;
        $borderColor = isset($_POST['slcBorderColor']) ? htmlspecialchars($_POST['slcBorderColor']) : '#000000';
    ?>
</body>
</html>
