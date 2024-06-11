<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Date Format with date-fns</title>
    <style>
        .date-output {
            margin-top: 10px;
            font-size: 1.2em;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/date-fns@2.25.0/dist/date-fns.min.js"></script>
</head>
<body>
    <form>
        <label for="birthday">Choose your birthday:</label>
        <input type="date" id="birthday" name="birthday">
    </form>
    <div class="date-output" id="date-output"></div>

    <script>
        const input = document.getElementById('birthday');
        const output = document.getElementById('date-output');

        input.text = "19 June 2023";

        // input.addEventListener('change', () => {
        //     const dateValue = input.value;
        //     if (dateValue) {
        //         const date = new Date(dateValue);
        //         const formattedDate = date.format(date, 'd MMMM yyyy');
        //         output.textContent = `Selected Date: ${formattedDate}`;
        //     } else {
        //         output.textContent = '';
        //     }
        // });
    </script>
</body>
</html>
