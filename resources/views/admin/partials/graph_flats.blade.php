<div class="col-12 d-flex justify-content-center align-items-center">
<canvas id="flats_chart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js" style="max-width: 40%"></script>
<script>
    // Passa le variabili PHP a JavaScript
    const labels = @json($labels);
    const values = @json($values);

    // Prendo l'elemento canvas
    const ctx = document.getElementById("flats_chart").getContext('2d');

    // Stanzio il grafico
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "# di Messaggi per Appartamenti",
                    data: values,
                    borderWidth: 2,
                    borderColor: 'rgba(255,0,0,0.3)',
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    fill: true
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>
<style>

</style>