<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    <title>API de Sincronização de Semáforos</title>
</head>
<body>

    <div class="container-fluid mt-5 p-5">
        <h4 class="text-center mb-4">API DE SICRONIZAÇÃO DE SEMÁFOROS</h4>

        <form id="form-sincronizacao">
            <div class="row">
                <div class="col-4 form-floating mb-3 ">
                    <input type="text" class="form-control" id="distancia" placeholder="Distancia" name="distancia" required>
                    <label for="distancia">Distância do semáforo anterior (metros):</label>
                </div>

                <div class="col-4 form-floating mb-3 ">
                    <input type="text" class="form-control" id="velocidade" placeholder="Velocidade" name="velocidade" required>
                    <label for="velocidade">Velocidade permitida da via (m/s):</label>
                </div>
                
                <div class="col-4 form-floating mb-3 ">
                    <input type="text" class="form-control" id="aceleracao" placeholder="Aceleracao"name="aceleracao" required>
                    <label for="aceleracao">Aceleração típica dos carros (m/s²):</label>
                </div>

                <div class="col-4 d-grid gap-2 mx-auto mt-4">
                    <button type="submit" class="btn btn-success">CALCULAR</button>
                </div>


            </div>
        </form>
            <div class="col text-white text-center fs-20 fw-bold p-3 mt-3" id="resultado" style="display: none;"></div>
    </div>


    <script>
        document.getElementById('form-sincronizacao').addEventListener('submit', function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('semaforo_api.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            var resultadoElement = document.getElementById('resultado');
            resultadoElement.innerHTML = 'Tempo do próximo semáforo: ' + data.tempo_proximo_semaforo + ' segundos';
            
            if (data.tempo_proximo_semaforo) {
                resultadoElement.style.display = 'block';
                resultadoElement.classList.add('com-mensagem');
            } else {
                resultadoElement.style.display = 'none';
                resultadoElement.classList.remove('com-mensagem');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>