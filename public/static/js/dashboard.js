$(document).ready(function(){
	poblateChartSalesPerYear();
  poblateChartProductsSold();
});

//chart.js
const chartSalesPerYear = document.getElementById('chart-sales-per-year'),
      chartSoldProducts = document.getElementById('chart-sold-products'),
      currentYear = new Date().getFullYear();

function poblateChartSalesPerYear(){
  $.ajax({
    url:'admin/dashboard/sales-per-year/'+ currentYear,
    method:'GET',
    data: {},
    success:function(data){
      arregloVentas = [null,null,null,null,null,null,null,null,null,null,null,null];
      for (let i = 0; i < data.length; i++) {
        arregloVentas[data[i].mes - 1] = data[i].ventas
        data[i];
      }
      var ctx_1 = chartSalesPerYear.getContext("2d");
      var myChart = new Chart(ctx_1, {
        type: "line",
        data: {
          labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio", "Agosto", "septiembre", "octubre", "noviembre", "diciembre"],
          datasets: [
            {
              label: "Variación durante los meses del año",
              data: arregloVentas,
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
              ],
              borderWidth: 1,
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
    },
    error:function(error){

    }
  });
}
function poblateChartProductsSold(){
  $.ajax({
    url:'admin/dashboard/products-sold/'+ currentYear,
    method:'GET',
    data: {},
    success:function(data){
      arregloProductos = [null,null,null,null,null,null,null,null,null,null,null,null];
      for (let i = 0; i < data.length; i++) {
        arregloProductos[data[i].mes - 1] = data[i].productos
        data[i];
      }
      var ctx_2 = chartSoldProducts.getContext("2d");
      var myChart = new Chart(ctx_2, {
        type: "line",
        data: {
          labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio", "Agosto", "septiembre", "octubre", "noviembre", "diciembre"],
          datasets: [
            {
              label: "Variación durante los meses del año",
              data: arregloProductos,
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
              ],
              borderWidth: 1,
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
    },
    error:function(error){

    }
  });
}