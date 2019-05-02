<template>
  <div class="widget-small info coloured-icon" v-if="donor">
    <i class="icon fa fa-thumbs-o-up fa-3x"></i>
    <div class="info">
      <h4>Best donor</h4>
      <p>{{donor.name}} <b>{{donor.sumAmount}}$</b></p>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'best-donor',
    props: {
      donor: {
        type: Object,
        default: null,
      },
    },
  };
</script>

<style scoped>

</style>