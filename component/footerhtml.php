</div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- <script defer src="../assets/js/pagination.js"></script> -->
  <!-- <script defer src="../assets/DataTable/dataTables.bootstrap5.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
  <script src="../assets/js/own.js"></script>

  <!-- <script>
    function Nme(argument) {
      // body...
      console.log("testing");
    }
    Nme();
  </script> -->


  
<?php
  
  $objProduct = new product();
  $productsData = $objProduct->bestChartProduct();
  $productNames = [];
  $salesCounts = [];

  foreach ($productsData as $product) {
      $productNames[] = $product['ProductName'];
      $salesCounts[] = $product['SalesCount'];
  }
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  <?php echo json_encode($productNames); ?>
<?php echo json_encode($salesCounts); ?>;
  const productNames = <?php echo json_encode($productNames); ?>;
  const salesCounts = <?php echo json_encode($salesCounts); ?>;
  const ctx = document.getElementById('mychart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: productNames, // Use PHP array for labels
      datasets: [{
        label: 'Sales Count',
        data: salesCounts, // Use PHP array for data values
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)', // Example colors
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)', // Example colors
          'rgb(54, 162, 235)',
          'rgb(255, 206, 86)',
          'rgb(75, 192, 192)',
          'rgb(153, 102, 255)',
          'rgb(255, 159, 64)'
        ],
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