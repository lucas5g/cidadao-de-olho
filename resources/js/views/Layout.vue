<template>
  <div id="container">
    <Navbar />
    <router-view></router-view>
    <Footer />
  </div>
</template>
<script>
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
export default {
  name:'Layout',
  components: {
    Navbar,
    Footer,
  },
};
</script>
<style >
* {
  margin: 0;
  padding: 0;
}
#container {
  /* background: red; */
  font-family: "Nunito";
  height: 100vh;
  display: grid;
  grid-template-rows: 10vh 1fr 10vh;
  grid-template-areas: 'navbar'
                      'main'
                      'footer';

}

nav{
  grid-area: navbar;
}

footer{
  grid-area: footer;
}

</style>

