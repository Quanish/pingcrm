<template>
  <div>
   <canvas id="sales-chart"></canvas>
  </div>
</template>

<script>

import Chart from 'chart.js'
import salesChartData from '@/Shared/sales-data.js'

export default {
  name: 'SalesChart',
  data() {
    return {
      salesChartData: salesChartData
    }
  },
  mounted() {
    const ctx = document.getElementById('sales-chart');
    new Chart(ctx, this.salesChartData);

  }
}
</script>