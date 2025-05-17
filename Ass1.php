<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number to Words Converter</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #ffe6e6;
            color: #b30000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff0f5;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(255, 0, 0, 0.2);
            width: 100%;
            max-width: 700px;
            text-align: center;
            border: 2px solid #ff4d4d;
        }
        h1 {
            color: #e60000;
        }
        form {
            margin: 20px 0;
        }
        label {
            font-size: 1.2rem;
        }
        input[type="number"] {
            padding: 10px;
            font-size: 1rem;
            width: 80%;
            margin: 10px 0;
            border: 2px solid #ff4d4d;
            border-radius: 10px;
            background-color: #fffafa;
        }
        button {
            background-color: #ff6666;
            color: white;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff3333;
        }
        .result {
            margin-top: 20px;
            font-size: 1.1rem;
            color: #800000;
        }
        .result p {
            margin: 10px 0;
            font-size: 1.1rem;
        }
        .result strong {
            color: #cc0000;
            font-size: 1.3rem;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff5f5;
        }
        th, td {
            border: 1px solid #ffcccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #ff9999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Number to Words Converter</h1>
        <form method="post">
            <label for="number">Enter a number (1 - 100,000,000,000,000,000,000,000,000,000,000,0000):</label>
            <input type="number" id="number" name="number" min="1" max="100,000,000,000,000,000,000,000,000,000,000,0000" required>
            <br>
            <button type="submit">Convert</button>
            <button type="button" onclick="viewHistory()">View History</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $number = $_POST['number'];
            $eng = numberToWordsEnglish($number);
            $kh = numberToWordsKhmer($number);

            echo "<div class='result'>";
            echo "<p><strong>English Pronunciation:</strong> $eng</p>";
            echo "<p><strong>Khmer Pronunciation:</strong> $kh</p>";
            echo "<p><strong>Number Input:</strong> $number</p>";
            echo "</div>";

            // Save to data.txt
            $entry = "$eng | $kh | $number\n";
            file_put_contents("data.txt", $entry, FILE_APPEND);
        }

        function numberToWordsEnglish($number) {
            $words = [
                0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
                6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven',
                12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen',
                20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty',
                60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
            ];
            if ($number < 20) return $words[$number];
            if ($number < 100)
                return $words[$number - $number % 10] . (($number % 10) ? ' ' . $words[$number % 10] : '');
            if ($number < 1000)
                return $words[intval($number / 100)] . ' Hundred' . (($number % 100) ? ' and ' . numberToWordsEnglish($number % 100) : '');
            if ($number < 1000000)
                return numberToWordsEnglish(intval($number / 1000)) . ' Thousand' . (($number % 1000) ? ' ' . numberToWordsEnglish($number % 1000) : '');
            return numberToWordsEnglish(intval($number / 1000000)) . ' Million' . (($number % 1000000) ? ' ' . numberToWordsEnglish($number % 1000000) : '');
        }

        function numberToWordsKhmer($number) {
            $khmerWords = [
                0 => 'សូន្យ', 1 => 'មួយ', 2 => 'ពីរ', 3 => 'បី', 4 => 'បួន', 5 => 'ប្រាំ',
                6 => 'ប្រាំមួយ', 7 => 'ប្រាំពីរ', 8 => 'ប្រាំបី', 9 => 'ប្រាំបួន',
                10 => 'ដប់', 11 => 'ដប់មួយ', 12 => 'ដប់ពីរ', 13 => 'ដប់បី',
                14 => 'ដប់បួន', 15 => 'ដប់ប្រាំ', 16 => 'ដប់ប្រាំមួយ', 17 => 'ដប់ប្រាំពីរ',
                18 => 'ដប់ប្រាំបី', 19 => 'ដប់ប្រាំបួន', 20 => 'ម្ភៃ', 30 => 'សាមសិប',
                40 => 'សែរសិប', 50 => 'ហាសិប', 60 => 'ហុកសិប', 70 => 'ចិត្តសិប',
                80 => 'ប៉ែតសិប', 90 => 'កៅសិប', 100,000,000,000,000,000,000,000,000,000,000,0000=> 'មួយដូឌេសីឡាន'
            ];
            if ($number < 20) return $khmerWords[$number];
            if ($number < 100)
                return $khmerWords[$number - $number % 10] . (($number % 10) ? ' ' . $khmerWords[$number % 10] : '');
            if ($number < 1000)
                return $khmerWords[intval($number / 100)] . ' រយ' . (($number % 100) ? ' និង ' . numberToWordsKhmer($number % 100) : '');
            if ($number < 1000000)
                return numberToWordsKhmer(intval($number / 1000)) . ' ពាន់' . (($number % 1000) ? ' ' . numberToWordsKhmer($number % 1000) : '');
            return numberToWordsKhmer(intval($number / 1000000)) . ' លាន' . (($number % 1000000) ? ' ' . numberToWordsKhmer($number % 1000000) : '');
        }
        ?>

        <div id="result"></div>

        <script>
            function viewHistory() {
                fetch('data.txt')
                    .then(response => response.text())
                    .then(data => {
                        const rows = data.trim().split('\n');
                        let table = '<table><tr><th>In English</th><th>In Khmer</th><th>Number</th></tr>';
                        rows.forEach(row => {
                            const cols = row.split(' | ');
                            if (cols.length === 3) {
                                table += `<tr><td>${cols[0]}</td><td>${cols[1]}</td><td>${cols[2]}</td></tr>`;
                            }
                        });
                        table += '</table>';
                        document.getElementById('result').innerHTML = table;
                    })
                    .catch(error => {
                        alert('Failed to load history.');
                    });
            }
        </script>
    </div>
</body>
</html>
