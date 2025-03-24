<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-right: 20px;
        }
        .summary-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2, h3 {
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            margin-top: 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Visa to United States of America</h2>
            <label>Visa Category</label>
            <select>
                <option>Tourist visa B2 (DS-160 form) up to 10 years</option>
            </select>
            <label>Visa Type</label>
            <select>
                <option>Multiple entry</option>
            </select>
            <label>Processing Time</label>
            <select>
                <option>15 business days</option>
            </select>
            <label>Last Name</label>
            <input type="text" placeholder="As shown in passport">
            <label>First Name</label>
            <input type="text" placeholder="As shown in passport">
            <label>Citizenship</label>
            <select>
                <option>India</option>
            </select>
            <label>Email</label>
            <input type="email" placeholder="Enter your email">
            <label>Phone Number</label>
            <input type="text" placeholder="Enter your phone number">
            <label>Date of Entry</label>
            <input type="date">
            <button id="submit">Save and Continue</button>
        </div>
        <div class="summary-container">
            <h3>Basket Details</h3>
            <p>Visa Fee: <span>₹16,096.00</span></p>
            <p>Service Fee: <span>₹5,998.00</span></p>
            <p>Tax: <span>₹1,079.82</span></p>
            <h3>Total: ₹23,173.82</h3>
        </div>
    </div>
    <script>
        document.getElementById("submit").addEventListener("click", function() {
            alert("Form Submitted Successfully!");
        });
    </script>
</body>
</html>
