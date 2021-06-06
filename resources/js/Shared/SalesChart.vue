<template>
  <div class="h-full flex-auto flex flex-col">
   <canvas id="sales-chart" class="h-full flex-auto flex flex-col"></canvas>
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