<div class="col-8 d-flex justify-content-center align-items-center">
    <canvas id="flats_chart" style="max-width: 75%"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Passa le variabili PHP a JavaScript
    const labels = @json($labels);
    const values = @json($values);

    // Prendo l'elemento canvas
    const ctx = document.getElementById("flats_chart").getContext('2d');

    // Stanzio il grafico
    new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "# di Messaggi per Appartamenti",
                data: values,
                borderWidth: 3,
                borderRadius: 5,
                borderColor: 'rgba(120,90,63,0.8)',
                backgroundColor: 'rgba(112, 90, 60, 0.4)',
                fill: true
            }, ],
        },
        options: {
            responsive: true,
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
