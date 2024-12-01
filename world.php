<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
    $country = $_GET['country'];
    if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities') {
        // Query for cities in a country
        $stmt = $conn->prepare("SELECT cities.name AS city_name, cities.district, cities.population 
                                FROM cities 
                                JOIN countries ON cities.country_code = countries.code 
                                WHERE countries.name LIKE :country");
        $stmt->execute(['country' => '%' . $country . '%']);
        $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output the cities in a table
        if ($cities) {
            echo "<table><thead><tr><th>City Name</th><th>District</th><th>Population</th></tr></thead><tbody>";
            foreach ($cities as $city) {
                echo "<tr>
                        <td>" . htmlspecialchars($city['city_name']) . "</td>
                        <td>" . htmlspecialchars($city['district']) . "</td>
                        <td>" . htmlspecialchars($city['population']) . "</td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No cities found for this country.</p>";
        }
    } else {
        // Query for country information
        $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
        $stmt->execute(['country' => '%' . $country . '%']);
        $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output the country information in a table
        if ($countries) {
            echo "<table><thead><tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr></thead><tbody>";
            foreach ($countries as $country) {
                echo "<tr>
                        <td>" . htmlspecialchars($country['name']) . "</td>
                        <td>" . htmlspecialchars($country['continent']) . "</td>
                        <td>" . htmlspecialchars($country['independence_year']) . "</td>
                        <td>" . htmlspecialchars($country['head_of_state']) . "</td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No countries found.</p>";
        }
    }
} else {
    echo "<p>Please enter a country name.</p>";
}
?>
