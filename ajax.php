

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AJAX XHR Example</title>
    </head>
<body>
    <button id="fetchDataBtn">Fetch Data</button>
    <div id="output"></div>
    
    <script>
    document.getElementById('fetchDataBtn').addEventListener('click', function () {
        // Create a new XMLHttpRequest
        const xhr = new XMLHttpRequest();
        
        // Define the request
        xhr.open('GET', 'fetch.php', true);
        
        // Set up a callback to handle the response
        xhr.onload = function () {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                displayData(data);
            } else {
                console.error('Error fetching data');
            }
        };
        
        // Send the request
        xhr.send();
    });
    
    function displayData(data) {
        const output = document.getElementById('output');
        output.innerHTML = '';
        data.forEach(item => {
            output.innerHTML += `<p>Name: ${item.name}, Email: ${item.email}</p>`;
        });
    }
    </script>
</body>
</html>
