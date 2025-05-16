<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock de Productos</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
  <div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="flex flex-col md:flex-row">
        <!-- Título a la izquierda en pantallas medianas y grandes, arriba en móviles -->
        <div class="md:w-1/3 p-6 flex items-center justify-center bg-gray-50">
          <h3 class="text-xl md:text-2xl font-semibold text-gray-700">Stock de Productos</h3>
        </div>
        
        <!-- Gráfica a la derecha en pantallas medianas y grandes, abajo en móviles -->
        <div class="md:w-2/3 p-4 md:p-6">
          <div class="w-full h-64 md:h-80">
            <canvas id="productosStockChart" class="w-full h-full"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      fetch('/api/v1/estadisticas/productosenstock')
        .then(response => response.json())
        .then(data => {
          let nombres = data.map(p => p.nombre);
          let cantidades = data.map(p => p.cantidad);
          
          let ctx = document.getElementById('productosStockChart').getContext('2d');
          new Chart(ctx, {
            type: 'doughnut',
            data: {
              labels: nombres,
              datasets: [{
                label: 'Stock Disponible',
                data: cantidades,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.7)',
                  'rgba(54, 162, 235, 0.7)',
                  'rgba(255, 206, 86, 0.7)',
                  'rgba(75, 192, 192, 0.7)',
                  'rgba(153, 102, 255, 0.7)',
                  'rgba(255, 159, 64, 0.7)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: 'right',
                  labels: {
                    boxWidth: 12
                  }
                }
              }
            }
          });
        })
        .catch(error => console.error("Error al cargar los productos en stock:", error));
    });
  </script>
</body>
</html>
