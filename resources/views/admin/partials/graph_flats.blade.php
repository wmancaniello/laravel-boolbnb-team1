<div class="col-8 d-flex justify-content-center align-items-center">
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
                    borderWidth: 3,
                    borderRadius: 5,
                    borderColor: 'rgba(120,90,63,0.6)',
                    backgroundColor: 'rgba(112, 90, 60, 0.2)',
                    fill: true
                },
            ],
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