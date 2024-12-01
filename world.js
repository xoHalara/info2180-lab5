document.addEventListener("DOMContentLoaded", () => {
    const lookupButton = document.getElementById("lookup");
    const lookupCitiesButton = document.getElementById("lookup-cities"); // Second button for cities
    const countryInput = document.getElementById("country");
    const resultDiv = document.getElementById("result");

    // Event listener for the "Lookup" button
    lookupButton.addEventListener("click", () => {
        const country = countryInput.value.trim();
        const url = `world.php?country=${encodeURIComponent(country)}`;

        console.log("Fetching data from:", url);  // Debugging log to check the URL

        fetch(url)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok: " + response.statusText);
                }
                return response.text(); // Expecting HTML output
            })
            .then((data) => {
                console.log("Received data:", data);  // Debugging log to check the data
                resultDiv.innerHTML = data;  // Display the HTML table from PHP
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
                resultDiv.innerHTML = "<p>An error occurred while fetching the data.</p>";
            });
    });

    // Event listener for the "Lookup Cities" button
    lookupCitiesButton.addEventListener("click", () => {
        const country = countryInput.value.trim();
        const url = `world.php?country=${encodeURIComponent(country)}&lookup=cities`;

        console.log("Fetching cities data from:", url);  // Debugging log to check the URL

        fetch(url)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok: " + response.statusText);
                }
                return response.text(); // Expecting HTML output
            })
            .then((data) => {
                console.log("Received cities data:", data);  // Debugging log to check the data
                resultDiv.innerHTML = data;  // Display the HTML table from PHP
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
                resultDiv.innerHTML = "<p>An error occurred while fetching the data.</p>";
            });
    });
});
