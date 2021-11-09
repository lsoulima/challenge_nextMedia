<template>
  <div class="hello">
    <Listing />
  </div>
</template>

<script>
import Listing from "./screens/Listing";

export default {
  name: "HelloWorld",
  props: {
    msg: String,
  },
  data() {
    return {
    };
  },
  components: {
    Listing,
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
</style>