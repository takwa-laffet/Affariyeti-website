<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>;

fetch("/livraison-statistics")
  .then((response) => response.json())
  .then((data) => {
    // Render chart using Chart.js
    const ctx = document.getElementById("livraisonChart").getContext("2d");
    const livraisonChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: ["Highest Address"], // Use the highest address as the label
        datasets: [
          {
            label: "Max Count",
            data: [data.max_count], // Use the maximum count as the data
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1,
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
  })
  .catch((error) =>
    console.error("Error fetching livraison statistics:", error)
  );
