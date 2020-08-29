<template>
  <footer>
    <p>
      <a href="http://github.com/lucas5g" target="_blank">Dev - Lucas de Sousa</a>
    </p>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style>
footer {
  background-color: #03a9f426;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
}

footer p a{
  color: grey;
  text-decoration: none;
  /* font-weight: bold; */
}
</style>