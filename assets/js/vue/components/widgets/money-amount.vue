<template>
  <div class="widget-small info coloured-icon" v-if="total && month">
    <i class="icon fa fa-money fa-3x"></i>
    <div class="info">
      <h4>Money amount</h4>
      <p><span>Total <b>{{total}}$</b></span> <span>Last month <b>{{month.sumAmount}}$</b></span></p>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'money-amount',
    props: {
      total: {
        type: Number
      },
      month: {
        type: Object
      },
    }
  };
</script>

<style scoped>

</style>