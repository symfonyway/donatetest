<script>
  import { Line } from 'vue-chartjs';

  export default {
    name: 'money-chart',
    extends: Line,
    props: {
      items: Object,
    },
    watch: {
      items(value) {

        const labels = [];
        const data = [];

        Object.keys(value).forEach(key => {
          labels.push(key);
          data.push(value[key]);
        });

        this.renderChart({
          labels,
          datasets: [
            {
              label: 'Money amount ($)',
              data,
            }],
        }, {
          responsive: true,
          maintainAspectRatio: false,
        });
      },
    },
  };
</script>

<style scoped>

</style>