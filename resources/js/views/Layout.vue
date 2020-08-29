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
  name: "Layout",
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
  /* width: 100%; */
  display: grid;
  grid-template-rows: 10vh 1fr 10vh;
  grid-template-areas:
    "navbar"
    "main"
    "footer";
}

#container nav {
  grid-area: navbar;
}
#container main {
  grid-area: main;
  width: 95%;
  margin: 10px auto;
  /*  *display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  /* background: red; */

}
#container footer {
  grid-area: footer;
}

@media (min-width: 760px) {
  #container main {
    width: 60%;
  }
}
</style>

