<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/public/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        Szerelő id
                    </th>
                    <th>
                        Szerelő neve
                    </th>
                    <th>
                        Kezdés éve
                    </th>
                    <th>
                        Aktív/inaktív
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewData["adatok"]['adat'] as $g) { ?>
                    <tr>
                        <td>
                            <?= $g["az"] ?>
                        </td>
                        <td>
                            <?= $g["nev"] ?>
                        </td>
                        <td>
                            <?= $g["kezdev"] ?>
                        </td>
                        <td>
                            <?php if ($g["deactivate"] === 0) : ?>
                                <input type="checkbox" checked disabled>
                            <?php else : ?>
                                <input type="checkbox" disabled>
                            <?php endif; ?>
                        </td>
                        <td><a href="<?= SITE_ROOT . 'szerelo/szerelomodosit&id=' . $g["az"] ?>">módosít </a>
                        </td>
                        <td><a href="<?= SITE_ROOT . 'szerelotorol&id=' . $g["az"] ?>">TÖRÖL </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <div class="card" id="chartContainer">
            <canvas id="myChart" width="100" height="100"></canvas>
        </div>
    </div>

    <script>
        var szereloMunkak = <?php echo $viewData["szerelokEsMunkak"]; ?>;

        var labels = [];
        var data = [];

        szereloMunkak.forEach(function(item) {
            labels.push(item.szerelo_neve);
            data.push(item.befejezett_munkak_szama);
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Befejezett munkák száma',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>