<template>
  <header>
    <h1> {{text}} </h1>
  </header>
</template>

<script>
export default {
  name:"Header",
  props:{
    text: String
  }
};
</script>

<style scoped>
header {
  background-color: #03a9f426;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  
}
</style>