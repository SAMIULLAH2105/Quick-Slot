<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/x-icon" href="../Images/logo.png" />
    <title>Laboratory Tests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f2f2f2; */
            
            background-image: linear-gradient(to top,  #5b54b4 0%, #c4dcfe 25%, #c4dcfe 85%,#4a77b7 100%); 
            
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .test {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        .test h2 {
            color: #007bff;
            margin-top: 0;
        }
        .test p {
            color: #666;
        }
        .test .hospital-info {
            margin-top: 10px;
        }
        .hospital {
            background-color: #f9f9f9;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .hospital h3 {
            color: #333;
            margin: 0 0 5px 0;
        }
        .hospital p {
            margin: 0;
            color: #666;
        }
        .header {
            background-color: rgb(11, 11, 42);
            position: sticky;
            top: 1px;
            color: rgb(255, 255, 255);
            min-height: 10vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0px 150px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        header h1 {
            color: white;
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            .test {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>QUICK SLOT</h1>
    </header>
    <div class="container">
        <h1>Laboratory Tests</h1>
        
        <?php
        // Define an array of tests with their respective descriptions and prices in different hospitals
        $tests = array(
            "Blood Test" => array(
                "description" => "A blood test is a laboratory analysis performed on a blood sample that is usually extracted from a vein in the arm using a hypodermic needle, or via fingerprick. It is used to evaluate various aspects of your health, such as red and white blood cell counts, cholesterol levels, and blood sugar levels.",
                "hospitals" => array(
                    array("name" => "Dr. Essa Labortary", "price" => 500, "timing" => "8 AM - 4 PM"),
                    array("name" => "Aga Khan Laboratories", "price" => 600, "timing" => "9 AM - 5 PM"),
                    array("name" => "Chughtai Lab", "price" => 650, "timing" => "7 AM - 3 PM")
                )
            ),
            "Urine Test" => array(
                "description" => "A urine test involves examining a urine sample to detect and diagnose a wide range of conditions, such as urinary tract infections, kidney diseases, and diabetes. It can also be used to screen for drugs or monitor the progression of certain diseases.",
                "hospitals" => array(
                    array("name" => "Dr. Essa Labortary", "price" => 450, "timing" => "8 AM - 4 PM"),
                    array("name" => "Aga Khan Laboratories", "price" => 400, "timing" => "9 AM - 5 PM"),
                    array("name" => "Chughtai Lab", "price" => 500, "timing" => "7 AM - 3 PM")
                )
            ),
            "X-ray" => array(
                "description" => "X-ray imaging is a form of electromagnetic radiation used to produce images of the inside of objects. In medicine, X-rays are used to visualize the internal structures of the body, such as bones and organs. They can help diagnose fractures, infections, tumors, and other conditions.",
                "hospitals" => array(
                    array("name" => "Dr. Essa Labortary", "price" => 1000, "timing" => "8 AM - 4 PM"),
                    array("name" => "Aga Khan Laboratories", "price" => 1200, "timing" => "9 AM - 5 PM"),
                    array("name" => "Chughtai Lab", "price" => 1400, "timing" => "7 AM - 3 PM")
                )
            ),
            "MRI" => array(
                "description" => "Magnetic Resonance Imaging (MRI) is a medical imaging technique used to produce detailed images of the body's internal structures. It uses strong magnetic fields and radio waves to generate images of organs, tissues, and other structures. MRIs are often used to diagnose conditions affecting the brain, spine, joints, and soft tissues.",
                "hospitals" => array(
                    array("name" => "Dr. Essa Labortary", "price" => 2000, "timing" => "8 AM - 4 PM"),
                    array("name" => "Aga Khan Laboratories", "price" => 1400, "timing" => "9 AM - 5 PM"),
                    array("name" => "Chughtai Lab", "price" => 2300, "timing" => "7 AM - 3 PM")
                )
            ),
            "CT Scan" => array(
                "description" => "A CT scan, also known as computed tomography, uses a combination of X-rays and computer technology to create cross-sectional images of the body. It provides more detailed images than conventional X-ray exams and can be used to diagnose a wide range of conditions, including tumors, infections, and fractures.",
                "hospitals" => array(
                    array("name" => "Dr. Essa Labortary", "price" => 1600, "timing" => "8 AM - 4 PM"),
                    array("name" => "Aga Khan Laboratories", "price" => 1500, "timing" => "9 AM - 5 PM"),
                    array("name" => "Chughtai Lab", "price" => 1700, "timing" => "7 AM - 3 PM")
                )
            ),
            "Ultrasound" => array(
                "description" => "An ultrasound scan, or sonography, uses high-frequency sound waves to create images of the inside of the body. It is commonly used during pregnancy to monitor fetal development, but it can also be used to examine organs such as the liver, kidneys, and heart.",
                "hospitals" => array(
                    array("name" => "Dr. Essa Labortary", "price" => 1900, "timing" => "8 AM - 4 PM"),
                    array("name" => "Aga Khan Laboratories", "price" => 1800, "timing" => "9 AM - 5 PM"),
                    array("name" => "Chughtai Lab", "price" => 2000, "timing" => "7 AM - 3 PM")
                )
            ),
            // Add more tests as needed
        );

        // Loop through the tests and display each one with hospital details
        foreach ($tests as $test => $data) {
            $description = $data['description'];
            $hospitals = $data['hospitals'];

            echo "<div class='test'>";
            echo "<h2>$test</h2>";
            echo "<p><strong>Description:</strong> $description</p>";
            echo "<div class='hospital-info'>";
            foreach ($hospitals as $hospital) {
                $name = $hospital['name'];
                $price = $hospital['price'];
                $timing = $hospital['timing'];
                echo "<div class='hospital'>";
                echo "<h3>$name</h3>";
                echo "<p><strong>Price:</strong> $price Rupees</p>";
                echo "<p><strong>Timings:</strong> $timing</p>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
