<template>
  <div>
    <b-row>
      <b-col md="6">
        <best-donor :donor="maxDonor"></best-donor>
      </b-col>
      <b-col md="6">
        <monthly-amount :month="month" :total="total"></monthly-amount>
      </b-col>
    </b-row>
    <div class="tile" style="width: 100%">
      <money-chart :items="datesItems"></money-chart>
    </div>
  </div>
</template>

<script>
  import BestDonor from './widgets/best-donor';
  import MoneyChart from './widgets/money-chart';
  import MonthlyAmount from './widgets/money-amount';

  let fetchDataTimeout = null;

  export default {
    name: 'dashboard',
    components: { MoneyChart, MonthlyAmount, BestDonor },
    data() {
      return {
        datesItems: null,
        maxDonor: null,
        month: null,
        total: null,
      };
    },
    beforeMount() {
      this.fetchData();
    },
    beforeDestroy() {
      clearTimeout(fetchDataTimeout);
    },
    methods: {
      async fetchData() {
        const resp = await this.$http.get('/dashboard-data').catch(e => console.log(e));

        if (resp && resp.data) {
          if (this.total !== resp.data.total) {
            this.datesItems = resp.data.items;
            this.maxDonor = resp.data.max_donor;
            this.total = resp.data.total;
            this.month = resp.data.month;
          }
        }

        fetchDataTimeout = setTimeout(() => this.fetchData(), 2000);
      },
    },
  };
</script>

<style scoped>

</style>