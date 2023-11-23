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
</head>

<body>
    <div class="container">
        <div>
            <div class="form-group">
                <div>
                    <label for="szerelok-selector">Szerelők</label>
                    <select id="szerelok-selector">
                        <option value="">------ Válasszon egyet --------</option>
                        <?php foreach ($viewData["szerelok"] as $option) {
                            echo "<option value='$option->id'>$option->nev</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="helyek-selector">Települések</label>
                    <select id="helyek-selector">
                        <option value="">----- Válasszon egyet --------</option>
                        <?php foreach ($viewData["telepulesek"] as $option) {
                            echo "<option value='$option'>$option</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="radio" id="radio_closed" name="radio_group" value="closed" checked>
                    <label for="radio_closed">Befejezett</label><br>
                    <input type="radio" id="radio_open" name="radio_group" value="open">
                    <label for="radio_open">Minden</label><br>
                </div>
            </div>


            <div class="form-group">
                <button type="button" class="btn btn-primary" id="filter-btn">Keresés</button>
                <button type="button" class="btn btn-primary" id="generate-pdf-btn">Pdf generálás</button>
            </div>

        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Munkalap azonosító</th>
                <th>Cím</th>
                <th>Beadás dátuma</th>
                <th>Szerelő</th>
                <th>Javítás dátuma</th>
                <th>Munkaóra</th>
                <th>Anyagár</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($viewData["munkalapok"] as $ml) { ?>
                <tr>
                    <td>
                        <?= $ml->getMunkaLapId() ?>
                    </td>
                    <td>
                        <?= $ml->getTelepules() . ' ' . $ml->getUtca() ?>
                    </td>
                    <td>
                        <?= $ml->getBeadasDatuma() ?>
                    </td>
                    <td>
                        <?= $ml->getSzereloNeve() ?>
                    </td>
                    <td>
                        <?= $ml->getJavitasDatuma() ?>
                    </td>
                    <td>
                        <?= $ml->getMunkaora() ?>
                    </td>
                    <td>
                        <?= $ml->getAnyagar() ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
<script>
    $(document).ready(function() {

        $('#generate-pdf-btn').click(function() {
            var szereloId = $('#szerelok-selector').val();
            var telepules = $('#helyek-selector').val();

            var requestData = {
                szereloId: szereloId ?? null,
                telepules: telepules ?? null,
                bejezett: getSelectedValue() == 'closed' ? true : false
            };

            var url = '<?= SITE_ROOT . REST_API_PATH . '/print' ?>';
            sendAjaxRequest(url, requestData, function(response) {
                showPopup("Pdf generálása sikeresen megtörtént");
            }, function(error) {
                showPopup(error.responseText);
            });

        });

        $('#filter-btn').click(function() {
            var szereloId = $('#szerelok-selector').val();
            var telepules = $('#helyek-selector').val();

            var requestData = {
                szereloId: szereloId ?? null,
                telepules: telepules ?? null,
                bejezett: getSelectedValue() == 'closed' ? true : false
            };

            console.log(requestData);
            var url = '<?= SITE_ROOT . REST_API_PATH . '/search' ?>';
            sendAjaxRequest(url, requestData, function(response) {
                updateTable(response);
            }, function(error) {
                showPopup('Hiba történt: ' + error.responseText);
            });

        });

        function getSelectedValue() {
            var radioButtons = document.getElementsByName('radio_group');
            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    return radioButtons[i].value;
                }
            }
        }

        function showPopup(message) {
            alert(message);
        }

        function updateTable(data) {
            console.log("tabla");
            var tableBody = $('table tbody');
            tableBody.empty();

            data.forEach(function(item) {
                var munkalap = new Munkalap(item);
                tableBody.append(munkalap.generateTableRow());
            });
        }

        function sendAjaxRequest(url, requestData, successCallback, errorCallback) {
            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify(requestData),
                success: function(response) {
                    successCallback(response);
                },
                error: function(error) {
                    errorCallback(error);
                }
            });
        }

    });

    class Munkalap {
        constructor(data) {
            this.munkaLapId = data.munkaLapId;
            this.telepules = data.telepules;
            this.utca = data.utca;
            this.beadasDatuma = data.beadasDatuma;
            this.szereloNeve = data.szereloNeve;
            this.javitasDatuma = data.javitasDatuma;
            this.munkaora = data.munkaora;
            this.anyagar = data.anyagar;
        }

        generateTableRow() {
            return `
            <tr>
                <td>${this.munkaLapId}</td>
                <td>${this.telepules} ${this.utca}</td>
                <td>${this.beadasDatuma}</td>
                <td>${this.szereloNeve}</td>
                <td>${this.javitasDatuma}</td>
                <td>${this.munkaora}</td>
                <td>${this.anyagar}</td>
            </tr>
        `;
        }
    }
</script>

</html>