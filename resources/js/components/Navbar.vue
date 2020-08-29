<template>
  <nav id="nav">
    <a href="/">Cidadão de Olho</a>

    <ul>
      <li>
        <router-link to="/verbas">Rank de Gastos </router-link>
      </li>
      <li>
        <router-link class="nav-link" to="/deputados">Deputados</router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
};
</script>

<style>
#nav {
  background-color: #007bff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  /* height: 30px; */
}

#nav > a {
  color: white;
  text-decoration: none;
  padding-left: 15px;
  font-weight: bold;
}
#nav ul {
  list-style: none;
}
#nav ul li {
  display: inline;
}
#nav ul li a {
  margin-right: 20px;
  color: white;
  text-decoration: none;
  /* font-weight:normal ; */
}

/*class adicionanda pelo vue-router */
.router-link-exact-active {
  color: #fff;
  font-weight: bold;
}
</style>